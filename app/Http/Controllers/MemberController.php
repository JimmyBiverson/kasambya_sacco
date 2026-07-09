<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Faq;
use App\Models\Loan;
use App\Models\LoanProduct;
use App\Models\Member;
use App\Models\MemberDocument;
use App\Models\SavingsAccount;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MemberController extends Controller
{
    private function requireMember(): Member
    {
        $memberId = session('member_id');
        if (!$memberId) {
            redirect()->route('member.login')->throwResponse();
        }
        $member = Member::with(['branch', 'loans.loanProduct', 'savingsAccounts'])
            ->find($memberId);

        if (!$member) {
            redirect()->route('member.login')->throwResponse();
        }

        return $member;
    }

    public function dashboard()
    {
        $member = $this->requireMember();

        $loanSummary = $member->loans()
            ->selectRaw('status, COUNT(*) as count, SUM(disbursed_amount) as total_disbursed')
            ->groupBy('status')
            ->get();

        $activeSavings = $member->savingsAccounts()->where('status', 'active')->sum('balance');
        $totalLoaned = $member->loans()->whereIn('status', ['approved', 'disbursed'])->sum('disbursed_amount');

        $savingsAccounts = $member->savingsAccounts()->with('branch')->get();
        $loans = $member->loans()->with('loanProduct')->orderByDesc('created_at')->limit(10)->get();

        $recentTransactions = \App\Models\SavingsTransaction::whereIn(
            'savings_account_id',
            $member->savingsAccounts()->pluck('id')
        )->with('savingsAccount')
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        $totalShares = $member->shareAccounts()->sum('total_shares');

        $pendingSavingsCount = $member->savingsAccounts()->where('status', 'pending')->count();

        return view('site.member.dashboard', compact(
            'member', 'loanSummary', 'activeSavings', 'totalLoaned',
            'savingsAccounts', 'loans', 'recentTransactions', 'totalShares',
            'pendingSavingsCount'
        ));
    }

    public function savings()
    {
        $member = $this->requireMember();

        $savingsAccounts = $member->savingsAccounts()->with('branch')->get();
        $activeSavings = $member->savingsAccounts()->where('status', 'active')->sum('balance');

        return view('site.member.savings', compact('member', 'savingsAccounts', 'activeSavings'));
    }

    public function openSavings()
    {
        $member = $this->requireMember();

        $branches = Branch::where('is_active', true)->get();
        $accountTypes = ['Normal', 'Emergency', 'Holiday', 'Children', 'Education', 'Target', 'FixedDeposit', 'Locked'];

        return view('site.member.open-savings', compact('member', 'branches', 'accountTypes'));
    }

    public function storeSavings(Request $request)
    {
        $member = $this->requireMember();

        $validated = $request->validate([
            'account_type' => 'required|string|in:Normal,Emergency,Holiday,Children,Education,Target,FixedDeposit,Locked',
            'branch_id' => 'required|integer|exists:branches,id',
            'target_amount' => 'nullable|integer|min:10000|max:100000000',
            'initial_deposit' => 'nullable|integer|min:0',
        ]);

        $accountNumber = 'SAV-' . strtoupper(Str::random(8));

        while (SavingsAccount::where('account_number', $accountNumber)->exists()) {
            $accountNumber = 'SAV-' . strtoupper(Str::random(8));
        }

        $initialDeposit = $validated['initial_deposit'] ?? 0;

        $account = SavingsAccount::create([
            'member_id' => $member->id,
            'branch_id' => $validated['branch_id'],
            'account_number' => $accountNumber,
            'account_type' => $validated['account_type'],
            'balance' => $initialDeposit,
            'target_amount' => $validated['target_amount'] ?? null,
            'status' => 'pending',
        ]);

        if ($initialDeposit > 0) {
            $account->transactions()->create([
                'type' => 'deposit',
                'amount' => $initialDeposit,
                'balance_after' => $initialDeposit,
                'reference' => 'DEP-' . strtoupper(Str::random(10)),
                'description' => 'Initial deposit for account opening',
            ]);
        }

        return redirect()->route('member.savings')
            ->with('success', 'Your savings account application has been submitted for approval.');
    }

    public function loans()
    {
        $member = $this->requireMember();

        $loans = $member->loans()->with('loanProduct')->orderByDesc('created_at')->paginate(15);
        $totalLoaned = $member->loans()->whereIn('status', ['approved', 'disbursed'])->sum('disbursed_amount');
        $totalPending = $member->loans()->whereIn('status', ['pending', 'under_review'])->sum('applied_amount');

        $loanSummary = $member->loans()
            ->selectRaw('status, COUNT(*) as count, SUM(disbursed_amount) as total_disbursed')
            ->groupBy('status')
            ->get();

        return view('site.member.loans', compact('member', 'loans', 'totalLoaned', 'totalPending', 'loanSummary'));
    }

    public function transactions()
    {
        $member = $this->requireMember();

        $transactions = \App\Models\SavingsTransaction::whereIn(
            'savings_account_id',
            $member->savingsAccounts()->pluck('id')
        )->with('savingsAccount')
            ->orderByDesc('created_at')
            ->paginate(20);

        $totalDeposits = \App\Models\SavingsTransaction::whereIn(
            'savings_account_id', $member->savingsAccounts()->pluck('id')
        )->where('type', 'deposit')->sum('amount');

        $totalWithdrawals = \App\Models\SavingsTransaction::whereIn(
            'savings_account_id', $member->savingsAccounts()->pluck('id')
        )->where('type', 'withdrawal')->sum('amount');

        return view('site.member.transactions', compact('member', 'transactions', 'totalDeposits', 'totalWithdrawals'));
    }

    public function applyLoan()
    {
        $member = $this->requireMember();

        $loanProducts = LoanProduct::where('is_active', true)->get();

        return view('site.member.apply-loan', compact('member', 'loanProducts'));
    }

    public function storeLoanApplication(Request $request)
    {
        $member = $this->requireMember();

        $validated = $request->validate([
            'loan_product_id' => 'required|integer|exists:loan_products,id',
            'applied_amount' => 'required|integer|min:50000|max:50000000',
            'term_months' => 'required|integer|min:1|max:60',
            'purpose' => 'nullable|string|max:1000',
        ]);

        $loanProduct = LoanProduct::findOrFail($validated['loan_product_id']);

        $applicationNumber = 'LN-' . date('Ymd') . '-' . strtoupper(Str::random(6));

        Loan::create([
            'member_id' => $member->id,
            'loan_product_id' => $loanProduct->id,
            'branch_id' => $member->branch_id,
            'application_number' => $applicationNumber,
            'applied_amount' => $validated['applied_amount'],
            'term_months' => $validated['term_months'],
            'interest_rate' => $loanProduct->interest_rate,
            'purpose' => $validated['purpose'],
            'disbursement_method' => 'bank',
            'status' => 'pending',
        ]);

        return redirect()->route('member.loans')
            ->with('success', 'Your loan application #' . $applicationNumber . ' has been submitted for review.');
    }

    public function msacco()
    {
        $member = $this->requireMember();

        return view('site.member.msacco', compact('member'));
    }

    public function support()
    {
        $member = $this->requireMember();

        $faqs = Faq::where('is_published', true)->orderBy('sort_order')->get();

        return view('site.member.support', compact('member', 'faqs'));
    }

    public function profile()
    {
        $member = $this->requireMember();

        return view('site.member.profile', compact('member'));
    }

    public function updateProfile(Request $request)
    {
        $member = $this->requireMember();

        $validated = $request->validate([
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:500',
            'district' => 'nullable|string|max:255',
            'occupation' => 'nullable|string|max:255',
            'employer' => 'nullable|string|max:255',
            'monthly_income' => 'nullable|integer|min:0',
            'next_of_kin_name' => 'nullable|string|max:255',
            'next_of_kin_phone' => 'nullable|string|max:20',
            'next_of_kin_relationship' => 'nullable|string|max:255',
        ]);

        $member->update($validated);

        return redirect()->route('member.profile')
            ->with('success', 'Profile updated successfully.');
    }

    public function documents()
    {
        $member = $this->requireMember();

        $documents = $member->documents()->latest()->paginate(15);

        return view('site.member.documents', compact('member', 'documents'));
    }

    public function uploadDocument(Request $request)
    {
        $member = $this->requireMember();

        $validated = $request->validate([
            'type' => 'required|string|in:NationalID,Passport,EmploymentLetter,Other',
            'file' => 'required|file|mimes:jpeg,png,jpg,pdf,doc,docx|max:5120',
            'expiry_date' => 'nullable|date',
        ]);

        $filePath = $request->file('file')->store('member-documents/' . $member->id, 'public');

        MemberDocument::create([
            'member_id' => $member->id,
            'type' => $validated['type'],
            'file_path' => $filePath,
            'expiry_date' => $validated['expiry_date'] ?? null,
            'status' => 'pending',
        ]);

        return redirect()->route('member.documents')
            ->with('success', 'Document uploaded successfully and is pending admin approval.');
    }
}
