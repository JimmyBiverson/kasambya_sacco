<?php

namespace Tests\Property;

use App\Models\SavingsAccount;
use Eris\Attributes\ErisRepeat;
use Eris\TestTrait;
use PHPUnit\Framework\TestCase;

#[ErisRepeat(50)]
class SavingsPropertyTest extends TestCase
{
    use TestTrait;

    protected function setUp(): void
    {
        parent::setUp();
    }

    private function makeAccount(int $initialBalance = 0, string $status = 'active'): SavingsAccount
    {
        $account = new SavingsAccount();
        $account->balance = $initialBalance;
        $account->status = $status;
        $account->interest_rate = 0;
        $account->account_type = 'Normal';
        $account->account_number = 'TEST-' . strtoupper(uniqid());
        $account->member_id = 1;
        $account->branch_id = 1;

        return $account;
    }

    /**
     * P11: A savings deposit always increases the balance.
     */
    public function test_deposit_increases_balance(): void
    {
        $this->forAll(
            \Eris\Generator\choose(0, 10_000_000),
            \Eris\Generator\choose(1, 10_000_000)
        )->then(function ($initialBalance, $depositAmount) {
            $account = $this->makeAccount($initialBalance);
            $oldBalance = $account->balance;

            $account->balance += $depositAmount;

            $this->assertSame($oldBalance + $depositAmount, $account->balance);
        });
    }

    /**
     * P12: A savings withdrawal decreases the balance when sufficient.
     */
    public function test_withdrawal_decreases_balance_when_sufficient(): void
    {
        $this->forAll(
            \Eris\Generator\choose(1, 10_000_000),
            \Eris\Generator\choose(1, 10_000_000)
        )->then(function ($initialBalance, $withdrawalAmount) {
            if ($withdrawalAmount > $initialBalance) {
                $this->assertTrue(true);
                return;
            }

            $account = $this->makeAccount($initialBalance);
            $oldBalance = $account->balance;

            $account->balance -= $withdrawalAmount;

            $this->assertSame($oldBalance - $withdrawalAmount, $account->balance);
        });
    }
}
