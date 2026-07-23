<?php

namespace Tests\Unit;

use App\Services\PayrollCalculatorService;
use PHPUnit\Framework\TestCase;

class PayrollCalculatorServiceTest extends TestCase
{
    private PayrollCalculatorService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new PayrollCalculatorService();
    }

    // -------------------------------------------------------------------------
    // calculateUganadaPayee
    // -------------------------------------------------------------------------

    public function test_paye_below_threshold_is_zero(): void
    {
        $this->assertSame(0, $this->service->calculateUganadaPayee(200_000));
        $this->assertSame(0, $this->service->calculateUganadaPayee(235_000));
    }

    public function test_paye_first_band(): void
    {
        // 235,001 – 335,000: 10% of amount over 235,000, less 25,000 relief
        $paye = $this->service->calculateUganadaPayee(300_000);
        $expected = (int) round((300_000 - 235_000) * 0.10) - 25_000;
        $this->assertSame(0, $paye); // relief wipes it out
    }

    public function test_paye_second_band(): void
    {
        // 335,001 – 410,000: 10,000 + 20% of amount over 335,000
        $paye = $this->service->calculateUganadaPayee(400_000);
        // (10,000 + 20% of 65,000) - 25,000 relief = 10,000 + 13,000 - 25,000 = 0
        $this->assertSame(0, $paye);
    }

    public function test_paye_third_band(): void
    {
        // 410,001 – 10,000,000: 25,000 + 30% of amount over 410,000
        $paye = $this->service->calculateUganadaPayee(1_000_000);
        // (25,000 + 30% of 590,000) - 25,000 = 25,000 + 177,000 - 25,000 = 177,000
        $this->assertSame(177_000, $paye);
    }

    public function test_paye_top_band(): void
    {
        // Over 10,000,000: 2,902,000 + 30% of amount over 10,000,000
        $paye = $this->service->calculateUganadaPayee(15_000_000);
        // (2,902,000 + 30% of 5,000,000) - 25,000 = 2,902,000 + 1,500,000 - 25,000 = 4,377,000
        $this->assertSame(4_377_000, $paye);
    }

    public function test_paye_never_negative(): void
    {
        // At 235,001 the tax is ~1 UGX, relief makes it 0
        $this->assertSame(0, $this->service->calculateUganadaPayee(235_001));
        $this->assertSame(0, $this->service->calculateUganadaPayee(0));
    }

    // -------------------------------------------------------------------------
    // calculateNssfDeductions
    // -------------------------------------------------------------------------

    public function test_nssf_below_ceiling(): void
    {
        $result = $this->service->calculateNssfDeductions(1_000_000);
        $this->assertSame(50_000, $result['employee']);  // 5% of 1M
        $this->assertSame(100_000, $result['employer']); // 10% of 1M
    }

    public function test_nssf_at_ceiling(): void
    {
        $result = $this->service->calculateNssfDeductions(5_000_000);
        $this->assertSame(250_000, $result['employee']);  // 5% of 5M
        $this->assertSame(500_000, $result['employer']); // 10% of 5M
    }

    public function test_nssf_above_ceiling(): void
    {
        $result = $this->service->calculateNssfDeductions(10_000_000);
        // Capped at 5M, so same as at ceiling
        $this->assertSame(250_000, $result['employee']);
        $this->assertSame(500_000, $result['employer']);
    }

    public function test_nssf_zero_gross(): void
    {
        $result = $this->service->calculateNssfDeductions(0);
        $this->assertSame(0, $result['employee']);
        $this->assertSame(0, $result['employer']);
    }

    // -------------------------------------------------------------------------
    // calculateNetPay
    // -------------------------------------------------------------------------

    public function test_calculate_net_pay_returns_all_keys(): void
    {
        $result = $this->service->calculateNetPay(1_000_000);
        $this->assertArrayHasKey('gross_pay', $result);
        $this->assertArrayHasKey('paye', $result);
        $this->assertArrayHasKey('nssf_employee', $result);
        $this->assertArrayHasKey('nssf_employer', $result);
        $this->assertArrayHasKey('total_deductions', $result);
        $this->assertArrayHasKey('net_pay', $result);
    }

    public function test_calculate_net_pay_integrity(): void
    {
        $result = $this->service->calculateNetPay(1_000_000);
        $this->assertSame($result['gross_pay'], $result['net_pay'] + $result['total_deductions']);
    }

    public function test_calculate_net_pay_with_additional_deductions(): void
    {
        $result = $this->service->calculateNetPay(2_000_000, 100_000);
        $this->assertGreaterThanOrEqual(0, $result['net_pay']);
        $this->assertSame(
            $result['gross_pay'],
            $result['net_pay'] + $result['total_deductions']
        );
    }

    public function test_calculate_net_pay_all_values_are_integers(): void
    {
        $result = $this->service->calculateNetPay(1_500_000, 50_000);
        foreach ($result as $value) {
            $this->assertIsInt($value);
        }
    }
}
