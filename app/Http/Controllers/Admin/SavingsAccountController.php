<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\SavingsAccount;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SavingsAccountController extends Controller
{
    public function index(): View
    {
        $query = SavingsAccount::with('member', 'branch');

        if ($search = request('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('account_number', 'like', "%{$search}%")
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

        $pendingCount = SavingsAccount::where('status', 'pending')->count();
        $accounts = $query->latest()->paginate(15);
        $branches = Branch::where('is_active', true)->get();
        $statuses = ['pending', 'active', 'dormant', 'frozen', 'closed'];

        return view('admin.savings.index', compact('accounts', 'branches', 'statuses', 'pendingCount'));
    }

    public function show(SavingsAccount $savings): View
    {
        $savings->load('member.branch', 'branch', 'transactions', 'approvedBy');
        return view('admin.savings.show', compact('savings'));
    }

    public function approve(Request $request, SavingsAccount $savings): RedirectResponse
    {
        if ($savings->status !== 'pending') {
            return back()->with('error', 'Only pending accounts can be approved.');
        }

        $savings->update([
            'status' => 'active',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        return redirect()->route('admin.savings.index')
            ->with('success', 'Savings account #' . $savings->account_number . ' has been approved.');
    }

    public function reject(Request $request, SavingsAccount $savings): RedirectResponse
    {
        if ($savings->status !== 'pending') {
            return back()->with('error', 'Only pending accounts can be rejected.');
        }

        $savings->update([
            'status' => 'closed',
        ]);

        return redirect()->route('admin.savings.index')
            ->with('success', 'Savings account #' . $savings->account_number . ' has been rejected.');
    }
}
