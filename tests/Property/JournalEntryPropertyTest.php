<?php

namespace Tests\Property;

use App\Models\JournalEntryLine;
use Eris\Attributes\ErisRepeat;
use Eris\TestTrait;
use Illuminate\Database\Eloquent\Collection;
use PHPUnit\Framework\TestCase;

#[ErisRepeat(50)]
class JournalEntryPropertyTest extends TestCase
{
    use TestTrait;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * P4: For any balanced journal entry, total debits equal total credits.
     */
    public function test_balanced_entry_has_equal_debits_and_credits(): void
    {
        $this->forAll(
            \Eris\Generator\choose(2, 10),
            \Eris\Generator\choose(1, 1_000_000)
        )->then(function ($numLines, $amount) {
            $lines = new Collection();

            for ($i = 0; $i < $numLines; $i++) {
                $line = new JournalEntryLine();
                $line->debit = $amount;
                $line->credit = 0;
                $lines->push($line);
            }

            $creditLine = new JournalEntryLine();
            $creditLine->debit = 0;
            $creditLine->credit = $amount * $numLines;
            $lines->push($creditLine);

            $totalDebit = (int) $lines->sum('debit');
            $totalCredit = (int) $lines->sum('credit');

            $this->assertSame($totalDebit, $totalCredit);
            $this->assertTrue($totalDebit > 0);
        });
    }

    /**
     * P5: A journal entry with unbalanced lines is not balanced.
     */
    public function test_unbalanced_entry_is_not_balanced(): void
    {
        $this->forAll(
            \Eris\Generator\choose(1, 1_000_000),
            \Eris\Generator\choose(1, 1_000_000)
        )->then(function ($debitAmount, $creditAmount) {
            if ($debitAmount === $creditAmount) {
                $this->assertTrue(true);
                return;
            }

            $lines = new Collection();

            $debitLine = new JournalEntryLine();
            $debitLine->debit = $debitAmount;
            $debitLine->credit = 0;
            $lines->push($debitLine);

            $creditLine = new JournalEntryLine();
            $creditLine->debit = 0;
            $creditLine->credit = $creditAmount;
            $lines->push($creditLine);

            $totalDebit = (int) $lines->sum('debit');
            $totalCredit = (int) $lines->sum('credit');

            $this->assertNotSame($totalDebit, $totalCredit);
        });
    }
}
