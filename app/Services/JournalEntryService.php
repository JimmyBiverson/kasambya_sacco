<?php

namespace App\Services;

use App\Models\ChartOfAccount;
use App\Models\JournalEntry;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * JournalEntryService — posts balanced double-entry journal entries.
 */
class JournalEntryService
{
    /**
     * Post a balanced journal entry.
     *
     * Each element of $lines must have the keys:
     *   - account_code  (string)  — CoA account code, e.g. "1100" for Loans Receivable
     *   - description   (string)  — optional line description
     *   - debit         (int)     — amount in UGX (0 if credit side)
     *   - credit        (int)     — amount in UGX (0 if debit side)
     *
     * $meta may contain:
     *   - date         (string)   — ISO date, defaults to today
     *   - description  (string)   — journal entry description
     *   - reference    (string)   — unique reference (auto-generated if absent)
     *   - posted_by    (int)      — user_id posting this entry
     *
     * @param  array<int, array{account_code: string, description?: string, debit: int, credit: int}>  $lines
     * @param  array<string, mixed>  $meta
     * @return int  The ID of the created journal_entries row
     *
     * @throws \RuntimeException  If debit total ≠ credit total
     */
    public function post(array $lines, array $meta = []): int
    {
        $totalDebit  = (int) array_sum(array_column($lines, 'debit'));
        $totalCredit = (int) array_sum(array_column($lines, 'credit'));

        if ($totalDebit !== $totalCredit) {
            throw new \RuntimeException(
                "JournalEntryService: Unbalanced entry — debit {$totalDebit} ≠ credit {$totalCredit}."
            );
        }

        return DB::transaction(function () use ($lines, $meta): int {
            $reference = $meta['reference'] ?? 'JE-' . strtoupper(Str::random(10));
            $date      = $meta['date'] ?? now()->toDateString();
            $postedBy  = array_key_exists('posted_by', $meta) && $meta['posted_by'] !== null
                ? $meta['posted_by']
                : (auth()->id() ?? 1);

            $entry = JournalEntry::create([
                'date'        => $date,
                'reference'   => $reference,
                'description' => $meta['description'] ?? '',
                'posted_by'   => $postedBy,
                'is_posted'   => true,
            ]);

            foreach ($lines as $line) {
                $account = isset($line['account_code'])
                    ? ChartOfAccount::where('code', $line['account_code'])->first()
                    : null;

                $entry->lines()->create([
                    'account_id'  => $account?->id,
                    'debit'       => (int) ($line['debit'] ?? 0),
                    'credit'      => (int) ($line['credit'] ?? 0),
                    'description' => $line['description'] ?? null,
                ]);
            }

            return $entry->id;
        });
    }

    /**
     * Post a loan disbursement journal entry.
     *
     * Dr  Loans Receivable   (disbursed_amount)
     * Cr  Disbursement A/C   (disbursed_amount)
     *
     * Account codes:
     *   "1100" — Loans Receivable (Asset)
     *   "1010" — Cash / Vault (for cash disbursements)
     *   "1020" — Bank Account (for bank transfer disbursements)
     *   "1030" — MTN MoMo Wallet (for mtn_momo disbursements)
     *   "1040" — Airtel Money Wallet (for airtel_money disbursements)
     *
     * @param  int     $amount               Disbursed amount in UGX
     * @param  string  $disbursementMethod   cash|bank|mtn_momo|airtel_money
     * @param  string  $reference            Loan application number
     * @param  int     $loanId               Loan primary key
     * @param  int     $postedBy             User ID
     * @return int|null
     */
    public function postLoanDisbursement(
        int    $amount,
        string $disbursementMethod,
        string $reference,
        int    $loanId,
        int    $postedBy,
    ): ?int {
        $disbursementAccountCode = match ($disbursementMethod) {
            'bank'         => '1020',
            'mtn_momo'     => '1030',
            'airtel_money' => '1040',
            default        => '1010',   // cash
        };

        $disbursementAccountLabel = match ($disbursementMethod) {
            'bank'         => 'Bank Account',
            'mtn_momo'     => 'MTN MoMo Wallet',
            'airtel_money' => 'Airtel Money Wallet',
            default        => 'Cash / Vault',
        };

        return $this->post(
            lines: [
                [
                    'account_code' => '1100',
                    'description'  => "Loan disbursement — {$reference}",
                    'debit'        => $amount,
                    'credit'       => 0,
                ],
                [
                    'account_code' => $disbursementAccountCode,
                    'description'  => "Loan disbursement — {$reference} via {$disbursementAccountLabel}",
                    'debit'        => 0,
                    'credit'       => $amount,
                ],
            ],
            meta: [
                'date'        => now()->toDateString(),
                'reference'   => 'DISB-' . $reference,
                'description' => "Loan disbursement ref {$reference} (loan_id={$loanId})",
                'posted_by'   => $postedBy,
            ]
        );
    }
}
