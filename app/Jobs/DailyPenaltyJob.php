<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\JobFailedNotification;
use App\Services\JournalEntryService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

/**
 * DailyPenaltyJob — scheduled daily at 00:30.
 *
 * For each overdue loan schedule that has passed the product's grace period:
 *  1. Computes penalty = outstanding × penalty_rate_per_day × days_overdue
 *  2. Computes accrued interest = outstanding × daily_interest_rate × days_overdue
 *  3. Posts a combined JournalEntry via JournalEntryService
 *  4. Updates loan_schedules.penalty_due
 *
 * Requirements: 6.9, 6.10
 */
class DailyPenaltyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Maximum number of attempts before the job is considered failed.
     *
     * @var int
     */
    public int $tries = 1;

    /**
     * Execute the job.
     *
     * Queries all loan_schedules where:
     *   - status = 'overdue'
     *   - due_date < today - grace_period (from the linked loan_product)
     *
     * For each schedule, computes the penalty and accrued interest and posts
     * a JournalEntry, then updates the schedule's penalty_due column.
     */
    public function handle(JournalEntryService $journalEntryService): void
    {
        // Guard: if tables haven't been migrated yet, skip gracefully.
        if (! Schema::hasTable('loan_schedules') || ! Schema::hasTable('loans') || ! Schema::hasTable('loan_products')) {
            Log::info('DailyPenaltyJob: required tables not found — skipping run.');
            return;
        }

        $today = now()->toDateString();

        // Fetch all overdue schedules that have exceeded the grace period.
        // We join loans → loan_products to get grace_period, penalty_rate, and interest_rate.
        $overdueSchedules = DB::table('loan_schedules as ls')
            ->join('loans as l', 'l.id', '=', 'ls.loan_id')
            ->join('loan_products as lp', 'lp.id', '=', 'l.loan_product_id')
            ->where('ls.status', 'overdue')
            ->whereRaw("ls.due_date < DATE_SUB(?, INTERVAL lp.grace_period DAY)", [$today])
            ->whereNotNull('l.disbursed_amount')
            ->select([
                'ls.id                 as schedule_id',
                'ls.loan_id',
                'ls.due_date',
                'ls.principal_due',
                'ls.interest_due',
                'ls.penalty_due',
                'ls.paid_amount',
                'ls.total_due',
                'lp.penalty_rate',
                'lp.interest_rate',
                'lp.grace_period',
                'l.application_number',
                'l.disbursed_amount',
            ])
            ->get();

        if ($overdueSchedules->isEmpty()) {
            Log::info('DailyPenaltyJob: no overdue schedules beyond grace period found.');
            return;
        }

        $processedCount = 0;
        $errorCount     = 0;

        foreach ($overdueSchedules as $schedule) {
            try {
                $this->processSchedule($schedule, $journalEntryService, $today);
                $processedCount++;
            } catch (\Throwable $e) {
                $errorCount++;
                Log::error('DailyPenaltyJob: failed to process schedule', [
                    'schedule_id' => $schedule->schedule_id,
                    'loan_id'     => $schedule->loan_id,
                    'error'       => $e->getMessage(),
                ]);
            }
        }

        Log::info("DailyPenaltyJob: completed. Processed: {$processedCount}, Errors: {$errorCount}.");
    }

    /**
     * Process a single overdue loan schedule:
     *   - Compute penalty and accrued interest
     *   - Post JournalEntry
     *   - Update penalty_due on the schedule row
     *
     * @param  object                $schedule              Raw DB row (loan_schedules + join data)
     * @param  JournalEntryService   $journalEntryService
     * @param  string                $today                 ISO date string (Y-m-d)
     */
    private function processSchedule(
        object             $schedule,
        JournalEntryService $journalEntryService,
        string             $today,
    ): void {
        $dueDate   = \Carbon\Carbon::parse($schedule->due_date);
        $todayDate = \Carbon\Carbon::parse($today);

        // Days overdue (after grace period has been accounted for in the query)
        $daysOverdue = (int) $dueDate->diffInDays($todayDate, true);

        if ($daysOverdue <= 0) {
            return;
        }

        // Outstanding amount = principal_due - amount already paid toward principal
        // We use total_due - paid_amount as the outstanding balance for the installment.
        $outstanding = (int) max(0, $schedule->total_due - $schedule->paid_amount);

        if ($outstanding <= 0) {
            return;
        }

        // penalty_rate is stored as a decimal % per day (e.g. 0.001000 = 0.1% per day)
        // Convert to a plain fraction: e.g. 0.001000 → 0.001000 (already a fraction when < 1)
        // Per the design, penalty_rate is "decimal 8,6 — % per day", so divide by 100 to get fraction.
        $penaltyRateFraction   = (float) $schedule->penalty_rate / 100.0;

        // interest_rate is also stored as a % (annual). Convert to daily fraction.
        // interest_rate decimal(5,4) holds e.g. 0.1200 = 12% annual → daily = 12% / 365
        $interestRateFraction  = (float) $schedule->interest_rate / 100.0;
        $dailyInterestFraction = $interestRateFraction / 365.0;

        // Penalty = outstanding × penalty_rate_per_day × days_overdue (in UGX, rounded)
        $penaltyAmount = (int) round($outstanding * $penaltyRateFraction * $daysOverdue);

        // Accrued interest = outstanding × daily_interest_rate × days_overdue (in UGX, rounded)
        $accruedInterest = (int) round($outstanding * $dailyInterestFraction * $daysOverdue);

        $totalCharge = $penaltyAmount + $accruedInterest;

        if ($totalCharge <= 0) {
            return;
        }

        $reference = sprintf('PENALTY-%s-%s', $schedule->application_number, now()->format('Ymd'));

        // Post JournalEntry via JournalEntryService:
        //   Dr  Penalty & Interest Receivable (4100) — outstanding income owed to SACCO
        //   Cr  Penalty Income                (5100) — penalty fee income
        //   Cr  Interest Income               (5000) — accrued interest income
        //
        // Account codes follow the chart seeded in Task 29.
        // We build the lines carefully to remain balanced.
        $lines = [];

        if ($penaltyAmount > 0 && $accruedInterest > 0) {
            // Single debit, two credits
            $lines = [
                [
                    'account_code' => '1110',  // Penalty & Interest Receivable (asset)
                    'description'  => "Penalty receivable — {$schedule->application_number} ({$daysOverdue}d overdue)",
                    'debit'        => $totalCharge,
                    'credit'       => 0,
                ],
                [
                    'account_code' => '5100',  // Penalty Fee Income
                    'description'  => "Penalty income — {$schedule->application_number} (UGX {$penaltyAmount})",
                    'debit'        => 0,
                    'credit'       => $penaltyAmount,
                ],
                [
                    'account_code' => '5000',  // Interest Income
                    'description'  => "Accrued interest — {$schedule->application_number} (UGX {$accruedInterest})",
                    'debit'        => 0,
                    'credit'       => $accruedInterest,
                ],
            ];
        } elseif ($penaltyAmount > 0) {
            $lines = [
                [
                    'account_code' => '1110',
                    'description'  => "Penalty receivable — {$schedule->application_number} ({$daysOverdue}d overdue)",
                    'debit'        => $penaltyAmount,
                    'credit'       => 0,
                ],
                [
                    'account_code' => '5100',
                    'description'  => "Penalty income — {$schedule->application_number}",
                    'debit'        => 0,
                    'credit'       => $penaltyAmount,
                ],
            ];
        } else {
            $lines = [
                [
                    'account_code' => '1110',
                    'description'  => "Accrued interest receivable — {$schedule->application_number} ({$daysOverdue}d overdue)",
                    'debit'        => $accruedInterest,
                    'credit'       => 0,
                ],
                [
                    'account_code' => '5000',
                    'description'  => "Accrued interest income — {$schedule->application_number}",
                    'debit'        => 0,
                    'credit'       => $accruedInterest,
                ],
            ];
        }

        $journalEntryService->post(
            lines: $lines,
            meta: [
                'date'        => $today,
                'reference'   => $reference,
                'description' => "Daily penalty & accrued interest for loan {$schedule->application_number} — {$daysOverdue} days overdue",
                'posted_by'   => null,   // system-generated
            ]
        );

        // Update the schedule's penalty_due to accumulate the new penalty.
        DB::table('loan_schedules')
            ->where('id', $schedule->schedule_id)
            ->increment('penalty_due', $penaltyAmount);

        Log::debug('DailyPenaltyJob: processed schedule', [
            'schedule_id'     => $schedule->schedule_id,
            'loan_id'         => $schedule->loan_id,
            'days_overdue'    => $daysOverdue,
            'outstanding'     => $outstanding,
            'penalty_amount'  => $penaltyAmount,
            'accrued_interest' => $accruedInterest,
            'reference'       => $reference,
        ]);
    }

    /**
     * Handle job failure after all retries are exhausted.
     *
     * Dispatches a JobFailedNotification to the Super Admin email so that
     * the failure does not go unnoticed in production.
     *
     * @param  \Throwable  $exception
     */
    public function failed(\Throwable $exception): void
    {
        Log::error('DailyPenaltyJob permanently failed', [
            'error' => $exception->getMessage(),
            'trace' => $exception->getTraceAsString(),
        ]);

        // Attempt to notify via Super Admin user (role: Super Admin)
        try {
            $notification = new JobFailedNotification(
                jobClass: static::class,
                errorMessage: $exception->getMessage(),
                context: [
                    'date'   => now()->toDateString(),
                    'queue'  => $this->queue ?? 'default',
                ]
            );

            // Try to find a Super Admin user to notify via Laravel Notifications
            $superAdmin = \App\Models\User::role('Super Admin')->first();

            if ($superAdmin) {
                $superAdmin->notify($notification);
            } else {
                // Fall back to sending mail directly to the configured from address
                $fallbackEmail = config('mail.from.address');
                if ($fallbackEmail) {
                    \Illuminate\Support\Facades\Notification::route('mail', $fallbackEmail)
                        ->notify($notification);
                }
            }
        } catch (\Throwable $notifyException) {
            // Never let notification failure mask the original job failure
            Log::warning('DailyPenaltyJob: could not send failure notification', [
                'error' => $notifyException->getMessage(),
            ]);
        }
    }
}
