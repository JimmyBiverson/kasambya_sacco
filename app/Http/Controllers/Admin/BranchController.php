<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BranchController extends Controller
{
    public function index(): View
    {
        $branches = Branch::orderBy('name')->paginate(10);
        return view('admin.branches.index', compact('branches'));
    }

    public function create(): View
    {
        return view('admin.branches.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'code' => 'required|string|max:20|unique:branches,code',
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'district' => 'nullable|string|max:255',
            'region' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'manager_name' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        Branch::create($validated);

        return redirect()->route('admin.branches.index')->with('success', 'Branch created successfully.');
    }

    public function edit(Branch $branch): View
    {
        return view('admin.branches.edit', compact('branch'));
    }

    public function update(Request $request, Branch $branch): RedirectResponse
    {
        $validated = $request->validate([
            'code' => 'required|string|max:20|unique:branches,code,' . $branch->id,
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'district' => 'nullable|string|max:255',
            'region' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'manager_name' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        $branch->update($validated);

        return redirect()->route('admin.branches.index')->with('success', 'Branch updated successfully.');
    }

    public function destroy(Branch $branch): RedirectResponse
    {
        if (!auth()->user()->hasRole('Super Admin')) {
            return back()->with('error', 'Only Super Admin can delete branches.');
        }

        if ($branch->members()->exists()) {
            return back()->with('error', 'Cannot delete branch with associated members.');
        }
        if ($branch->loans()->exists()) {
            return back()->with('error', 'Cannot delete branch with associated loans.');
        }
        if ($branch->savingsAccounts()->exists()) {
            return back()->with('error', 'Cannot delete branch with associated savings accounts.');
        }
        $branch->delete();
        return redirect()->route('admin.branches.index')->with('success', 'Branch deleted successfully.');
    }
}
