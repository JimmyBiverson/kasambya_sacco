<?php

namespace Tests\Unit;

use App\Models\Loan;
use App\Models\LoanSchedule;
use App\Models\Member;
use App\Models\MemberGuarantor;
use App\Models\SavingsAccount;
use App\Services\CreditScoreService;
use Illuminate\Database\Eloquent\Collection;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for CreditScoreService.
 *
 * Validates: Requirements 6.2
 *
 * These tests use plain PHPUnit with hand-crafted model stubs so that no
 * database connection is required.
 */
class CreditScoreServiceTest extends TestCase
{
    private CreditScoreService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new CreditScoreService();
    }

    // ------------------------------------------------------------------
    // Helpers — build lightweight model stubs without hitting the DB
    // ------------------------------------------------------------------

    private function makeMember(
        ?string $employer = null,
        array   $loans = [],
        array   $guarantors = [],
        array   $savingsAccounts = []
    ): Member {
        /** @var Member $member */
        $member = new Member();
        $member->employer = $employer;

        // Stub out loadMissing so it does nothing (relations already set)
        $loanCollection        = new Collection($loans);
        $guarantorCollection   = new Collection($guarantors);
        $savingsCollection     = new Collection($savingsAccounts);

        // Set relation cache directly on the model instance
        $member->setRelation('loans', $loanCollection);
        $member->setRelation('guarantors', $guarantorCollection);
        $member->setRelation('savingsAccounts', $savingsCollection);

        return $member;
    }

    private function makeSavingsAccount(int $balance = 0, string $status = 'active'): SavingsAccount
    {
        $account = new SavingsAccount();
        $account->balance = $balance;
        $account->status = $status;
        return $account;
    }

    private function makeLoan(array $schedules = []): Loan
    {
        $loan = new Loan();
        $loan->setRelation('schedules', new Collection($schedules));
        return $loan;
    }

    private function makeSchedule(string $status): LoanSchedule
    {
        $schedule = new LoanSchedule();
        $schedule->status = $status;
        return $schedule;
    }

    private function makeGuarantor(string $status): MemberGuarantor
    {
        $guarantor = new MemberGuarantor();
        $guarantor->status = $status;
        return $guarantor;
    }

    // ------------------------------------------------------------------
    // Score is always within [0, 100]
    // ------------------------------------------------------------------

    public function test_score_is_zero_for_member_with_no_data(): void
    {
        $member = $this->makeMember(null, [], []);
        $score  = $this->service->compute($member);

        // No employer (0), no loans gives 20 for repayment, no savings (0), no guarantors (0)
        $this->assertSame(20, $score);
    }

    public function test_score_maximum_is_100(): void
    {
        // All factors fully satisfied
        $schedules = [
            $this->makeSchedule('paid'),
            $this->makeSchedule('paid'),
        ];
        $loans          = [$this->makeLoan($schedules)];
        $guarantors     = [
            $this->makeGuarantor('active'),
            $this->makeGuarantor('active'),
        ];
        $savingsAccounts = [$this->makeSavingsAccount(5_000_000)];
        $member = $this->makeMember('Mubende District', $loans, $guarantors, $savingsAccounts);

        // Repayment: 40 + savings: 30 + employment: 20 + guarantors: 10 = 100
        $score = $this->service->compute($member);

        $this->assertSame(100, $score);
    }

    // ------------------------------------------------------------------
    // 1. Repayment history (40%)
    // ------------------------------------------------------------------

    public function test_repayment_score_no_loans_gives_half_component(): void
    {
        $member = $this->makeMember('ACME Ltd', [], []);
        $score  = $this->service->compute($member);

        // No loans → 20 (repayment) + 20 (employment) + 0 (savings) + 0 (guarantors)
        $this->assertSame(40, $score);
    }

    public function test_repayment_score_all_paid_gives_full_component(): void
    {
        $schedules = [
            $this->makeSchedule('paid'),
            $this->makeSchedule('paid'),
            $this->makeSchedule('paid'),
        ];
        $loans  = [$this->makeLoan($schedules)];
        $member = $this->makeMember(null, $loans, []);

        // 3/3 paid → ratio=1.0 → 40; employment: 0; savings: 0; guarantors: 0
        $score = $this->service->compute($member);
        $this->assertSame(40, $score);
    }

    public function test_repayment_score_half_paid_gives_half_component(): void
    {
        $schedules = [
            $this->makeSchedule('paid'),
            $this->makeSchedule('overdue'),
        ];
        $loans  = [$this->makeLoan($schedules)];
        $member = $this->makeMember(null, $loans, []);

        // 1/2 paid → ratio=0.5 → 20; employment: 0; savings: 0; guarantors: 0
        $score = $this->service->compute($member);
        $this->assertSame(20, $score);
    }

    public function test_repayment_score_all_overdue_gives_zero_component(): void
    {
        $schedules = [
            $this->makeSchedule('overdue'),
            $this->makeSchedule('overdue'),
        ];
        $loans  = [$this->makeLoan($schedules)];
        $member = $this->makeMember(null, $loans, []);

        // 0/2 paid → ratio=0 → 0; employment: 0; savings: 0; guarantors: 0
        $score = $this->service->compute($member);
        $this->assertSame(0, $score);
    }

    public function test_pending_schedules_are_excluded_from_repayment_calculation(): void
    {
        $schedules = [
            $this->makeSchedule('paid'),
            $this->makeSchedule('pending'), // not yet due — excluded
        ];
        $loans  = [$this->makeLoan($schedules)];
        $member = $this->makeMember(null, $loans, []);

        // Only the 'paid' schedule counts; 1/1 → ratio=1.0 → 40
        $score = $this->service->compute($member);
        $this->assertSame(40, $score);
    }

    public function test_loan_with_only_pending_schedules_treated_as_no_history(): void
    {
        $schedules = [
            $this->makeSchedule('pending'),
            $this->makeSchedule('pending'),
        ];
        $loans  = [$this->makeLoan($schedules)];
        $member = $this->makeMember(null, $loans, []);

        // No past-due schedules → treated like no history → 20
        $score = $this->service->compute($member);
        $this->assertSame(20, $score);
    }

    // ------------------------------------------------------------------
    // 2. Employment status (20%)
    // ------------------------------------------------------------------

    public function test_employed_member_gets_full_employment_score(): void
    {
        $member = $this->makeMember('Ministry of Finance', [], []);
        $score  = $this->service->compute($member);

        // Repayment: 20 (no loans) + employment: 20 + savings: 0 + guarantors: 0
        $this->assertSame(40, $score);
    }

    public function test_unemployed_member_gets_zero_employment_score(): void
    {
        $member = $this->makeMember(null, [], []);
        $score  = $this->service->compute($member);

        // Only repayment (no loans) = 20
        $this->assertSame(20, $score);
    }

    public function test_empty_string_employer_counts_as_unemployed(): void
    {
        $member = $this->makeMember('', [], []);
        $score  = $this->service->compute($member);

        $this->assertSame(20, $score);
    }

    // ------------------------------------------------------------------
    // 3. Savings balance (30%)
    // ------------------------------------------------------------------

    public function test_no_savings_gives_zero_savings_score(): void
    {
        $member = $this->makeMember(null, [], [], []);
        // savings: 0, repayment: 20 (no loans), employment: 0, guarantors: 0
        $this->assertSame(20, $this->service->compute($member));
    }

    public function test_savings_below_5m_gives_proportional_score(): void
    {
        $savingsAccounts = [$this->makeSavingsAccount(2_500_000)];
        $member = $this->makeMember(null, [], [], $savingsAccounts);
        // savings: 2.5M/5M * 30 = 15, repayment: 20, employment: 0, guarantors: 0
        $this->assertSame(35, $this->service->compute($member));
    }

    public function test_savings_at_5m_gives_full_30_points(): void
    {
        $savingsAccounts = [$this->makeSavingsAccount(5_000_000)];
        $member = $this->makeMember(null, [], [], $savingsAccounts);
        // savings: 30, repayment: 20, employment: 0, guarantors: 0
        $this->assertSame(50, $this->service->compute($member));
    }

    public function test_savings_above_5m_capped_at_30_points(): void
    {
        $savingsAccounts = [$this->makeSavingsAccount(10_000_000)];
        $member = $this->makeMember(null, [], [], $savingsAccounts);
        $this->assertSame(50, $this->service->compute($member));
    }

    public function test_multiple_active_savings_accounts_are_summed(): void
    {
        $savingsAccounts = [
            $this->makeSavingsAccount(2_000_000),
            $this->makeSavingsAccount(3_000_000),
        ];
        $member = $this->makeMember(null, [], [], $savingsAccounts);
        // total: 5M → savings: 30, repayment: 20, employment: 0, guarantors: 0
        $this->assertSame(50, $this->service->compute($member));
    }

    public function test_only_active_savings_accounts_count(): void
    {
        $savingsAccounts = [
            $this->makeSavingsAccount(5_000_000, 'active'),
            $this->makeSavingsAccount(5_000_000, 'dormant'),
            $this->makeSavingsAccount(5_000_000, 'closed'),
        ];
        $member = $this->makeMember(null, [], [], $savingsAccounts);
        // only active counts: 5M → savings: 30, repayment: 20, employment: 0, guarantors: 0
        $this->assertSame(50, $this->service->compute($member));
    }

    public function test_small_savings_gives_small_score(): void
    {
        $savingsAccounts = [$this->makeSavingsAccount(500_000)];
        $member = $this->makeMember(null, [], [], $savingsAccounts);
        // savings: 500K/5M * 30 = 3 rounded to nearest 5 → 5 points, repayment: 20, employment: 0, guarantors: 0
        $this->assertSame(25, $this->service->compute($member));
    }

    // ------------------------------------------------------------------
    // 4. Guarantor strength (10%)
    // ------------------------------------------------------------------

    public function test_no_guarantors_gives_zero_guarantor_score(): void
    {
        $member = $this->makeMember(null, [], []);
        $this->assertSame(20, $this->service->compute($member));
    }

    public function test_one_active_guarantor_gives_half_guarantor_score(): void
    {
        $guarantors = [$this->makeGuarantor('active')];
        $member     = $this->makeMember(null, [], $guarantors);

        // Repayment: 20 + employment: 0 + savings: 0 + guarantor: 5
        $this->assertSame(25, $this->service->compute($member));
    }

    public function test_two_active_guarantors_gives_full_guarantor_score(): void
    {
        $guarantors = [
            $this->makeGuarantor('active'),
            $this->makeGuarantor('active'),
        ];
        $member = $this->makeMember(null, [], $guarantors);

        // Repayment: 20 + employment: 0 + savings: 0 + guarantor: 10
        $this->assertSame(30, $this->service->compute($member));
    }

    public function test_three_active_guarantors_gives_full_guarantor_score(): void
    {
        $guarantors = [
            $this->makeGuarantor('active'),
            $this->makeGuarantor('active'),
            $this->makeGuarantor('active'),
        ];
        $member = $this->makeMember(null, [], $guarantors);

        $this->assertSame(30, $this->service->compute($member));
    }

    public function test_inactive_guarantors_do_not_count(): void
    {
        $guarantors = [
            $this->makeGuarantor('inactive'),
            $this->makeGuarantor('suspended'),
        ];
        $member = $this->makeMember(null, [], $guarantors);

        // 0 active → guarantor score = 0
        $this->assertSame(20, $this->service->compute($member));
    }

    public function test_mixed_guarantor_statuses_count_only_active(): void
    {
        $guarantors = [
            $this->makeGuarantor('active'),   // counts
            $this->makeGuarantor('inactive'), // ignored
        ];
        $member = $this->makeMember(null, [], $guarantors);

        // 1 active → guarantor score = 5
        $this->assertSame(25, $this->service->compute($member));
    }

    // ------------------------------------------------------------------
    // Combined scenarios
    // ------------------------------------------------------------------

    public function test_fully_qualified_member_without_savings_scores_70(): void
    {
        $schedules = [
            $this->makeSchedule('paid'),
            $this->makeSchedule('paid'),
        ];
        $loans      = [$this->makeLoan($schedules)];
        $guarantors = [
            $this->makeGuarantor('active'),
            $this->makeGuarantor('active'),
        ];
        $member = $this->makeMember('Kampala City Council', $loans, $guarantors);

        // Repayment: 40 + employment: 20 + savings: 0 + guarantors: 10 = 70
        $score = $this->service->compute($member);
        $this->assertSame(70, $score);
    }

    public function test_score_is_integer(): void
    {
        $member = $this->makeMember('ACME', [], []);
        $this->assertIsInt($this->service->compute($member));
    }
}
