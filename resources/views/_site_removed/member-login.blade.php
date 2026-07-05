@extends('layouts.app')

@section('title', 'Member Login')
@section('meta_description', 'Member login for Kasambya SACCO member dashboard.')

@section('content')
<div class="min-h-[calc(100vh-64px)] flex items-center justify-center bg-slate-50 py-16">
    <div class="w-full max-w-xl bg-white rounded-3xl shadow-2xl border border-slate-200 overflow-hidden">
        <div class="grid gap-6 lg:grid-cols-[1fr_1.2fr]">
            <div class="hidden lg:flex flex-col justify-center px-10 py-12 bg-emerald-600 text-white">
                <div>
                    <p class="text-sm uppercase tracking-[0.24em] font-semibold text-emerald-200">Welcome back</p>
                    <h1 class="mt-6 text-3xl font-semibold">Member Access</h1>
                    <p class="mt-4 text-slate-100 leading-relaxed">Sign in using your membership number and date of birth to review your savings, loans, and application history.</p>
                </div>
                <div class="mt-10 space-y-4 text-sm text-emerald-100">
                    <p><strong>1999 founding:</strong> Kasambya SACCO has served the community for over two decades.</p>
                    <p><strong>Savings & loans:</strong> Track your deposits, loan status, and repayment progress in one place.</p>
                    <p><strong>Member-first:</strong> Designed for members in Kasambya and surrounding districts.</p>
                </div>
            </div>

            <div class="px-8 py-10">
                <div class="mb-8">
                    <p class="text-sm text-slate-500 uppercase tracking-[0.2em]">Member Login</p>
                    <h2 class="mt-3 text-3xl font-semibold text-slate-900">Access your Kasambya SACCO dashboard</h2>
                    <p class="mt-2 text-sm text-slate-500">Use membership details to securely view your account, loans, shares, and member benefits with Kasambya SACCO.</p>
                </div>

                @if($errors->any())
                    <div class="rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700 mb-6">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('member.login.submit') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2" for="membership_number">Membership Number</label>
                        <input id="membership_number" name="membership_number" type="text" value="{{ old('membership_number') }}" placeholder="e.g. MS-2024-001" class="w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-100" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2" for="dob">Date of Birth</label>
                        <input id="dob" name="dob" type="date" value="{{ old('dob') }}" class="w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-100" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Security Check</label>
                        <div class="flex items-center gap-3">
                            <div class="rounded-full bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-800">What is {{ $a ?? '?' }} + {{ $b ?? '?' }} ?</div>
                            <input id="captcha" name="captcha" type="number" value="{{ old('captcha') }}" placeholder="Answer" class="w-32 rounded-3xl border border-slate-300 bg-white px-4 py-2 text-sm text-slate-900 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-100" required>
                        </div>
                        @error('captcha')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full rounded-3xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-emerald-500/20 transition-all hover:bg-emerald-700">Continue to Dashboard</button>
                </form>

                <div class="mt-8 border-t border-slate-200 pt-6 text-sm text-slate-500">
                    <p><strong>Need help?</strong> Contact the SACCO office at <a href="mailto:{{ $settings->get('org_email')->value ?? 'info@kasambyasacco.com' }}" class="text-emerald-600 hover:text-emerald-700">{{ $settings->get('org_email')->value ?? 'info@kasambyasacco.com' }}</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
