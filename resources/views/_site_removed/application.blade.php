@extends('layouts.app')

@section('content')

<div class="page-header">
    <div class="max-w-7xl mx-auto px-4">
        <h1>Application</h1>
        <div class="breadcrumb mt-3">
                    <a href="{{ route('home') }}">Kasambya SACCO</a>
</div>

<section class="py-20 bg-black">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-12">
            <div class="lg:col-span-3">
                @if(session('success'))
                    <div class="border border-zinc-700 bg-zinc-900 px-6 py-4 mb-6 flex items-center gap-3">
                        <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span class="text-gray-300">{{ session('success') }}</span>
                    </div>
                @endif

                <form action="{{ route('application.submit') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="full_name" class="form-label">Full Name</label>
                        <input type="text" id="full_name" name="full_name" value="{{ old('full_name') }}" placeholder="Your full name" required class="form-input">
                        @error('full_name') <small class="text-red-500 text-sm">{{ $message }}</small> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Your email address" required class="form-input">
                            @error('email') <small class="text-red-500 text-sm">{{ $message }}</small> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Your phone number" required class="form-input">
                            @error('phone') <small class="text-red-500 text-sm">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="address" class="form-label">Address</label>
                        <textarea id="address" name="address" placeholder="Your physical address" required class="form-input min-h-[80px]">{{ old('address') }}</textarea>
                        @error('address') <small class="text-red-500 text-sm">{{ $message }}</small> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label for="dob" class="form-label">Date of Birth</label>
                            <input type="date" id="dob" name="dob" value="{{ old('dob') }}" required class="form-input">
                            @error('dob') <small class="text-red-500 text-sm">{{ $message }}</small> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="occupation" class="form-label">Occupation</label>
                            <input type="text" id="occupation" name="occupation" value="{{ old('occupation') }}" placeholder="Your occupation" required class="form-input">
                            @error('occupation') <small class="text-red-500 text-sm">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label for="employer" class="form-label">Employer</label>
                            <input type="text" id="employer" name="employer" value="{{ old('employer') }}" placeholder="Your employer name" class="form-input">
                            @error('employer') <small class="text-red-500 text-sm">{{ $message }}</small> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="monthly_income" class="form-label">Monthly Income</label>
                            <input type="number" id="monthly_income" name="monthly_income" value="{{ old('monthly_income') }}" placeholder="Your monthly income" step="0.01" required class="form-input">
                            @error('monthly_income') <small class="text-red-500 text-sm">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="product_type" class="form-label">Product Type</label>
                        <select id="product_type" name="product_type" required class="form-input">
                            <option value="" class="bg-zinc-900">Select a product type</option>
                            <option value="Trade & Commerce Loan" {{ old('product_type') == 'Trade & Commerce Loan' ? 'selected' : '' }} class="bg-zinc-900">Trade & Commerce Loan</option>
                            <option value="Housing Loan" {{ old('product_type') == 'Housing Loan' ? 'selected' : '' }} class="bg-zinc-900">Housing Loan</option>
                            <option value="School Fees Loan" {{ old('product_type') == 'School Fees Loan' ? 'selected' : '' }} class="bg-zinc-900">School Fees Loan</option>
                            <option value="Automatic Loan" {{ old('product_type') == 'Automatic Loan' ? 'selected' : '' }} class="bg-zinc-900">Automatic Loan</option>
                            <option value="Emergency Loan" {{ old('product_type') == 'Emergency Loan' ? 'selected' : '' }} class="bg-zinc-900">Emergency Loan</option>
                            <option value="Asset Acquisition Loan" {{ old('product_type') == 'Asset Acquisition Loan' ? 'selected' : '' }} class="bg-zinc-900">Asset Acquisition Loan</option>
                            <option value="Environmental Loan" {{ old('product_type') == 'Environmental Loan' ? 'selected' : '' }} class="bg-zinc-900">Environmental Loan</option>
                            <option value="Agriculture Loan" {{ old('product_type') == 'Agriculture Loan' ? 'selected' : '' }} class="bg-zinc-900">Agriculture Loan</option>
                            <option value="Transport Loan" {{ old('product_type') == 'Transport Loan' ? 'selected' : '' }} class="bg-zinc-900">Transport Loan</option>
                        </select>
                        @error('product_type') <small class="text-red-500 text-sm">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="account_type" class="form-label">Account Type</label>
                        <select id="account_type" name="account_type" required class="form-input">
                            <option value="" class="bg-zinc-900">Select an account type</option>
                            <option value="Voluntary Savings" {{ old('account_type') == 'Voluntary Savings' ? 'selected' : '' }} class="bg-zinc-900">Voluntary Savings</option>
                            <option value="Minor Account" {{ old('account_type') == 'Minor Account' ? 'selected' : '' }} class="bg-zinc-900">Minor Account</option>
                            <option value="Associate Account" {{ old('account_type') == 'Associate Account' ? 'selected' : '' }} class="bg-zinc-900">Associate Account</option>
                            <option value="Fixed Savings" {{ old('account_type') == 'Fixed Savings' ? 'selected' : '' }} class="bg-zinc-900">Fixed Savings</option>
                            <option value="Share Savings" {{ old('account_type') == 'Share Savings' ? 'selected' : '' }} class="bg-zinc-900">Share Savings</option>
                            <option value="Joint Account" {{ old('account_type') == 'Joint Account' ? 'selected' : '' }} class="bg-zinc-900">Joint Account</option>
                            <option value="Individual Account" {{ old('account_type') == 'Individual Account' ? 'selected' : '' }} class="bg-zinc-900">Individual Account</option>
                            <option value="Group Account" {{ old('account_type') == 'Group Account' ? 'selected' : '' }} class="bg-zinc-900">Group Account</option>
                            <option value="Institutional Account" {{ old('account_type') == 'Institutional Account' ? 'selected' : '' }} class="bg-zinc-900">Institutional Account</option>
                        </select>
                        @error('account_type') <small class="text-red-500 text-sm">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-6">
                        <label for="additional_message" class="form-label">Additional Message</label>
                        <textarea id="additional_message" name="additional_message" placeholder="Any additional information or message" class="form-input min-h-[80px]">{{ old('additional_message') }}</textarea>
                        @error('additional_message') <small class="text-red-500 text-sm">{{ $message }}</small> @enderror
                    </div>

                    <button type="submit" class="btn-primary text-base px-8 py-3">Submit Application</button>
                </form>
            </div>

            <div class="lg:col-span-2">
                <h3 class="text-white font-bold text-xl mb-6 border-b border-zinc-800 pb-3">Membership Requirements</h3>

                <div class="border border-zinc-800 p-6 mb-4">
                    <h4 class="text-white font-semibold mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="23"/><line x1="8" y1="23" x2="16" y2="23"/></svg>
                        Voluntary Savings Account
                    </h4>
                    <ul class="space-y-2 text-sm text-gray-500">
                        <li class="flex items-baseline gap-2"><span class="text-gray-400">-</span> UGX 60,000 minimum deposit</li>
                        <li class="flex items-baseline gap-2"><span class="text-gray-400">-</span> 3 passport photos</li>
                        <li class="flex items-baseline gap-2"><span class="text-gray-400">-</span> National ID copy</li>
                        <li class="flex items-baseline gap-2"><span class="text-gray-400">-</span> LC1 letter of recommendation</li>
                    </ul>
                </div>

                <div class="border border-zinc-800 p-6 mb-4">
                    <h4 class="text-white font-semibold mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        Minor Account
                    </h4>
                    <ul class="space-y-2 text-sm text-gray-500">
                        <li class="flex items-baseline gap-2"><span class="text-gray-400">-</span> UGX 20,000 minimum deposit</li>
                        <li class="flex items-baseline gap-2"><span class="text-gray-400">-</span> Passport photos</li>
                        <li class="flex items-baseline gap-2"><span class="text-gray-400">-</span> For children under 18 years</li>
                        <li class="flex items-baseline gap-2"><span class="text-gray-400">-</span> Parent or guardian required</li>
                    </ul>
                </div>

                <div class="border border-zinc-800 p-6 mb-4">
                    <h4 class="text-white font-semibold mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        Associate Account
                    </h4>
                    <ul class="space-y-2 text-sm text-gray-500">
                        <li class="flex items-baseline gap-2"><span class="text-gray-400">-</span> UGX 30,000 minimum deposit</li>
                        <li class="flex items-baseline gap-2"><span class="text-gray-400">-</span> National ID copy</li>
                        <li class="flex items-baseline gap-2"><span class="text-gray-400">-</span> Passport photos</li>
                        <li class="flex items-baseline gap-2"><span class="text-gray-400">-</span> LC1 letter of recommendation</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
