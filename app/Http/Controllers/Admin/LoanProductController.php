<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoanProduct;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class LoanProductController extends Controller
{
    public function index(): View
    {
        $loanProducts = LoanProduct::orderBy('name')->paginate(10);
        return view('admin.loan-products.index', compact('loanProducts'));
    }

    public function create(): View
    {
        return view('admin.loan-products.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:20|unique:loan_products,code',
            'description' => 'nullable|string',
            'min_amount' => 'nullable|integer|min:0',
            'max_amount' => 'nullable|integer|min:0',
            'min_term' => 'nullable|integer|min:1',
            'max_term' => 'nullable|integer|min:1',
            'interest_rate' => 'nullable|numeric|min:0',
            'interest_method' => 'nullable|string|max:50',
            'penalty_rate' => 'nullable|numeric|min:0',
            'grace_period' => 'nullable|integer|min:0',
            'processing_fee' => 'nullable|integer|min:0',
            'insurance_fee' => 'nullable|integer|min:0',
            'collateral_required' => 'boolean',
            'category' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'approval_levels' => 'nullable|array',
        ]);

        if (!isset($validated['approval_levels'])) {
            $validated['approval_levels'] = [['level' => 1, 'role' => 'Loan Officer']];
        }

        LoanProduct::create($validated);

        Cache::forget('site.loan_products.featured');
        Cache::forget('site.loan_products.all');

        return redirect()->route('admin.loan-products.index')->with('success', 'Loan product created successfully.');
    }

    public function edit(LoanProduct $loanProduct): View
    {
        return view('admin.loan-products.edit', compact('loanProduct'));
    }

    public function update(Request $request, LoanProduct $loanProduct): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:20|unique:loan_products,code,' . $loanProduct->id,
            'description' => 'nullable|string',
            'min_amount' => 'nullable|integer|min:0',
            'max_amount' => 'nullable|integer|min:0',
            'min_term' => 'nullable|integer|min:1',
            'max_term' => 'nullable|integer|min:1',
            'interest_rate' => 'nullable|numeric|min:0',
            'interest_method' => 'nullable|string|max:50',
            'penalty_rate' => 'nullable|numeric|min:0',
            'grace_period' => 'nullable|integer|min:0',
            'processing_fee' => 'nullable|integer|min:0',
            'insurance_fee' => 'nullable|integer|min:0',
            'collateral_required' => 'boolean',
            'category' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'approval_levels' => 'nullable|array',
        ]);

        if (!isset($validated['approval_levels'])) {
            $validated['approval_levels'] = [['level' => 1, 'role' => 'Loan Officer']];
        }

        $loanProduct->update($validated);

        Cache::forget('site.loan_products.featured');
        Cache::forget('site.loan_products.all');

        return redirect()->route('admin.loan-products.index')->with('success', 'Loan product updated successfully.');
    }

    public function destroy(LoanProduct $loanProduct): RedirectResponse
    {
        $loanProduct->delete();

        Cache::forget('site.loan_products.featured');
        Cache::forget('site.loan_products.all');

        return redirect()->route('admin.loan-products.index')->with('success', 'Loan product deleted successfully.');
    }
}
