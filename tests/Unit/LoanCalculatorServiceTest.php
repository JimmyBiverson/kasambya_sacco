<?php

namespace Tests\Unit;

use App\Services\LoanCalculatorService;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for LoanCalculatorService.
 *
 * Validates: Requirements 5.2
 */
class LoanCalculatorServiceTest extends TestCase
{
    private LoanCalculatorService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new LoanCalculatorService();
    }

    // -------------------------------------------------------------------------
    // flatSchedule
    // -------------------------------------------------------------------------

    public function test_flat_schedule_returns_correct_row_count(): void
    {
        $schedule = $this->service->flatSchedule(1_000_000, 18.0, 12);
        $this->assertCount(12, $schedule);
    }

    public function test_flat_schedule_row_keys_are_present(): void
    {
        $schedule = $this->service->flatSchedule(1_000_000, 18.0, 12);
        $row      = $schedule[0];

        $this->assertArrayHasKey('due_month', $row);
        $this->assertArrayHasKey('principal_due', $row);
        $this->assertArrayHasKey('interest_due', $row);
        $this->assertArrayHasKey('total_due', $row);
        $this->assertArrayHasKey('balance', $row);
    }

    public function test_flat_schedule_due_months_are_sequential(): void
    {
        $schedule = $this->service->flatSchedule(1_000_000, 18.0, 12);

        foreach ($schedule as $index => $row) {
            $this->assertSame($index + 1, $row['due_month']);
        }
    }

    public function test_flat_schedule_sum_of_principal_due_equals_principal(): void
    {
        $principal = 5_000_000;
        $schedule  = $this->service->flatSchedule($principal, 18.0, 24);

        $totalPrincipal = array_sum(array_column($schedule, 'principal_due'));
        $this->assertSame($principal, $totalPrincipal);
    }

    public function test_flat_schedule_total_interest_matches_formula(): void
    {
        $principal  = 1_000_000;
        $annualRate = 18.0;
        $term       = 12;

        $expectedInterest = (int) round($principal * ($annualRate / 100) * ($term / 12));

        $schedule      = $this->service->flatSchedule($principal, $annualRate, $term);
        $actualInterest = array_sum(array_column($schedule, 'interest_due'));

        $this->assertSame($expectedInterest, $actualInterest);
    }

    public function test_flat_schedule_total_due_equals_principal_plus_interest_per_row(): void
    {
        $schedule = $this->service->flatSchedule(2_000_000, 15.0, 6);

        foreach ($schedule as $row) {
            $this->assertSame($row['principal_due'] + $row['interest_due'], $row['total_due']);
        }
    }

    public function test_flat_schedule_last_row_balance_is_zero(): void
    {
        $schedule  = $this->service->flatSchedule(1_000_000, 18.0, 12);
        $lastRow   = end($schedule);

        $this->assertSame(0, $lastRow['balance']);
    }

    public function test_flat_schedule_balance_decreases_each_month(): void
    {
        $schedule = $this->service->flatSchedule(3_000_000, 20.0, 12);

        $prevBalance = PHP_INT_MAX;
        foreach ($schedule as $row) {
            $this->assertLessThanOrEqual($prevBalance, $row['balance']);
            $prevBalance = $row['balance'];
        }
    }

    public function test_flat_schedule_all_values_are_integers(): void
    {
        $schedule = $this->service->flatSchedule(1_000_000, 18.0, 12);

        foreach ($schedule as $row) {
            $this->assertIsInt($row['due_month']);
            $this->assertIsInt($row['principal_due']);
            $this->assertIsInt($row['interest_due']);
            $this->assertIsInt($row['total_due']);
            $this->assertIsInt($row['balance']);
        }
    }

    public function test_flat_schedule_with_24_months(): void
    {
        $principal  = 10_000_000;
        $annualRate = 24.0;
        $term       = 24;

        $schedule       = $this->service->flatSchedule($principal, $annualRate, $term);
        $totalPrincipal = array_sum(array_column($schedule, 'principal_due'));
        $totalInterest  = array_sum(array_column($schedule, 'interest_due'));
        $expectedInterest = (int) round($principal * ($annualRate / 100) * ($term / 12));

        $this->assertCount($term, $schedule);
        $this->assertSame($principal, $totalPrincipal);
        $this->assertSame($expectedInterest, $totalInterest);
    }

    // -------------------------------------------------------------------------
    // reducingBalanceSchedule
    // -------------------------------------------------------------------------

    public function test_reducing_balance_returns_correct_row_count(): void
    {
        $schedule = $this->service->reducingBalanceSchedule(1_000_000, 18.0, 12);
        $this->assertCount(12, $schedule);
    }

    public function test_reducing_balance_row_keys_are_present(): void
    {
        $schedule = $this->service->reducingBalanceSchedule(1_000_000, 18.0, 12);
        $row      = $schedule[0];

        $this->assertArrayHasKey('due_month', $row);
        $this->assertArrayHasKey('principal_due', $row);
        $this->assertArrayHasKey('interest_due', $row);
        $this->assertArrayHasKey('total_due', $row);
        $this->assertArrayHasKey('balance', $row);
    }

    public function test_reducing_balance_due_months_are_sequential(): void
    {
        $schedule = $this->service->reducingBalanceSchedule(1_000_000, 18.0, 12);

        foreach ($schedule as $index => $row) {
            $this->assertSame($index + 1, $row['due_month']);
        }
    }

    public function test_reducing_balance_sum_of_principal_due_equals_principal(): void
    {
        $principal = 5_000_000;
        $schedule  = $this->service->reducingBalanceSchedule($principal, 18.0, 24);

        $totalPrincipal = array_sum(array_column($schedule, 'principal_due'));
        $this->assertSame($principal, $totalPrincipal);
    }

    public function test_reducing_balance_last_row_balance_is_zero(): void
    {
        $schedule = $this->service->reducingBalanceSchedule(1_000_000, 18.0, 12);
        $lastRow  = end($schedule);

        $this->assertSame(0, $lastRow['balance']);
    }

    public function test_reducing_balance_total_due_equals_principal_plus_interest_per_row(): void
    {
        $schedule = $this->service->reducingBalanceSchedule(2_000_000, 15.0, 6);

        foreach ($schedule as $row) {
            $this->assertSame($row['principal_due'] + $row['interest_due'], $row['total_due']);
        }
    }

    public function test_reducing_balance_all_values_are_integers(): void
    {
        $schedule = $this->service->reducingBalanceSchedule(1_000_000, 18.0, 12);

        foreach ($schedule as $row) {
            $this->assertIsInt($row['due_month']);
            $this->assertIsInt($row['principal_due']);
            $this->assertIsInt($row['interest_due']);
            $this->assertIsInt($row['total_due']);
            $this->assertIsInt($row['balance']);
        }
    }

    public function test_reducing_balance_interest_decreases_each_month(): void
    {
        // Interest per row should decrease as balance reduces
        $schedule = $this->service->reducingBalanceSchedule(3_000_000, 20.0, 12);

        $prevInterest = PHP_INT_MAX;
        foreach ($schedule as $row) {
            $this->assertLessThanOrEqual($prevInterest, $row['interest_due']);
            $prevInterest = $row['interest_due'];
        }
    }

    public function test_reducing_balance_principal_increases_each_month(): void
    {
        // Principal component per row should increase (or stay equal) as interest shrinks
        $schedule    = $this->service->reducingBalanceSchedule(3_000_000, 20.0, 12);
        $prevPrincipal = 0;

        // Exclude last row because it is adjusted for rounding
        $rowsExcludingLast = array_slice($schedule, 0, -1);
        foreach ($rowsExcludingLast as $row) {
            $this->assertGreaterThanOrEqual($prevPrincipal, $row['principal_due']);
            $prevPrincipal = $row['principal_due'];
        }
    }

    public function test_reducing_balance_known_values(): void
    {
        // 1,000,000 UGX at 12% p.a. for 12 months
        // Monthly rate = 1% => instalment = 1,000,000 * 0.01 * 1.01^12 / (1.01^12 - 1)
        $schedule = $this->service->reducingBalanceSchedule(1_000_000, 12.0, 12);

        // Standard annuity formula result ≈ 88,849 UGX/month
        $firstInstalment = $schedule[0]['total_due'];
        $this->assertGreaterThan(88_000, $firstInstalment);
        $this->assertLessThan(90_000, $firstInstalment);
    }

    // -------------------------------------------------------------------------
    // compoundSchedule
    // -------------------------------------------------------------------------

    public function test_compound_schedule_matches_reducing_balance(): void
    {
        $principal  = 1_000_000;
        $annualRate = 18.0;
        $term       = 12;

        $flat      = $this->service->reducingBalanceSchedule($principal, $annualRate, $term);
        $compound  = $this->service->compoundSchedule($principal, $annualRate, $term);

        $this->assertSame($flat, $compound);
    }

    public function test_compound_schedule_sum_of_principal_due_equals_principal(): void
    {
        $principal = 5_000_000;
        $schedule  = $this->service->compoundSchedule($principal, 18.0, 24);

        $totalPrincipal = array_sum(array_column($schedule, 'principal_due'));
        $this->assertSame($principal, $totalPrincipal);
    }

    public function test_compound_schedule_last_row_balance_is_zero(): void
    {
        $schedule = $this->service->compoundSchedule(1_000_000, 18.0, 12);
        $lastRow  = end($schedule);

        $this->assertSame(0, $lastRow['balance']);
    }

    // -------------------------------------------------------------------------
    // summary
    // -------------------------------------------------------------------------

    public function test_summary_returns_required_keys(): void
    {
        $schedule = $this->service->flatSchedule(1_000_000, 18.0, 12);
        $summary  = $this->service->summary($schedule);

        $this->assertArrayHasKey('monthly_instalment', $summary);
        $this->assertArrayHasKey('total_interest', $summary);
        $this->assertArrayHasKey('total_repayable', $summary);
    }

    public function test_summary_monthly_instalment_equals_first_row_total_due(): void
    {
        $schedule = $this->service->flatSchedule(1_000_000, 18.0, 12);
        $summary  = $this->service->summary($schedule);

        $this->assertSame($schedule[0]['total_due'], $summary['monthly_instalment']);
    }

    public function test_summary_total_interest_equals_sum_of_interest_due(): void
    {
        $schedule       = $this->service->flatSchedule(1_000_000, 18.0, 12);
        $expectedInterest = array_sum(array_column($schedule, 'interest_due'));
        $summary        = $this->service->summary($schedule);

        $this->assertSame($expectedInterest, $summary['total_interest']);
    }

    public function test_summary_total_repayable_equals_sum_of_total_due(): void
    {
        $schedule       = $this->service->flatSchedule(1_000_000, 18.0, 12);
        $expectedTotal  = array_sum(array_column($schedule, 'total_due'));
        $summary        = $this->service->summary($schedule);

        $this->assertSame($expectedTotal, $summary['total_repayable']);
    }

    public function test_summary_total_repayable_equals_principal_plus_total_interest(): void
    {
        $principal = 5_000_000;
        $schedule  = $this->service->reducingBalanceSchedule($principal, 18.0, 24);
        $summary   = $this->service->summary($schedule);

        $this->assertSame(
            $summary['total_repayable'],
            $principal + $summary['total_interest']
        );
    }

    public function test_summary_returns_integers(): void
    {
        $schedule = $this->service->flatSchedule(1_000_000, 18.0, 12);
        $summary  = $this->service->summary($schedule);

        $this->assertIsInt($summary['monthly_instalment']);
        $this->assertIsInt($summary['total_interest']);
        $this->assertIsInt($summary['total_repayable']);
    }

    public function test_summary_on_empty_schedule(): void
    {
        $summary = $this->service->summary([]);

        $this->assertSame(0, $summary['monthly_instalment']);
        $this->assertSame(0, $summary['total_interest']);
        $this->assertSame(0, $summary['total_repayable']);
    }

    public function test_summary_for_reducing_balance_schedule(): void
    {
        $principal = 1_000_000;
        $schedule  = $this->service->reducingBalanceSchedule($principal, 18.0, 12);
        $summary   = $this->service->summary($schedule);

        // total_repayable should be strictly greater than principal (there is interest)
        $this->assertGreaterThan($principal, $summary['total_repayable']);
        // total_interest should be positive
        $this->assertGreaterThan(0, $summary['total_interest']);
    }

    // -------------------------------------------------------------------------
    // Zero interest rate edge case
    // -------------------------------------------------------------------------

    public function test_flat_schedule_zero_rate_has_no_interest(): void
    {
        $principal = 1_200_000;
        $schedule  = $this->service->flatSchedule($principal, 0.0, 12);

        $totalInterest = array_sum(array_column($schedule, 'interest_due'));
        $this->assertSame(0, $totalInterest);

        $totalPrincipal = array_sum(array_column($schedule, 'principal_due'));
        $this->assertSame($principal, $totalPrincipal);
    }

    public function test_reducing_balance_zero_rate_has_no_interest(): void
    {
        $principal = 1_200_000;
        $schedule  = $this->service->reducingBalanceSchedule($principal, 0.0, 12);

        $totalInterest = array_sum(array_column($schedule, 'interest_due'));
        $this->assertSame(0, $totalInterest);

        $totalPrincipal = array_sum(array_column($schedule, 'principal_due'));
        $this->assertSame($principal, $totalPrincipal);
    }
}
