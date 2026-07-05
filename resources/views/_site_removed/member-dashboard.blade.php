@extends('layouts.app')

@section('title', 'Member Dashboard')
@section('meta_description', 'Your member dashboard for Kasambya SACCO savings, loans, and account details.')

@section('content')
<div class="bg-slate-50 min-h-[calc(100vh-64px)] pt-20 pb-16">
    <div class="max-w-6xl mx-auto px-4">
        <div class="mb-8 rounded-3xl bg-white p-8 shadow-sm border border-slate-200">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <p class="text-sm uppercase tracking-[0.22em] text-emerald-600">Member portal</p>
                    <h1 class="mt-3 text-3xl font-semibold text-slate-900">Hello, {{ $member->full_name }}</h1>
                    <p class="mt-2 text-sm text-slate-500">Welcome to your Kasambya SACCO member dashboard. View your savings balance, loan progress, and profile details all in one place.</p>
                </div>
                <div class="rounded-3xl border border-slate-200 bg-emerald-50 px-6 py-4 text-sm text-emerald-700">
                    Member since <strong>{{ optional($member->joined_at)->format('M Y') ?? 'N/A' }}</strong>
                </div>
            </div>
        </div>

        <div class="grid gap-5 xl:grid-cols-3">
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <p class="text-sm uppercase tracking-[0.2em] text-slate-400">Savings Balance</p>
                <p class="mt-4 text-3xl font-semibold text-slate-900">UGX {{ number_format($activeSavings) }}</p>
                <p class="mt-2 text-sm text-slate-500">Active savings accounts and balances.</p>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <p class="text-sm uppercase tracking-[0.2em] text-slate-400">Total Loan Disbursed</p>
                <p class="mt-4 text-3xl font-semibold text-slate-900">UGX {{ number_format($totalLoaned) }}</p>
                <p class="mt-2 text-sm text-slate-500">Total approved and disbursed loan amounts.</p>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <p class="text-sm uppercase tracking-[0.2em] text-slate-400">Membership</p>
                <p class="mt-4 text-3xl font-semibold text-slate-900">{{ $member->membership_number }}</p>
                <p class="mt-2 text-sm text-slate-500">Category: {{ $member->category ?? 'N/A' }}</p>
            </div>
        </div>

        <div class="mt-6 rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
            <div class="flex items-center justify-between gap-4 mb-6">
                <div>
                    <h2 class="text-xl font-semibold text-slate-900">Loan Summary</h2>
                    <p class="text-sm text-slate-500">A quick overview of your loan statuses.</p>
                </div>
                <form method="POST" action="{{ route('member.logout') }}">
                    @csrf
                    <button type="submit" class="rounded-full bg-slate-900 px-5 py-2 text-sm font-semibold text-white hover:bg-slate-800">Logout</button>
                </form>
            </div>

            <div class="grid gap-4 md:grid-cols-3">
                @forelse($loanSummary as $summary)
                    <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                        <p class="text-sm uppercase tracking-[0.18em] text-slate-500">{{ ucfirst($summary->status) }}</p>
                        <p class="mt-4 text-2xl font-semibold text-slate-900">{{ $summary->count }}</p>
                        <p class="mt-1 text-sm text-slate-500">UGX {{ number_format($summary->total_disbursed ?? 0) }}</p>
                    </div>
                @empty
                    <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5 md:col-span-3">
                        <p class="text-sm text-slate-500">No loan records found yet.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="mt-6 grid gap-5 xl:grid-cols-2">
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-slate-900">My Profile</h3>
                <div class="mt-5 space-y-4 text-sm text-slate-600">
                    <div class="grid grid-cols-2 gap-4">
                        <div><span class="block text-slate-500">Email</span>{{ $member->email ?? 'N/A' }}</div>
                        <div><span class="block text-slate-500">Phone</span>{{ $member->phone }}</div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div><span class="block text-slate-500">Branch</span>{{ $member->branch->name ?? 'N/A' }}</div>
                        <div><span class="block text-slate-500">Status</span>{{ ucfirst($member->status) }}</div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div><span class="block text-slate-500">Occupation</span>{{ $member->occupation ?? 'N/A' }}</div>
                        <div><span class="block text-slate-500">Employer</span>{{ $member->employer ?? 'N/A' }}</div>
                    </div>
                </div>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-slate-900">Membership Benefits</h3>
                <ul class="mt-5 space-y-3 text-sm text-slate-600">
                    <li class="rounded-2xl bg-slate-50 p-4">Access affordable loans tailored to your needs.</li>
                    <li class="rounded-2xl bg-slate-50 p-4">Grow your savings through secure accounts.</li>
                    <li class="rounded-2xl bg-slate-50 p-4">Receive priority support from Kasambya SACCO staff.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
