<?php

namespace App\Services;

use App\Jobs\SendApprovalNotificationJob;
use App\Models\Loan;
use App\Models\LoanApproval;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class LoanApprovalService
{
    /**
     * Read the loan product's approval_levels JSON and dispatch a notification
     * job to each user whose role matches the next pending approval level.
     */
    public function notifyApprovers(Loan $loan): void
    {
        $loan->loadMissing('loanProduct', 'approvals');

        $approvalLevels = $loan->loanProduct?->approval_levels ?? [];

        if (empty($approvalLevels)) {
            Log::info("LoanApprovalService: No approval levels configured for loan product {$loan->loanProduct?->id}.");
            return;
        }

        $completedLevels = $loan->approvals->pluck('level')->toArray();

        foreach ($approvalLevels as $levelConfig) {
            $level    = (int) ($levelConfig['level'] ?? 0);
            $roleName = $levelConfig['role'] ?? null;

            if (! $roleName || in_array($level, $completedLevels, true)) {
                continue;
            }

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

            // Only notify the next pending level
            break;
        }
    }

    /**
     * Record an approval or rejection action for the current pending level.
     *
     * @param  Loan        $loan    The loan being actioned.
     * @param  string      $action  'approved' or 'rejected'.
     * @param  string|null $reason  Mandatory reason for rejection; optional for approval.
     */
    public function recordApproval(Loan $loan, string $action, ?string $reason = null): LoanApproval
    {
        $loan->loadMissing('loanProduct', 'approvals');

        $approvalLevels  = $loan->loanProduct?->approval_levels ?? [];
        $completedLevels = $loan->approvals->pluck('level')->toArray();

        // Determine the next pending level number
        $nextLevel = count($completedLevels) + 1;

        if (! empty($approvalLevels)) {
            foreach ($approvalLevels as $levelConfig) {
                $l = (int) ($levelConfig['level'] ?? 0);
                if (! in_array($l, $completedLevels, true)) {
                    $nextLevel = $l;
                    break;
                }
            }
        }

        return LoanApproval::create([
            'loan_id'     => $loan->id,
            'level'       => $nextLevel,
            'approver_id' => auth()->id(),
            'action'      => $action,
            'reason'      => $reason,
            'approved_at' => now(),
        ]);
    }

    /**
     * Check whether all configured approval levels have been completed with
     * an 'approved' action. Returns true when the loan can be fully marked approved.
     */
    public function allLevelsComplete(Loan $loan): bool
    {
        $loan->loadMissing('loanProduct', 'approvals');

        $approvalLevels = $loan->loanProduct?->approval_levels ?? [];

        if (empty($approvalLevels)) {
            // No multi-level config — a single approval suffices
            return $loan->approvals->where('action', 'approved')->isNotEmpty();
        }

        $approvedLevels = $loan->approvals
            ->where('action', 'approved')
            ->pluck('level')
            ->toArray();

        foreach ($approvalLevels as $levelConfig) {
            $level = (int) ($levelConfig['level'] ?? 0);
            if (! in_array($level, $approvedLevels, true)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Check whether the given user is allowed to approve the loan at its
     * current pending approval level (based on spatie/laravel-permission roles).
     */
    public function canApprove(User $user, Loan $loan): bool
    {
        $loan->loadMissing('loanProduct', 'approvals');

        $approvalLevels = $loan->loanProduct?->approval_levels ?? [];

        if (empty($approvalLevels)) {
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

        // All levels completed
        return false;
    }
}
