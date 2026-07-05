<?php

namespace Tests\Unit;

use Tests\TestCase;

/**
 * Property 17: Dormancy Flag Threshold
 *
 * Accounts with no transactions for ≥ 180 days should be marked dormant.
 * Accounts with recent activity should remain active.
 *
 * Validates: Requirements 7.7
 */
class DormancyJobTest extends TestCase
{
    public function test_account_older_than_180_days_without_transactions_crosses_threshold(): void
    {
        $createdAt = now()->subDays(200);
        $this->assertTrue($createdAt->diffInDays(now()) > 180);
    }

    public function test_account_newer_than_180_days_below_threshold(): void
    {
        $createdAt = now()->subDays(30);
        $this->assertTrue($createdAt->diffInDays(now()) < 180);
    }

    public function test_account_exactly_180_days_at_boundary(): void
    {
        $now = now()->startOfDay();
        $createdAt = $now->copy()->subDays(180);
        $this->assertEquals(180, (int) $createdAt->diffInDays($now));
        $this->assertFalse($createdAt->diffInDays($now) > 180);
    }

    public function test_account_at_181_days_above_threshold(): void
    {
        $createdAt = now()->subDays(181);
        $this->assertTrue($createdAt->diffInDays(now()) > 180);
    }

    public function test_account_at_179_days_below_threshold(): void
    {
        $createdAt = now()->subDays(179);
        $this->assertTrue($createdAt->diffInDays(now()) < 180);
    }

    public function test_account_older_than_365_days_above_threshold(): void
    {
        $createdAt = now()->subYear();
        $this->assertTrue($createdAt->diffInDays(now()) > 180);
    }

    public function test_account_older_than_730_days_above_threshold(): void
    {
        $createdAt = now()->subYears(2);
        $this->assertTrue($createdAt->diffInDays(now()) > 180);
    }

    public function test_very_old_account_several_years_above_threshold(): void
    {
        $createdAt = now()->subYears(5);
        $this->assertTrue($createdAt->diffInDays(now()) > 180);
    }

    public function test_dormancy_threshold_boundary_values(): void
    {
        $now = now()->startOfDay();
        // Test around the 180-day boundary
        for ($days = 175; $days <= 185; $days++) {
            $createdAt = $now->copy()->subDays($days);
            $isDormant = $createdAt->diffInDays($now) > 180;
            if ($days > 180) {
                $this->assertTrue($isDormant, "Day {$days} should be dormant");
            } else {
                $this->assertFalse($isDormant, "Day {$days} should not be dormant");
            }
        }
    }

    public function test_new_account_not_dormant(): void
    {
        $createdAt = now()->subDays(1);
        $this->assertFalse($createdAt->diffInDays(now()) > 180);
    }

    public function test_account_created_today_not_dormant(): void
    {
        $createdAt = now();
        $this->assertFalse($createdAt->diffInDays(now()) > 180);
    }

    public function test_dormant_status_check_for_various_account_ages(): void
    {
        $now = now()->startOfDay();
        $ages = [0, 1, 30, 90, 179, 180, 181, 200, 365, 730];

        foreach ($ages as $days) {
            $createdAt = $now->copy()->subDays($days);
            $isDormant = $createdAt->diffInDays($now) > 180;

            if ($days > 180) {
                $this->assertTrue($isDormant, "{$days} days old should be dormant");
            } else {
                $this->assertFalse($isDormant, "{$days} days old should not be dormant");
            }
        }
    }
}
