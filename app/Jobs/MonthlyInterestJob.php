<?php

namespace App\Jobs;

use App\Models\SavingsAccount;
use App\Notifications\JobFailedNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class MonthlyInterestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 1;

    public function handle(): void
    {
        $processed = 0;
        $errors = 0;

        SavingsAccount::where('status', 'active')
            ->where('interest_rate', '>', 0)
            ->chunk(100, function ($accounts) use (&$processed, &$errors) {
                foreach ($accounts as $account) {
                    try {
                        $monthlyInterest = (int) round($account->balance * ($account->interest_rate / 12));

                        if ($monthlyInterest <= 0) {
                            continue;
                        }

                        $oldBalance = $account->balance;
                        $account->balance += $monthlyInterest;
                        $account->save();

                        $account->transactions()->create([
                            'type' => 'interest',
                            'amount' => $monthlyInterest,
                            'balance_after' => $account->balance,
                            'reference' => 'INT-' . now()->format('Ym') . '-' . $account->id,
                            'description' => "Monthly interest at " . ($account->interest_rate * 100) . "% p.a.",
                        ]);

                        $processed++;
                    } catch (\Exception $e) {
                        $errors++;
                        Log::error('MonthlyInterestJob: failed for account ' . $account->id, [
                            'error' => $e->getMessage(),
                        ]);
                    }
                }
            });

        Log::info('MonthlyInterestJob completed', [
            'processed' => $processed,
            'errors' => $errors,
        ]);
    }

    public function failed(\Throwable $e): void
    {
        Log::error('MonthlyInterestJob failed', ['error' => $e->getMessage()]);

        try {
            Notification::route('mail', config('app.admin_email', 'admin@mubendesacco.com'))
                ->notify(new JobFailedNotification(
                    'MonthlyInterestJob',
                    $e->getMessage()
                ));
        } catch (\Exception $notifyEx) {
            Log::warning('Failed to send MonthlyInterestJob failure notification', ['error' => $notifyEx->getMessage()]);
        }
    }
}
