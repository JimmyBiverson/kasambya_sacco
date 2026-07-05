<?php

namespace App\Services;

use App\Jobs\SendApprovalNotificationJob;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class LoanApprovalService
{
    /**
     * Read the loan product's approval_levels JSON and dispatch a notification
     * job to each user whose role matches the next pending approval level.
     *
     * @param  Loan  $loan
     * @return void
     */
    public function notifyApprovers(Loan $loan): void
    {
        $loan->loadMissing('loanProduct', 'approvals');

        $approvalLevels = $loan->loanProduct?->approval_levels ?? [];

        if (empty($approvalLevels)) {
            Log::info("LoanApprovalService: No approval levels configured for loan product {$loan->loanProduct?->id}.");
            return;
        }

        // Determine which levels have already been actioned
        $completedLevels = $loan->approvals->pluck('level')->toArray();

        foreach ($approvalLevels as $levelConfig) {
            $level    = (int) ($levelConfig['level'] ?? 0);
            $roleName = $levelConfig['role'] ?? null;

            if (! $roleName || in_array($level, $completedLevels, true)) {
                continue;
            }

            // Find all users with this role
            try {
                $approvers = User::role($roleName)->get();
            } catch (\Exception $e) {
                Log::warning("LoanApprovalService: Role '{$roleName}' not found. Skipping notification.", [
                    'loan_id' => $loan->id,
                    'error'   => $e->getMessage(),
                ]);
                continue;
            }

            foreach ($approvers as $approver) {
                SendApprovalNotificationJob::dispatch($loan, $approver);
            }

            // Only notify the next pending level, not all future levels
            break;
        }
    }

    /**
     * Check whether the given user is allowed to approve the loan at its
     * current pending approval level (based on spatie/laravel-permission roles).
     *
     * @param  User  $user
     * @param  Loan  $loan
     * @return bool
     */
    public function canApprove(User $user, Loan $loan): bool
    {
        $loan->loadMissing('loanProduct', 'approvals');

        $approvalLevels = $loan->loanProduct?->approval_levels ?? [];

        if (empty($approvalLevels)) {
            // No levels configured — any authenticated user can approve
            return true;
        }

        $completedLevels = $loan->approvals->pluck('level')->toArray();

        foreach ($approvalLevels as $levelConfig) {
            $level    = (int) ($levelConfig['level'] ?? 0);
            $roleName = $levelConfig['role'] ?? null;

            if (in_array($level, $completedLevels, true)) {
                continue;
            }

            // This is the next pending level
            if (! $roleName) {
                return true;
            }

            return $user->hasRole($roleName);
        }

        // All levels completed — no further approval needed
        return false;
    }
}
