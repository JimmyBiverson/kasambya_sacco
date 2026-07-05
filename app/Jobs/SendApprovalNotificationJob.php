<?php

namespace App\Jobs;

use App\Models\Loan;
use App\Models\User;
use App\Notifications\LoanAwaitingApprovalNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendApprovalNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Number of times the job may be attempted.
     *
     * @var int
     */
    public int $tries = 3;

    /**
     * @param  Loan  $loan      The loan application awaiting approval.
     * @param  User  $approver  The user to be notified.
     */
    public function __construct(
        public readonly Loan $loan,
        public readonly User $approver,
    ) {
    }

    /**
     * Execute the job: send approval notification to the approver.
     */
    public function handle(): void
    {
        $this->approver->notify(new LoanAwaitingApprovalNotification($this->loan));
    }

    /**
     * Handle job failure — log the error so it is visible in the Laravel log.
     */
    public function failed(\Throwable $exception): void
    {
        Log::error('SendApprovalNotificationJob failed', [
            'loan_id'     => $this->loan->id,
            'approver_id' => $this->approver->id,
            'error'       => $exception->getMessage(),
        ]);
    }
}
