<?php

namespace App\Services;

class DepreciationCalculatorService
{
    public function straightLine(int $cost, int $salvageValue, int $usefulLifeYears): int
    {
        if ($usefulLifeYears <= 0) {
            return 0;
        }

        return (int) round(($cost - $salvageValue) / $usefulLifeYears);
    }

    public function reducingBalance(int $bookValue, float $rate = 0.2): int
    {
        return (int) round($bookValue * $rate);
    }

    public function monthlyDepreciation(int $annualDepreciation): int
    {
        return (int) round($annualDepreciation / 12);
    }
}
