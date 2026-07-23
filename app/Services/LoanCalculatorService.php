<?php

namespace App\Services;

class LoanCalculatorService
{
    /**
     * Flat interest amortisation schedule.
     *
     * Total interest = principal × (annualRate / 100) × (termMonths / 12)
     * Monthly payment = (principal + total_interest) / termMonths
     *
     * @param  int    $principal   Principal amount in UGX
     * @param  float  $annualRate  Annual interest rate as a percentage (e.g. 18.0 for 18%)
     * @param  int    $termMonths  Loan term in months
     * @return array<int, array{due_month: int, principal_due: int, interest_due: int, total_due: int, balance: int}>
     */
    public function flatSchedule(int $principal, float $annualRate, int $termMonths): array
    {
        $totalInterest = (int) round($principal * ($annualRate / 100) * ($termMonths / 12));

        $monthlyInterest  = (int) round($totalInterest / $termMonths);
        $monthlyPrincipal = (int) round($principal / $termMonths);

        $schedule       = [];
        $remainingPrincipal = $principal;

        for ($month = 1; $month <= $termMonths; $month++) {
            $isLast = ($month === $termMonths);

            // On the last row, pay whatever principal is still outstanding (absorbs rounding drift)
            $principalDue = $isLast ? $remainingPrincipal : $monthlyPrincipal;

            // On the last row, pay whatever interest is still outstanding
            $interestPaid = array_sum(array_column($schedule, 'interest_due'));
            $interestDue  = $isLast ? ($totalInterest - $interestPaid) : $monthlyInterest;

            $totalDue = $principalDue + $interestDue;
            $remainingPrincipal -= $principalDue;

            $schedule[] = [
                'due_month'     => $month,
                'principal_due' => $principalDue,
                'interest_due'  => $interestDue,
                'total_due'     => $totalDue,
                'balance'       => $remainingPrincipal,
            ];
        }

        return $schedule;
    }

    /**
     * Reducing balance (standard annuity) amortisation schedule.
     *
     * Monthly instalment = P × r × (1+r)^n / ((1+r)^n − 1)
     * where r = annualRate / 12 / 100 and n = termMonths.
     *
     * Interest per row = remaining_balance × r
     * Principal per row = instalment − interest_due
     * Last row adjusted to clear any rounding residual.
     *
     * @param  int    $principal   Principal amount in UGX
     * @param  float  $annualRate  Annual interest rate as a percentage (e.g. 18.0 for 18%)
     * @param  int    $termMonths  Loan term in months
     * @return array<int, array{due_month: int, principal_due: int, interest_due: int, total_due: int, balance: int}>
     */
    public function reducingBalanceSchedule(int $principal, float $annualRate, int $termMonths): array
    {
        $monthlyRate = $annualRate / 12 / 100;

        // When rate is zero use simple equal-principal split
        if ($monthlyRate == 0.0) {
            return $this->zeroRateSchedule($principal, $termMonths);
        }

        $factor     = (1 + $monthlyRate) ** $termMonths;
        $instalment = (int) round($principal * $monthlyRate * $factor / ($factor - 1));

        $schedule        = [];
        $remainingBalance = $principal;

        for ($month = 1; $month <= $termMonths; $month++) {
            $isLast = ($month === $termMonths);

            $interestDue  = (int) round($remainingBalance * $monthlyRate);
            $principalDue = $isLast ? $remainingBalance : ($instalment - $interestDue);

            // Guard: if rounding made principal_due ≤ 0 on a non-last row, set it to at least 1
            if (!$isLast && $principalDue <= 0) {
                $principalDue = 1;
            }

            $totalDue         = $principalDue + $interestDue;
            $remainingBalance -= $principalDue;

            $schedule[] = [
                'due_month'     => $month,
                'principal_due' => $principalDue,
                'interest_due'  => $interestDue,
                'total_due'     => $totalDue,
                'balance'       => $remainingBalance,
            ];
        }

        return $schedule;
    }

    /**
     * Compound amortisation schedule.
     *
     * Implements identically to reducingBalanceSchedule — the annuity formula
     * inherently handles monthly compounding on the remaining balance.
     *
     * @param  int    $principal   Principal amount in UGX
     * @param  float  $annualRate  Annual interest rate as a percentage (e.g. 18.0 for 18%)
     * @param  int    $termMonths  Loan term in months
     * @return array<int, array{due_month: int, principal_due: int, interest_due: int, total_due: int, balance: int}>
     */
    public function compoundSchedule(int $principal, float $annualRate, int $termMonths): array
    {
        return $this->reducingBalanceSchedule($principal, $annualRate, $termMonths);
    }

    /**
     * Summary statistics for a schedule.
     *
     * @param  array $schedule  Schedule rows as returned by flatSchedule / reducingBalanceSchedule / compoundSchedule
     * @return array{monthly_instalment: int, total_interest: int, total_repayable: int}
     */
    public function summary(array $schedule): array
    {
        if (empty($schedule)) {
            return [
                'monthly_instalment' => 0,
                'total_interest'     => 0,
                'total_repayable'    => 0,
            ];
        }

        $monthlyInstalment = $schedule[0]['total_due'];
        $totalInterest     = array_sum(array_column($schedule, 'interest_due'));
        $totalRepayable    = array_sum(array_column($schedule, 'total_due'));

        return [
            'monthly_instalment' => (int) $monthlyInstalment,
            'total_interest'     => (int) $totalInterest,
            'total_repayable'    => (int) $totalRepayable,
        ];
    }

    /**
     * Fallback schedule for 0% interest rate: equal principal splits, no interest.
     *
     * @param  int  $principal
     * @param  int  $termMonths
     * @return array
     */
    private function zeroRateSchedule(int $principal, int $termMonths): array
    {
        $monthlyPrincipal = (int) round($principal / $termMonths);
        $schedule         = [];
        $remaining        = $principal;

        for ($month = 1; $month <= $termMonths; $month++) {
            $isLast       = ($month === $termMonths);
            $principalDue = $isLast ? $remaining : $monthlyPrincipal;
            $remaining   -= $principalDue;

            $schedule[] = [
                'due_month'     => $month,
                'principal_due' => $principalDue,
                'interest_due'  => 0,
                'total_due'     => $principalDue,
                'balance'       => $remaining,
            ];
        }

        return $schedule;
    }
}
