<?php

namespace App\Services;

class PayrollCalculatorService
{
    const int TAX_FREE_THRESHOLD = 235_000;
    const int PERSONAL_RELIEF = 25_000;
    const int NSSF_CEILING = 5_000_000;

    /**
     * Compute Uganda PAYE (2024/2025 rates).
     *
     * Bands:
     *   Up to 235,000      -> 0%
     *   235,001 – 335,000  -> 10% of amount over 235,000
     *   335,001 – 410,000  -> 10,000 + 20% of amount over 335,000
     *   410,001 – 10,000,000 -> 25,000 + 30% of amount over 410,000
     *   Over 10,000,000    -> 2,902,000 + 30% of amount over 10,000,000
     *
     * Standard personal relief of 25,000 UGX is deducted from computed PAYE.
     */
    public function calculateUganadaPayee(int $taxableIncome, int $periodDays = 30): int
    {
        if ($taxableIncome <= self::TAX_FREE_THRESHOLD) {
            return 0;
        }

        $paye = match (true) {
            $taxableIncome <= 335_000    => (int) round(($taxableIncome - self::TAX_FREE_THRESHOLD) * 0.10),
            $taxableIncome <= 410_000    => 10_000 + (int) round(($taxableIncome - 335_000) * 0.20),
            $taxableIncome <= 10_000_000 => 25_000 + (int) round(($taxableIncome - 410_000) * 0.30),
            default                      => 2_902_000 + (int) round(($taxableIncome - 10_000_000) * 0.30),
        };

        $paye -= self::PERSONAL_RELIEF;

        return max(0, $paye);
    }

    /**
     * Calculate NSSF deductions.
     *
     * Employee: 5% of gross pay, capped at gross of 5,000,000 UGX.
     * Employer: 10% of gross pay, capped at gross of 5,000,000 UGX.
     *
     * @return array{employee: int, employer: int}
     */
    public function calculateNssfDeductions(int $grossPay): array
    {
        $cappedGross = min($grossPay, self::NSSF_CEILING);

        return [
            'employee' => (int) round($cappedGross * 0.05),
            'employer' => (int) round($cappedGross * 0.10),
        ];
    }

    /**
     * Calculate net pay breakdown.
     *
     * @return array{gross_pay: int, paye: int, nssf_employee: int, nssf_employer: int, total_deductions: int, net_pay: int}
     */
    public function calculateNetPay(int $grossPay, int $totalDeductions = 0): array
    {
        $paye = $this->calculateUganadaPayee($grossPay);
        $nssf = $this->calculateNssfDeductions($grossPay);

        $allDeductions = $paye + $nssf['employee'] + $totalDeductions;
        $netPay = max(0, $grossPay - $allDeductions);

        return [
            'gross_pay'       => $grossPay,
            'paye'            => $paye,
            'nssf_employee'   => $nssf['employee'],
            'nssf_employer'   => $nssf['employer'],
            'total_deductions' => $allDeductions,
            'net_pay'         => $netPay,
        ];
    }
}
