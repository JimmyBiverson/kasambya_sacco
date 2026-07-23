@extends('layouts.member')

@section('title', 'Apply for Loan')
@section('page_title', 'Apply for Loan')

@section('content')

<section class="bg-gradient-to-br from-emerald-900 to-emerald-950 text-white relative overflow-hidden">
    <div class="absolute -right-24 -top-24 w-96 h-96 bg-emerald-800/15 rounded-full blur-3xl"></div>
    <div class="absolute -left-20 -bottom-20 w-96 h-96 bg-green-900/10 rounded-full blur-3xl"></div>
    <div class="px-4 lg:px-8 py-8 relative z-10">
        <div>
            <h1 class="text-2xl md:text-3xl font-black tracking-tight text-white">Apply for a Loan</h1>
            <p class="text-emerald-100/70 text-sm mt-1">Complete the form below to submit a loan application</p>
        </div>
    </div>
</section>

<section class="py-8 bg-slate-50 dark:bg-slate-900">
    <div class="px-4 lg:px-8 max-w-4xl">
        <div class="bg-white dark:bg-slate-800 rounded-2xl lg:rounded-3xl border border-slate-200 dark:border-slate-700/60 p-6 lg:p-8 shadow-sm">
            @if(session('success'))
                <div class="mb-6 bg-emerald-50 dark:bg-emerald-950 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-300 rounded-xl px-4 py-3 text-sm flex items-center gap-2">
                    <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <form action="{{ route('member.loans.store') }}" method="POST" class="space-y-5">
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
                    <label for="loan_product_id" class="site-form-label">Loan Product <span class="text-red-500">*</span></label>
                    <select id="loan_product_id" name="loan_product_id" required class="site-form-input">
                        <option value="">Select a loan product</option>
                        @foreach($loanProducts as $product)
                            <option value="{{ $product->id }}" {{ old('loan_product_id') == $product->id ? 'selected' : '' }}>{{ $product->name }} ({{ $product->interest_rate }}% interest)</option>
                        @endforeach
                    </select>
                    @error('loan_product_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="applied_amount" class="site-form-label">Loan Amount (UGX) <span class="text-red-500">*</span></label>
                        <input type="number" id="applied_amount" name="applied_amount" value="{{ old('applied_amount') }}" placeholder="Enter amount" required class="site-form-input">
                        @error('applied_amount') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="term_months" class="site-form-label">Repayment Term (Months) <span class="text-red-500">*</span></label>
                        <select id="term_months" name="term_months" required class="site-form-input">
                            <option value="3" {{ old('term_months') == 3 ? 'selected' : '' }}>3 months</option>
                            <option value="6" {{ old('term_months') == 6 ? 'selected' : '' }}>6 months</option>
                            <option value="12" {{ old('term_months') == 12 ? 'selected' : '' }} selected>12 months</option>
                            <option value="18" {{ old('term_months') == 18 ? 'selected' : '' }}>18 months</option>
                            <option value="24" {{ old('term_months') == 24 ? 'selected' : '' }}>24 months</option>
                            <option value="36" {{ old('term_months') == 36 ? 'selected' : '' }}>36 months</option>
                        </select>
                        @error('term_months') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label for="purpose" class="site-form-label">Purpose of Loan <span class="text-red-500">*</span></label>
                    <textarea id="purpose" name="purpose" rows="3" placeholder="Briefly describe the purpose of this loan" required class="site-form-input min-h-[100px]">{{ old('purpose') }}</textarea>
                    @error('purpose') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="bg-amber-50 dark:bg-amber-950 border border-amber-200 dark:border-amber-800 rounded-xl p-4 text-sm text-amber-800 dark:text-amber-300">
                    <p class="font-medium">Important Notes:</p>
                    <ul class="mt-2 space-y-1 text-xs">
                        <li>&bull; All loan applications are subject to credit assessment and approval.</li>
                        <li>&bull; Loan amounts and interest rates depend on your savings history and repayment capacity.</li>
                        <li>&bull; Processing time is typically 2-5 working days after submission.</li>
                    </ul>
                </div>

                <button type="submit" class="site-btn-primary w-full text-center py-3.5 rounded-xl">Submit Application</button>
            </form>
        </div>
    </div>
</section>

@endsection