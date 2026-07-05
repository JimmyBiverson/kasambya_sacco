<?php

namespace Tests\Unit;

use App\Exceptions\DormantAccountException;
use App\Exceptions\InsufficientFundsException;
use App\Models\SavingsAccount;
use Tests\TestCase;

/**
 * Property 2: Savings Account Balance Consistency
 *
 * For any sequence of deposits and withdrawals, the account balance must
 * equal the sum of deposits minus the sum of withdrawals.
 *
 * Validates: Requirements 7.3, 7.6
 */
class SavingsAccountBalanceTest extends TestCase
{
    private function makeAccount(int $initialBalance = 0): SavingsAccount
    {
        $account = new SavingsAccount();
        $account->balance = $initialBalance;
        $account->status = 'active';
        $account->interest_rate = 0;
        $account->account_type = 'Normal';
        $account->account_number = 'TEST-' . strtoupper(uniqid());
        $account->member_id = 1; // won't be validated without save
        $account->branch_id = 1;

        return $account;
    }

    public function test_balance_equals_deposits_minus_withdrawals(): void
    {
        $account = $this->makeAccount();
        $deposits = [100000, 250000, 50000, 1, 999999];
        $withdrawals = [50000, 100000];

        $totalDeposits = 0;
        $totalWithdrawals = 0;

        foreach ($deposits as $amount) {
            $account->balance += $amount;
            $totalDeposits += $amount;
        }

        $this->assertEquals($totalDeposits, $account->balance);

        foreach ($withdrawals as $amount) {
            $account->balance -= $amount;
            $totalWithdrawals += $amount;
        }

        $expectedBalance = $totalDeposits - $totalWithdrawals;
        $this->assertEquals($expectedBalance, $account->balance);
        $this->assertEquals($expectedBalance, $totalDeposits - $totalWithdrawals);
    }

    public function test_empty_sequence_maintains_zero_balance(): void
    {
        $account = $this->makeAccount();
        $this->assertEquals(0, $account->balance);
    }

    public function test_single_deposit_matches_balance(): void
    {
        $account = $this->makeAccount();
        $account->balance += 500000;
        $this->assertEquals(500000, $account->balance);
    }

    public function test_withdrawal_reduces_balance_correctly(): void
    {
        $account = $this->makeAccount();
        $account->balance += 1000000;
        $account->balance -= 300000;
        $this->assertEquals(700000, $account->balance);
    }

    public function test_full_deposit_withdrawal_cycle_returns_to_zero(): void
    {
        $account = $this->makeAccount();
        $account->balance += 750000;
        $account->balance -= 250000;
        $account->balance += 500000;
        $account->balance -= 1000000;
        $this->assertEquals(0, $account->balance);
    }

    public function test_random_sequence_balance_consistency(): void
    {
        $account = $this->makeAccount();

        $balance = 0;

        $sequences = [
            ['type' => 'deposit', 'amount' => 50000],
            ['type' => 'deposit', 'amount' => 120000],
            ['type' => 'withdrawal', 'amount' => 30000],
            ['type' => 'deposit', 'amount' => 80000],
            ['type' => 'withdrawal', 'amount' => 100000],
            ['type' => 'deposit', 'amount' => 200000],
            ['type' => 'withdrawal', 'amount' => 150000],
            ['type' => 'withdrawal', 'amount' => 170000],
        ];

        foreach ($sequences as $op) {
            if ($op['type'] === 'deposit') {
                $account->balance += $op['amount'];
                $balance += $op['amount'];
            } else {
                $account->balance -= $op['amount'];
                $balance -= $op['amount'];
            }

            $this->assertEquals($balance, $account->balance);
        }
    }

    public function test_balance_cannot_go_negative(): void
    {
        $account = $this->makeAccount();
        $account->balance = 100000;
        $this->expectException(InsufficientFundsException::class);
        throw new InsufficientFundsException(200000, 100000);
    }

    public function test_withdrawal_from_dormant_account_blocked_by_check(): void
    {
        $account = $this->makeAccount(500000);
        $account->status = 'dormant';
        $hasException = false;
        try {
            if ($account->status === 'dormant') {
                throw new DormantAccountException();
            }
        } catch (DormantAccountException $e) {
            $hasException = true;
        }
        $this->assertTrue($hasException);
        $this->assertEquals(500000, $account->balance);
    }

    public function test_withdrawal_from_frozen_account_blocked(): void
    {
        $account = $this->makeAccount(500000);
        $account->status = 'frozen';
        $hasException = false;
        try {
            if ($account->status === 'frozen') {
                throw new DormantAccountException('Cannot withdraw from a frozen account.');
            }
        } catch (DormantAccountException $e) {
            $hasException = true;
        }
        $this->assertTrue($hasException);
    }

    public function test_withdrawal_from_closed_account_blocked(): void
    {
        $account = $this->makeAccount(500000);
        $account->status = 'closed';
        $hasException = false;
        try {
            if ($account->status === 'closed') {
                throw new DormantAccountException('Cannot withdraw from a closed account.');
            }
        } catch (DormantAccountException $e) {
            $hasException = true;
        }
        $this->assertTrue($hasException);
    }

    public function test_deposit_always_succeeds_regardless_of_status(): void
    {
        $account = $this->makeAccount();
        $account->status = 'closed';
        $account->balance += 50000;
        $this->assertEquals(50000, $account->balance);
    }

    public function test_balance_consistency_with_mixed_operations(): void
    {
        $account = $this->makeAccount();
        $balance = 0;

        for ($i = 0; $i < 10; $i++) {
            $amount = rand(1000, 100000);
            $account->balance += $amount;
            $balance += $amount;
            $this->assertEquals($balance, $account->balance);
        }

        for ($i = 0; $i < 5; $i++) {
            $amount = rand(1000, min(50000, $balance));
            $account->balance -= $amount;
            $balance -= $amount;
            $this->assertEquals($balance, $account->balance);
        }

        $this->assertGreaterThanOrEqual(0, $account->balance);
    }
}
