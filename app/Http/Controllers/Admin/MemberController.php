<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Member;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class MemberController extends Controller
{
    public function index(): View
    {
        $query = Member::with('branch');

        if ($search = request('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('membership_number', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('national_id', 'like', "%{$search}%");
            });
        }

        if ($status = request('status')) {
            $query->where('status', $status);
        }

        if ($branchId = request('branch_id')) {
            $query->where('branch_id', $branchId);
        }

        $members = $query->latest()->paginate(15);
        $branches = Branch::where('is_active', true)->get();
        $statuses = ['active', 'pending', 'suspended', 'blacklisted', 'dormant', 'inactive'];

        return view('admin.members.index', compact('members', 'branches', 'statuses'));
    }

    public function create(): View
    {
        $branches = Branch::where('is_active', true)->get();
        return view('admin.members.create', compact('branches'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'membership_number' => 'required|string|max:50|unique:members,membership_number',
            'full_name' => 'required|string|max:255',
            'dob' => 'nullable|date',
            'gender' => 'nullable|string|max:10',
            'national_id' => 'nullable|string|max:50',
            'passport_number' => 'nullable|string|max:50',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'address' => 'nullable|string|max:500',
            'district' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'occupation' => 'nullable|string|max:255',
            'employer' => 'nullable|string|max:255',
            'monthly_income' => 'nullable|integer|min:0',
            'next_of_kin_name' => 'nullable|string|max:255',
            'next_of_kin_phone' => 'nullable|string|max:20',
            'next_of_kin_relationship' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'branch_id' => 'nullable|integer|exists:branches,id',
            'status' => 'nullable|string|max:50',
            'joined_at' => 'nullable|date',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('members', 'public');
        }

        if (empty($validated['status'])) {
            $validated['status'] = 'active';
        }

        if (empty($validated['joined_at'])) {
            $validated['joined_at'] = now();
        }

        Member::create($validated);

        return redirect()->route('admin.members.index')->with('success', 'Member created successfully.');
    }

    public function show(Member $member): View
    {
        $member->load('branch', 'loans', 'savingsAccounts', 'documents');
        return view('admin.members.show', compact('member'));
    }

    public function edit(Member $member): View
    {
        $branches = Branch::where('is_active', true)->get();
        return view('admin.members.edit', compact('member', 'branches'));
    }

    public function update(Request $request, Member $member): RedirectResponse
    {
        $validated = $request->validate([
            'membership_number' => 'required|string|max:50|unique:members,membership_number,' . $member->id,
            'full_name' => 'required|string|max:255',
            'dob' => 'nullable|date',
            'gender' => 'nullable|string|max:10',
            'national_id' => 'nullable|string|max:50',
            'passport_number' => 'nullable|string|max:50',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'address' => 'nullable|string|max:500',
            'district' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'occupation' => 'nullable|string|max:255',
            'employer' => 'nullable|string|max:255',
            'monthly_income' => 'nullable|integer|min:0',
            'next_of_kin_name' => 'nullable|string|max:255',
            'next_of_kin_phone' => 'nullable|string|max:20',
            'next_of_kin_relationship' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'branch_id' => 'nullable|integer|exists:branches,id',
            'status' => 'nullable|string|max:50',
            'joined_at' => 'nullable|date',
        ]);

        if ($request->hasFile('photo')) {
            if ($member->photo) {
                Storage::disk('public')->delete($member->photo);
            }
            $validated['photo'] = $request->file('photo')->store('members', 'public');
        }

        $member->update($validated);

        return redirect()->route('admin.members.index')->with('success', 'Member updated successfully.');
    }

    public function destroy(Member $member): RedirectResponse
    {
        if ($member->photo) {
            Storage::disk('public')->delete($member->photo);
        }
        $member->delete();

        return redirect()->route('admin.members.index')->with('success', 'Member deleted successfully.');
    }

    public function impersonate(Member $member): RedirectResponse
    {
        $email = $member->email ?: sprintf('member+%s@local.test', preg_replace('/[^A-Za-z0-9]/', '', $member->membership_number));

        $user = \App\Models\User::firstOrCreate([
            'email' => $email,
        ], [
            'name' => $member->full_name ?? $member->membership_number,
            'password' => \Illuminate\Support\Facades\Hash::make(strtoupper(substr($member->membership_number, -6)) . '!'),
        ]);

        session()->put('member_id', $member->id);
        \Illuminate\Support\Facades\Auth::login($user);

        return redirect()->route('member.dashboard')->with('success', 'Impersonating member: ' . $member->full_name);
    }
}
