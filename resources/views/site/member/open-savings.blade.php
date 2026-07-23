@extends('layouts.member')

@section('title', 'Open Savings Account')
@section('page_title', 'Open Savings Account')

@section('content')

<section class="bg-gradient-to-br from-emerald-900 to-emerald-950 text-white relative overflow-hidden">
    <div class="absolute -right-24 -top-24 w-96 h-96 bg-emerald-800/15 rounded-full blur-3xl"></div>
    <div class="absolute -left-20 -bottom-20 w-96 h-96 bg-green-900/10 rounded-full blur-3xl"></div>
    <div class="px-4 lg:px-8 py-8 relative z-10">
        <div>
            <h1 class="text-2xl md:text-3xl font-black tracking-tight text-white">Open a Savings Account</h1>
            <p class="text-emerald-100/70 text-sm mt-1">Choose an account type and submit for approval</p>
        </div>
    </div>
</section>

<section class="py-8 bg-slate-50 dark:bg-slate-900">
    <div class="px-4 lg:px-8 max-w-3xl">
        <div class="bg-white dark:bg-slate-800 rounded-2xl lg:rounded-3xl border border-slate-200/60 dark:border-slate-700/60 p-6 lg:p-8 shadow-sm">
            <form action="{{ route('member.savings.store') }}" method="POST" class="space-y-5">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="site-form-label">Full Name</label>
                        <input type="text" value="{{ $member->full_name }}" readonly class="site-form-input bg-slate-50 dark:bg-slate-900 text-slate-600 dark:text-slate-400">
                    </div>
                    <div>
                        <label class="site-form-label">Membership Number</label>
                        <input type="text" value="{{ $member->membership_number }}" readonly class="site-form-input bg-slate-50 dark:bg-slate-900 text-slate-600 dark:text-slate-400">
                    </div>
                </div>

                <div>
                    <label for="account_type" class="site-form-label">Account Type <span class="text-red-500">*</span></label>
                    <select id="account_type" name="account_type" required class="site-form-input">
                        <option value="">Select account type</option>
                        @foreach($accountTypes as $type)
                            <option value="{{ $type }}" {{ old('account_type') === $type ? 'selected' : '' }}>{{ $type }}</option>
                        @endforeach
                    </select>
                    @error('account_type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="branch_id" class="site-form-label">Preferred Branch <span class="text-red-500">*</span></label>
                    <select id="branch_id" name="branch_id" required class="site-form-input">
                        <option value="">Select branch</option>
                        @foreach($branches as $branch)
                            <option value="{{ $branch->id }}" {{ old('branch_id') == $branch->id ? 'selected' : '' }}>{{ $branch->name }} — {{ $branch->district ?? 'N/A' }}</option>
                        @endforeach
                    </select>
                    @error('branch_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div x-data="{ showTarget: false }">
                    <div>
                        <label for="account_type" class="site-form-label">Target Amount (UGX)</label>
                        <input type="number" id="target_amount" name="target_amount" value="{{ old('target_amount') }}" placeholder="Optional — set a savings goal" class="site-form-input">
                        @error('target_amount') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        <p class="text-xs text-slate-600 dark:text-slate-400 mt-1">Set a target if you're opening a Target or Education account</p>
                    </div>
                </div>

                <div>
                    <label for="initial_deposit" class="site-form-label">Initial Deposit (UGX)</label>
                    <input type="number" id="initial_deposit" name="initial_deposit" value="{{ old('initial_deposit', 0) }}" placeholder="Optional initial deposit" class="site-form-input">
                    @error('initial_deposit') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    <p class="text-xs text-slate-600 dark:text-slate-400 mt-1">You can make an initial deposit now that will be available once the account is approved.</p>
                </div>

                <div class="bg-amber-50 dark:bg-amber-950 border border-amber-200 dark:border-amber-800 rounded-xl p-4 text-sm text-amber-800 dark:text-amber-300">
                    <p class="font-medium">What happens next?</p>
                    <ul class="mt-2 space-y-1 text-xs">
                        <li>&bull; Your application will be submitted for admin approval.</li>
                        <li>&bull; Once approved, the account will become active and visible in your savings list.</li>
                        <li>&bull; You'll be notified when the account is approved.</li>
                        <li>&bull; Any initial deposit made will be available after approval.</li>
                    </ul>
                </div>

                <button type="submit" class="site-btn-primary w-full text-center py-3.5 rounded-xl text-sm font-bold">
                    Submit for Approval
                </button>
            </form>
        </div>
    </div>
</section>

@endsection
