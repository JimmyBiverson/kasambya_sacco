<?php

namespace Tests\Property;

use App\Services\PayrollCalculatorService;
use Eris\Attributes\ErisRepeat;
use Eris\TestTrait;
use PHPUnit\Framework\TestCase;

#[ErisRepeat(50)]
class PayrollCalculatorPropertyTest extends TestCase
{
    use TestTrait;

    private PayrollCalculatorService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new PayrollCalculatorService();
    }

    /**
     * P6: Net pay is never negative.
     */
    public function test_net_pay_is_never_negative(): void
    {
        $this->forAll(
            \Eris\Generator\choose(0, 100_000_000)
        )->then(function ($grossPay) {
            $result = $this->service->calculateNetPay($grossPay);
            $this->assertGreaterThanOrEqual(0, $result['net_pay']);
        });
    }

    /**
     * P7: PAYE is never greater than taxable income.
     */
    public function test_paye_never_exceeds_taxable_income(): void
    {
        $this->forAll(
            \Eris\Generator\choose(0, 100_000_000)
        )->then(function ($taxableIncome) {
            $paye = $this->service->calculateUganadaPayee($taxableIncome);
            $this->assertLessThanOrEqual($taxableIncome, $paye);
        });
    }

    /**
     * P8: NSSF employee contribution never exceeds 5% of gross.
     */
    public function test_nssf_employee_does_not_exceed_five_percent(): void
    {
        $this->forAll(
            \Eris\Generator\choose(0, 100_000_000)
        )->then(function ($grossPay) {
            $result = $this->service->calculateNssfDeductions($grossPay);
            $fivePercent = (int) round($grossPay * 0.05);
            $this->assertLessThanOrEqual($fivePercent, $result['employee']);
        });
    }
}
