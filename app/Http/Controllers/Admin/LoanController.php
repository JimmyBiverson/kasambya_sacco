<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Loan;
use App\Models\LoanProduct;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LoanController extends Controller
{
    public function index(): View
    {
        $query = Loan::with('member', 'loanProduct', 'branch');

        if ($search = request('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('application_number', 'like', "%{$search}%")
                  ->orWhereHas('member', fn ($m) => $m->where('full_name', 'like', "%{$search}%"))
                  ->orWhereHas('member', fn ($m) => $m->where('membership_number', 'like', "%{$search}%"));
            });
        }

        if ($status = request('status')) {
            $query->where('status', $status);
        }

        if ($branchId = request('branch_id')) {
            $query->where('branch_id', $branchId);
        }

        if ($productId = request('loan_product_id')) {
            $query->where('loan_product_id', $productId);
        }

        $loans = $query->latest()->paginate(15);
        $branches = Branch::where('is_active', true)->get();
        $loanProducts = LoanProduct::where('is_active', true)->get();
        $statuses = ['pending', 'approved', 'disbursed', 'active', 'rejected', 'closed', 'defaulted', 'written_off'];

        return view('admin.loans.index', compact('loans', 'branches', 'loanProducts', 'statuses'));
    }

    public function show(Loan $loan): View
    {
        $loan->load('member.branch', 'loanProduct', 'branch', 'repayments', 'schedules', 'collaterals', 'approvals');
        return view('admin.loans.show', compact('loan'));
    }

    public function destroy(Loan $loan): RedirectResponse
    {
        if ($loan->repayments()->exists()) {
            return back()->with('error', 'Cannot delete loan with associated repayments.');
        }
        if ($loan->schedules()->exists()) {
            return back()->with('error', 'Cannot delete loan with associated repayment schedules.');
        }
        $loan->delete();
        return redirect()->route('admin.loans.index')->with('success', 'Loan deleted successfully.');
    }
}
