<?php

namespace Tests\Property;

use App\Services\LoanCalculatorService;
use Eris\Attributes\ErisRepeat;
use Eris\TestTrait;
use PHPUnit\Framework\TestCase;

#[ErisRepeat(50)]
class LoanPropertyTest extends TestCase
{
    use TestTrait;

    private LoanCalculatorService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new LoanCalculatorService();
    }

    /**
     * P9: Loan repayment total never exceeds principal plus interest.
     */
    public function test_repayment_total_never_exceeds_principal_plus_interest(): void
    {
        $this->forAll(
            \Eris\Generator\choose(100_000, 10_000_000),
            \Eris\Generator\choose(0, 3000),
            \Eris\Generator\choose(1, 60)
        )->then(function ($principal, $rateInCents, $term) {
            $rate = $rateInCents / 100;

            $schedule = $this->service->flatSchedule($principal, $rate, $term);
            $summary = $this->service->summary($schedule);

            $totalRepayment = array_sum(array_column($schedule, 'total_due'));
            $maxAllowed = $principal + $summary['total_interest'];

            $this->assertLessThanOrEqual($maxAllowed, $totalRepayment);
        });
    }

    /**
     * P10: Interest amount is proportional to principal and rate.
     */
    public function test_interest_is_proportional_to_principal_and_rate(): void
    {
        $this->forAll(
            \Eris\Generator\choose(100_000, 10_000_000),
            \Eris\Generator\choose(0, 3000),
            \Eris\Generator\choose(1, 60)
        )->then(function ($principal, $rateInCents, $term) {
            $rate = $rateInCents / 100;

            $expectedInterest = (int) round($principal * ($rate / 100) * ($term / 12));
            $schedule = $this->service->flatSchedule($principal, $rate, $term);
            $actualInterest = array_sum(array_column($schedule, 'interest_due'));

            $this->assertSame($expectedInterest, $actualInterest);
        });
    }
}
