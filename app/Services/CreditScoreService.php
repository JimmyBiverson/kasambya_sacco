<?php

namespace App\Services;

use App\Models\Member;

class CreditScoreService
{
    /**
     * Compute a credit score (0–100) for the given member.
     *
     * Weights:
     *  - Repayment history  : 40%
     *  - Savings balance    : 30%
     *  - Employment status  : 20%
     *  - Guarantor strength : 10%
     */
    public function compute(Member $member): int
    {
        $score = 0.0;

        // -----------------------------------------------------------------
        // 1. Repayment history (40%)
        // -----------------------------------------------------------------
        $score += $this->repaymentScore($member);

        // -----------------------------------------------------------------
        // 2. Savings balance (30%)
        //    TODO: Implement once SavingsAccount model/table exists (Task 22).
        //    For now this component contributes 0.
        // -----------------------------------------------------------------
        $score += $this->savingsScore($member);

        // -----------------------------------------------------------------
        // 3. Employment status (20%)
        // -----------------------------------------------------------------
        $score += $this->employmentScore($member);

        // -----------------------------------------------------------------
        // 4. Guarantor strength (10%)
        // -----------------------------------------------------------------
        $score += $this->guarantorScore($member);

        return (int) round(max(0, min(100, $score)));
    }

    // ------------------------------------------------------------------
    // Private helpers
    // ------------------------------------------------------------------

    /**
     * Repayment history component — contributes 0–40 to total score.
     *
     * Logic:
     *  - No loans at all  → 50% credit (20 points)
     *  - Has loans        → ratio = paid schedules / total past-due schedules
     *                       (all schedules whose due_date is in the past, i.e. status != 'pending')
     *                       component = ratio * 40
     */
    private function repaymentScore(Member $member): float
    {
        $member->loadMissing('loans.schedules');

        $loans = $member->loans;

        if ($loans->isEmpty()) {
            // No loan history — give 50% of this component
            return 20.0;
        }

        $totalPastDue = 0;
        $paidCount    = 0;

        foreach ($loans as $loan) {
            foreach ($loan->schedules as $schedule) {
                // Only consider schedules that have already come due
                if ($schedule->status === 'pending') {
                    continue;
                }

                $totalPastDue++;

                if ($schedule->status === 'paid') {
                    $paidCount++;
                }
            }
        }

        if ($totalPastDue === 0) {
            // Loans exist but no schedules have come due yet — treat as no history
            return 20.0;
        }

        $ratio = $paidCount / $totalPastDue;

        return $ratio * 40.0;
    }

    /**
     * Savings balance component — contributes 0–30 to total score.
     *
     * Scale: 0 UGX → 0 points; ≥ 5,000,000 UGX → 30 points (linear interpolation).
     */
    private function savingsScore(Member $member): float
    {
        $member->loadMissing('savingsAccounts');

        $totalBalance = (int) $member->savingsAccounts
            ->where('status', 'active')
            ->sum('balance');

        if ($totalBalance <= 0) {
            return 0.0;
        }

        if ($totalBalance >= 5_000_000) {
            return 30.0;
        }

        $score = ($totalBalance / 5_000_000) * 30.0;

        return round($score / 5) * 5;
    }

    /**
     * Employment status component — contributes 0 or 20 to total score.
     *
     * Full score if the member has an employer set; 0 otherwise.
     */
    private function employmentScore(Member $member): float
    {
        return filled($member->employer) ? 20.0 : 0.0;
    }

    /**
     * Guarantor strength component — contributes 0–10 to total score.
     *
     * 0 active guarantors → 0 points
     * 1 active guarantor  → 5 points  (50% × 10)
     * 2+ active guarantors → 10 points (100% × 10)
     */
    private function guarantorScore(Member $member): float
    {
        $member->loadMissing('guarantors');

        $activeCount = $member->guarantors
            ->where('status', 'active')
            ->count();

        if ($activeCount === 0) {
            return 0.0;
        }

        if ($activeCount === 1) {
            return 5.0;
        }

        return 10.0;
    }
}
