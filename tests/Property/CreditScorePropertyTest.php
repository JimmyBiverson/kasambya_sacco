<?php

namespace Tests\Property;

use App\Models\Member;
use App\Models\SavingsAccount;
use App\Services\CreditScoreService;
use Eris\Attributes\ErisRepeat;
use Eris\TestTrait;
use Illuminate\Database\Eloquent\Collection;
use PHPUnit\Framework\TestCase;

#[ErisRepeat(50)]
class CreditScorePropertyTest extends TestCase
{
    use TestTrait;

    private CreditScoreService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new CreditScoreService();
    }

    private function makeMember(
        ?string $employer = null,
        array   $loans = [],
        array   $guarantors = [],
        array   $savingsAccounts = []
    ): Member {
        $member = new Member();
        $member->employer = $employer;

        $member->setRelation('loans', new Collection($loans));
        $member->setRelation('guarantors', new Collection($guarantors));
        $member->setRelation('savingsAccounts', new Collection($savingsAccounts));

        return $member;
    }

    private function makeSavingsAccount(int $balance = 0, string $status = 'active'): SavingsAccount
    {
        $account = new SavingsAccount();
        $account->balance = $balance;
        $account->status = $status;
        return $account;
    }

    /**
     * P1: For any member with exactly zero savings balance, the savings score is 0.
     */
    public function test_savings_score_is_zero_for_zero_balance(): void
    {
        $reflector = new \ReflectionMethod(CreditScoreService::class, 'savingsScore');
        $reflector->setAccessible(true);

        $this->forAll(
            \Eris\Generator\string()
        )->then(function ($employer) use ($reflector) {
            $member = $this->makeMember(
                employer: $employer,
                savingsAccounts: []
            );

            $score = $reflector->invoke($this->service, $member);
            $this->assertSame(0, (int) $score);
        });
    }

    /**
     * P2: The credit score never exceeds 100.
     */
    public function test_credit_score_is_never_outside_zero_to_one_hundred(): void
    {
        $this->forAll(
            \Eris\Generator\choose(0, 10_000_000),
            \Eris\Generator\choose(0, 10)
        )->then(function ($balance, $numAccounts) {
            $accounts = [];
            for ($i = 0; $i < $numAccounts; $i++) {
                $accounts[] = $this->makeSavingsAccount($balance, 'active');
            }

            $member = $this->makeMember(
                employer: 'Employer',
                savingsAccounts: $accounts
            );

            $score = $this->service->compute($member);
            $this->assertGreaterThanOrEqual(0, $score);
            $this->assertLessThanOrEqual(100, $score);
        });
    }

    /**
     * P3: For any member, the savings score is a multiple of 5.
     */
    public function test_savings_score_is_multiple_of_five(): void
    {
        $reflector = new \ReflectionMethod(CreditScoreService::class, 'savingsScore');
        $reflector->setAccessible(true);

        $this->forAll(
            \Eris\Generator\choose(0, 5_000_000)
        )->disableShrinking()->then(function ($balance) use ($reflector) {
            $account = $this->makeSavingsAccount($balance, 'active');
            $member = $this->makeMember(
                employer: 'Test',
                savingsAccounts: [$account]
            );

            $score = $reflector->invoke($this->service, $member);
            $this->assertSame(0, (int) $score % 5);
        });
    }
}
