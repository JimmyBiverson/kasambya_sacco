@extends('layouts.member')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')

<!-- Welcome Header -->
<section class="bg-gradient-to-br from-emerald-900 to-emerald-950 text-white relative overflow-hidden">
    <div class="absolute -right-24 -top-24 w-96 h-96 bg-emerald-800/15 rounded-full blur-3xl"></div>
    <div class="absolute -left-20 -bottom-20 w-96 h-96 bg-green-900/10 rounded-full blur-3xl"></div>
    <div class="px-4 lg:px-8 py-8 relative z-10">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-black tracking-tight text-white">Welcome back, <span class="text-emerald-300">{{ $member->full_name ?? $member->membership_number }}</span></h1>
                <p class="text-emerald-100/70 text-sm mt-1">Membership #{{ $member->membership_number }} &middot; Joined {{ $member->joined_at?->format('M Y') ?? 'N/A' }}</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('member.apply-loan') }}" class="inline-block bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold px-6 py-3 rounded-xl transition-all duration-300 hover:scale-105 shadow-lg shadow-emerald-950/20">Apply for Loan</a>
            </div>
        </div>
    </div>
</section>

<section class="py-8 bg-slate-50 dark:bg-slate-900 dark:bg-slate-900" x-data="{ tab: 'savings' }">
    <div class="px-4 lg:px-8">

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 lg:gap-6 mb-8">
            <div class="glass-card dark:bg-slate-800/80 dark:border-slate-700/50 p-5 lg:p-6 rounded-2xl lg:rounded-3xl border border-slate-200 dark:border-slate-700/50 flex flex-col justify-between hover-scale">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <p class="text-[10px] lg:text-xs uppercase tracking-[0.15em] text-slate-600 dark:text-slate-400 font-bold">Active Savings</p>
                        <div class="w-8 h-8 rounded-lg bg-emerald-50 dark:bg-emerald-950 border border-emerald-100 dark:border-emerald-800 flex items-center justify-center text-emerald-600 dark:text-emerald-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                        </div>
                    </div>
                    <p class="text-xl lg:text-2xl font-black text-slate-900 dark:text-white font-sans">UGX {{ number_format($activeSavings, 2) }}</p>
                </div>
                <div class="mt-3 lg:mt-4">
                    <p class="text-[10px] text-slate-600 dark:text-slate-400 font-medium">Available balance</p>
                    <div class="mt-1.5 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full bg-emerald-50 dark:bg-emerald-950 rounded-full" style="width: min({{ $activeSavings > 0 ? 100 : 0 }}%, 100%)"></div>
                    </div>
                </div>
            </div>

            <div class="glass-card dark:bg-slate-800/80 dark:border-slate-700/50 p-5 lg:p-6 rounded-2xl lg:rounded-3xl border border-slate-200 dark:border-slate-700/50 flex flex-col justify-between hover-scale">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <p class="text-[10px] lg:text-xs uppercase tracking-[0.15em] text-slate-600 dark:text-slate-400 font-bold">Total Loans</p>
                        <div class="w-8 h-8 rounded-lg bg-blue-50 dark:bg-blue-950 border border-blue-100 dark:border-blue-800 flex items-center justify-center text-blue-600 dark:text-blue-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </div>
                    </div>
                    <p class="text-xl lg:text-2xl font-black text-slate-900 dark:text-white font-sans">UGX {{ number_format($totalLoaned, 2) }}</p>
                </div>
                <div class="mt-3 lg:mt-4">
                    <p class="text-[10px] text-slate-600 dark:text-slate-400 font-medium">Approved Principal</p>
                    <div class="mt-1.5 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full bg-blue-50 dark:bg-blue-950 rounded-full" style="width: min({{ $totalLoaned > 0 ? 100 : 0 }}%, 100%)"></div>
                    </div>
                </div>
            </div>

            <div class="glass-card dark:bg-slate-800/80 dark:border-slate-700/50 p-5 lg:p-6 rounded-2xl lg:rounded-3xl border border-slate-200 dark:border-slate-700/50 flex flex-col justify-between hover-scale">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <p class="text-[10px] lg:text-xs uppercase tracking-[0.15em] text-slate-600 dark:text-slate-400 font-bold">Shares Held</p>
                        <div class="w-8 h-8 rounded-lg bg-purple-50 dark:bg-purple-950 border border-purple-100 dark:border-purple-800 flex items-center justify-center text-purple-600 dark:text-purple-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                        </div>
                    </div>
                    <p class="text-xl lg:text-2xl font-black text-slate-900 dark:text-white font-sans">{{ number_format($totalShares) }} Shares</p>
                </div>
                <div class="mt-3 lg:mt-4">
                    <p class="text-[10px] text-slate-600 dark:text-slate-400 font-medium">Cooperative Equity</p>
                    <div class="mt-1.5 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full bg-purple-50 dark:bg-purple-950 rounded-full" style="width: min({{ $totalShares > 0 ? 100 : 0 }}%, 100%)"></div>
                    </div>
                </div>
            </div>

            <div class="glass-card dark:bg-slate-800/80 dark:border-slate-700/50 p-5 lg:p-6 rounded-2xl lg:rounded-3xl border border-slate-200 dark:border-slate-700/50 flex flex-col justify-between hover-scale">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <p class="text-[10px] lg:text-xs uppercase tracking-[0.15em] text-slate-600 dark:text-slate-400 font-bold">Registered Branch</p>
                        <div class="w-8 h-8 rounded-lg bg-amber-50 dark:bg-amber-950 border border-amber-100 dark:border-amber-800 flex items-center justify-center text-amber-600 dark:text-amber-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                    </div>
                    <p class="text-base lg:text-lg font-bold text-slate-800 dark:text-slate-200 truncate">{{ $member->branch?->name ?? 'N/A' }}</p>
                </div>
                <div class="mt-3 lg:mt-4 flex items-center justify-between">
                    <p class="text-[10px] text-slate-600 dark:text-slate-400 font-medium font-sans">Account status</p>
                    <span class="inline-block text-[10px] font-bold px-2.5 py-0.5 rounded-full uppercase border {{ $member->status === 'active' ? 'bg-emerald-50 dark:bg-emerald-950 border-emerald-200 dark:border-emerald-800 text-emerald-700 dark:text-emerald-400' : 'bg-amber-50 dark:bg-amber-950 border-amber-200 dark:border-amber-800 text-amber-700 dark:text-amber-400' }}">
                        {{ $member->status }}
                    </span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 lg:gap-8">

            <!-- Main Content -->
            <div class="xl:col-span-2 space-y-6">

                <!-- Tab Navigation -->
                <div class="bg-white dark:bg-slate-800 rounded-2xl lg:rounded-3xl border border-slate-200 dark:border-slate-700/60 overflow-hidden shadow-sm">
                    <div class="flex border-b border-slate-200 dark:border-slate-700/60 p-2 bg-slate-50 dark:bg-slate-900 gap-2 overflow-x-auto">
                        <button @click="tab = 'savings'" :class="tab === 'savings' ? 'bg-white dark:bg-slate-800 text-emerald-600 dark:text-emerald-400 shadow shadow-slate-100 border border-slate-100 dark:border-slate-700' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:text-white'" class="px-4 lg:px-5 py-2.5 lg:py-3 text-xs lg:text-sm font-bold rounded-xl lg:rounded-2xl transition-all duration-200 cursor-pointer whitespace-nowrap">Savings Accounts</button>
                        <button @click="tab = 'loans'" :class="tab === 'loans' ? 'bg-white dark:bg-slate-800 text-emerald-600 dark:text-emerald-400 shadow shadow-slate-100 border border-slate-100 dark:border-slate-700' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:text-white'" class="px-4 lg:px-5 py-2.5 lg:py-3 text-xs lg:text-sm font-bold rounded-xl lg:rounded-2xl transition-all duration-200 cursor-pointer whitespace-nowrap">Loans</button>
                        <button @click="tab = 'transactions'" :class="tab === 'transactions' ? 'bg-white dark:bg-slate-800 text-emerald-600 dark:text-emerald-400 shadow shadow-slate-100 border border-slate-100 dark:border-slate-700' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:text-white'" class="px-4 lg:px-5 py-2.5 lg:py-3 text-xs lg:text-sm font-bold rounded-xl lg:rounded-2xl transition-all duration-200 cursor-pointer whitespace-nowrap">Recent Transactions</button>
                    </div>

                    <div x-show="tab === 'savings'" class="p-4 lg:p-6">
                        @if($savingsAccounts->count())
                            <div class="space-y-3 lg:space-y-4">
                                @foreach($savingsAccounts as $account)
                                    <div class="border border-slate-100 dark:border-slate-700 p-4 lg:p-5 rounded-xl lg:rounded-2xl hover:border-emerald-200 dark:border-emerald-800 hover:bg-emerald-50 dark:bg-emerald-950/10 transition-all duration-300">
                                        <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-2">
                                            <div>
                                                <p class="font-bold text-slate-800 dark:text-slate-200 text-sm lg:text-base">{{ $account->account_type }} Account</p>
                                                <p class="text-xs text-slate-600 dark:text-slate-400 font-medium mt-1 font-mono">{{ $account->account_number }} @if($account->branch) | {{ $account->branch->name }} @endif</p>
                                            </div>
                                            <span class="text-[10px] font-bold px-2.5 py-0.5 rounded-full capitalize border self-start {{ $account->status === 'active' ? 'bg-emerald-50 dark:bg-emerald-950 border-emerald-100 dark:border-emerald-800 text-emerald-700 dark:text-emerald-400' : 'bg-slate-50 dark:bg-slate-900 border-slate-100 dark:border-slate-700 text-slate-600 dark:text-slate-400' }}">{{ $account->status }}</span>
                                        </div>
                                        <div class="mt-3 lg:mt-4 flex flex-col sm:flex-row items-stretch sm:items-end justify-between gap-4">
                                            <div>
                                                <p class="text-[10px] uppercase font-bold text-slate-600 dark:text-slate-400 tracking-wider">Balance</p>
                                                <p class="text-xl lg:text-2xl font-black text-slate-950 mt-1 font-sans">UGX {{ number_format($account->balance, 2) }}</p>
                                            </div>
                                            @if($account->target_amount)
                                                <div class="text-left sm:text-right flex-1 sm:max-w-[200px]">
                                                    <p class="text-[10px] text-slate-600 dark:text-slate-400 font-medium">Target: UGX {{ number_format($account->target_amount, 2) }}</p>
                                                    <div class="mt-2 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                                        <div class="h-full bg-emerald-50 dark:bg-emerald-950 rounded-full" style="width: {{ min(($account->balance / max($account->target_amount, 1)) * 100, 100) }}%"></div>
                                                    </div>
                                                    <p class="text-[9px] text-slate-600 dark:text-slate-400 text-right mt-1">{{ number_format(min(($account->balance / max($account->target_amount, 1)) * 100, 100), 1) }}% Met</p>
                                                </div>
                                            @endif
                                        </div>
                                        <a href="{{ route('member.transactions') }}" class="text-xs text-emerald-600 dark:text-emerald-400 font-medium mt-3 inline-block hover:text-emerald-700 dark:text-emerald-400">View Transactions &rarr;</a>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mt-4 text-center">
                                <a href="{{ route('member.savings') }}" class="text-sm text-emerald-600 dark:text-emerald-400 font-bold hover:text-emerald-700 dark:text-emerald-400 transition-colors">View All Savings Accounts &rarr;</a>
                            </div>
                        @else
                            <div class="text-center py-12">
                                <p class="text-slate-600 dark:text-slate-400">No savings accounts found.</p>
                            </div>
                        @endif
                    </div>

                    <div x-show="tab === 'loans'" class="p-4 lg:p-6" x-cloak>
                        @if($loans->count())
                            <div class="space-y-3 lg:space-y-4">
                                @foreach($loans as $loan)
                                    <div class="border border-slate-100 dark:border-slate-700 p-4 lg:p-5 rounded-xl lg:rounded-2xl hover:border-blue-200 hover:bg-blue-50 dark:bg-blue-950/10 transition-all duration-300">
                                        <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-2">
                                            <div>
                                                <p class="font-bold text-slate-800 dark:text-slate-200 text-sm lg:text-base">{{ $loan->loanProduct?->name ?? 'Loan' }}</p>
                                                <p class="text-xs text-slate-600 dark:text-slate-400 font-medium mt-1 font-mono">{{ $loan->application_number ?? 'N/A' }} | Term: {{ $loan->term_months ?? 0 }} months</p>
                                            </div>
                                            <span class="text-[10px] font-bold px-2.5 py-0.5 rounded-full capitalize border self-start
                                                {{ $loan->status === 'approved' ? 'bg-emerald-50 dark:bg-emerald-950 border-emerald-100 dark:border-emerald-800 text-emerald-700 dark:text-emerald-400' : '' }}
                                                {{ $loan->status === 'pending' ? 'bg-amber-50 dark:bg-amber-950 border-amber-100 dark:border-amber-800 text-amber-700 dark:text-amber-400' : '' }}
                                                {{ $loan->status === 'disbursed' ? 'bg-blue-50 dark:bg-blue-950 border-blue-100 dark:border-blue-800 text-blue-700 dark:text-blue-400' : '' }}
                                                {{ $loan->status === 'rejected' ? 'bg-red-50 dark:bg-red-950 border-red-100 dark:border-red-800 text-red-700 dark:text-red-400' : '' }}
                                                {{ $loan->status === 'closed' ? 'bg-slate-50 dark:bg-slate-900 border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-400' : '' }}
                                            ">{{ $loan->status }}</span>
                                        </div>
                                        <div class="mt-3 lg:mt-4 grid grid-cols-2 sm:grid-cols-3 gap-3 lg:gap-4 text-xs">
                                            <div>
                                                <p class="text-slate-600 dark:text-slate-400 font-medium">Applied Amount</p>
                                                <p class="font-bold text-slate-800 dark:text-slate-200 mt-1">UGX {{ number_format($loan->applied_amount ?? 0, 2) }}</p>
                                            </div>
                                            <div>
                                                <p class="text-slate-600 dark:text-slate-400 font-medium">Disbursed Amount</p>
                                                <p class="font-bold text-slate-800 dark:text-slate-200 mt-1">UGX {{ number_format($loan->disbursed_amount ?? 0, 2) }}</p>
                                            </div>
                                            <div class="col-span-2 sm:col-span-1">
                                                <p class="text-slate-600 dark:text-slate-400 font-medium">Interest Rate</p>
                                                <p class="font-bold text-slate-800 dark:text-slate-200 mt-1">{{ $loan->interest_rate ?? 0 }}%</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mt-4 text-center">
                                <a href="{{ route('member.loans') }}" class="text-sm text-emerald-600 dark:text-emerald-400 font-bold hover:text-emerald-700 dark:text-emerald-400 transition-colors">View All Loans &rarr;</a>
                            </div>
                        @else
                            <div class="text-center py-12">
                                <p class="text-slate-600 dark:text-slate-400">No loan records found.</p>
                            </div>
                        @endif
                    </div>

                    <div x-show="tab === 'transactions'" class="p-4 lg:p-6" x-cloak>
                        @if($recentTransactions->count())
                            <div class="space-y-3 lg:space-y-4">
                                @foreach($recentTransactions as $txn)
                                    <div class="flex items-center justify-between py-3 border-b border-slate-100 dark:border-slate-700 last:border-0">
                                        <div class="flex items-center gap-3 lg:gap-4">
                                            <div class="w-8 h-8 lg:w-9 lg:h-9 rounded-xl flex items-center justify-center border {{ $txn->type === 'deposit' ? 'bg-emerald-50 dark:bg-emerald-950 border-emerald-100 dark:border-emerald-800 text-emerald-600 dark:text-emerald-400' : 'bg-red-50 dark:bg-red-950 border-red-100 dark:border-red-800 text-red-600 dark:text-red-400' }}">
                                                <svg class="w-3.5 h-3.5 lg:w-4 lg:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    @if($txn->type === 'deposit')
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                                    @else
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                                    @endif
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-xs lg:text-sm font-bold text-slate-800 dark:text-slate-200 capitalize">{{ $txn->type }}</p>
                                                <p class="text-[10px] lg:text-xs text-slate-600 dark:text-slate-400 mt-0.5">{{ $txn->description ?? $txn->reference }} &middot; <span class="font-mono">{{ $txn->created_at->format('d M Y, h:i A') }}</span></p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-xs lg:text-sm font-extrabold font-mono {{ $txn->type === 'deposit' ? 'text-emerald-700 dark:text-emerald-400' : 'text-red-700 dark:text-red-400' }}">
                                                {{ $txn->type === 'deposit' ? '+' : '-' }} UGX {{ number_format($txn->amount, 2) }}
                                            </p>
                                            <p class="text-[10px] text-slate-600 dark:text-slate-400 font-mono mt-0.5 font-medium">Bal: UGX {{ number_format($txn->balance_after, 2) }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mt-4 text-center">
                                <a href="{{ route('member.transactions') }}" class="text-sm text-emerald-600 dark:text-emerald-400 font-bold hover:text-emerald-700 dark:text-emerald-400 transition-colors">View All Transactions &rarr;</a>
                            </div>
                        @else
                            <div class="text-center py-12">
                                <p class="text-slate-600 dark:text-slate-400">No recent transactions.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Loan Summary Table -->
                <div class="bg-white dark:bg-slate-800 rounded-2xl lg:rounded-3xl border border-slate-200 dark:border-slate-700/60 p-4 lg:p-6 shadow-sm">
                    <h2 class="text-base lg:text-lg font-black text-slate-900 dark:text-white mb-4 lg:mb-5 tracking-tight font-sans">Loan Performance Summary</h2>
                    @if($loanSummary->count())
                        <div class="overflow-x-auto rounded-xl lg:rounded-2xl border border-slate-100 dark:border-slate-700">
                            <table class="w-full text-xs lg:text-sm">
                                <thead>
                                    <tr class="bg-slate-50 dark:bg-slate-900 border-b border-slate-100 dark:border-slate-700">
                                        <th class="text-left py-2.5 lg:py-3 px-3 lg:px-4 font-bold text-slate-600 dark:text-slate-400">Loan Status</th>
                                        <th class="text-right py-2.5 lg:py-3 px-3 lg:px-4 font-bold text-slate-600 dark:text-slate-400">Applications</th>
                                        <th class="text-right py-2.5 lg:py-3 px-3 lg:px-4 font-bold text-slate-600 dark:text-slate-400">Total Disbursed (UGX)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($loanSummary as $summary)
                                        <tr class="border-b border-slate-100 dark:border-slate-700 hover:bg-slate-50 dark:bg-slate-900/50 transition-colors last:border-0">
                                            <td class="py-2.5 lg:py-3.5 px-3 lg:px-4">
                                                <span class="capitalize text-[10px] font-bold px-2 py-0.5 rounded-full border
                                                    {{ $summary->status === 'approved' ? 'bg-emerald-50 dark:bg-emerald-950 border-emerald-100 dark:border-emerald-800 text-emerald-700 dark:text-emerald-400' : '' }}
                                                    {{ $summary->status === 'pending' ? 'bg-amber-50 dark:bg-amber-950 border-amber-100 dark:border-amber-800 text-amber-700 dark:text-amber-400' : '' }}
                                                    {{ $summary->status === 'disbursed' ? 'bg-blue-50 dark:bg-blue-950 border-blue-100 dark:border-blue-800 text-blue-700 dark:text-blue-400' : '' }}
                                                    {{ $summary->status === 'rejected' ? 'bg-red-50 dark:bg-red-950 border-red-100 dark:border-red-800 text-red-700 dark:text-red-400' : '' }}
                                                    {{ $summary->status === 'closed' ? 'bg-slate-50 dark:bg-slate-900 border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-400' : '' }}
                                                ">{{ $summary->status }}</span>
                                            </td>
                                            <td class="py-2.5 lg:py-3.5 px-3 lg:px-4 text-right font-mono text-slate-700 dark:text-slate-300 dark:text-slate-600">{{ $summary->count }}</td>
                                            <td class="py-2.5 lg:py-3.5 px-3 lg:px-4 text-right font-mono font-bold text-slate-900 dark:text-white">{{ number_format($summary->total_disbursed, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @php
                            $pendingLoans = $loanSummary->where('status', 'pending')->sum('count');
                            $totalLoansCount = $loanSummary->sum('count');
                        @endphp
                        <div class="mt-4 lg:mt-6 grid grid-cols-3 gap-3 lg:gap-4 text-xs">
                            <div class="text-center p-3 lg:p-3.5 bg-slate-50 dark:bg-slate-900 rounded-xl lg:rounded-2xl border border-slate-100 dark:border-slate-700">
                                <p class="text-lg lg:text-xl font-black text-slate-900 dark:text-white font-mono">{{ $totalLoansCount }}</p>
                                <p class="text-slate-600 dark:text-slate-400 font-medium mt-1">Total</p>
                            </div>
                            <div class="text-center p-3 lg:p-3.5 bg-amber-50 dark:bg-amber-950/50 rounded-xl lg:rounded-2xl border border-amber-100 dark:border-amber-800/50">
                                <p class="text-lg lg:text-xl font-black text-amber-700 dark:text-amber-400 font-mono">{{ $pendingLoans }}</p>
                                <p class="text-amber-600 dark:text-amber-400 font-medium mt-1">Pending</p>
                            </div>
                            <div class="text-center p-3 lg:p-3.5 bg-emerald-50 dark:bg-emerald-950/50 rounded-xl lg:rounded-2xl border border-emerald-100 dark:border-emerald-800/50">
                                <p class="text-lg lg:text-xl font-black text-emerald-700 dark:text-emerald-400 font-mono">{{ $totalLoansCount - $pendingLoans }}</p>
                                <p class="text-emerald-600 dark:text-emerald-400 font-medium mt-1">Processed</p>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-slate-600 dark:text-slate-400">No loan records found.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">

                <div class="bg-white dark:bg-slate-800 rounded-2xl lg:rounded-3xl border border-slate-200 dark:border-slate-700/60 p-4 lg:p-6 shadow-sm">
                    <h3 class="font-black text-slate-900 dark:text-white mb-4 lg:mb-5 text-xs uppercase tracking-wider">Quick Actions</h3>
                    <div class="space-y-3">
                        <a href="{{ route('member.apply-loan') }}" class="flex items-center gap-3 lg:gap-4 p-3 lg:p-3.5 border border-slate-100 dark:border-slate-700 rounded-xl lg:rounded-2xl hover:border-emerald-300 hover:bg-emerald-50 dark:bg-emerald-950/20 hover-scale group">
                            <div class="w-9 h-9 lg:w-10 lg:h-10 bg-emerald-50 dark:bg-emerald-950 rounded-xl border border-emerald-100 dark:border-emerald-800 flex items-center justify-center text-emerald-600 dark:text-emerald-400 group-hover:bg-emerald-100 group-hover:text-emerald-700 dark:text-emerald-400 transition-colors">
                                <svg class="w-4 h-4 lg:w-5 lg:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                            </div>
                            <div>
                                <p class="text-xs lg:text-sm font-bold text-slate-800 dark:text-slate-200 group-hover:text-emerald-700 dark:text-emerald-400 transition-colors">Apply for Loan</p>
                                <p class="text-[11px] text-slate-600 dark:text-slate-400 mt-0.5">Submit new application</p>
                            </div>
                        </a>
                        <a href="{{ route('member.savings') }}" class="flex items-center gap-3 lg:gap-4 p-3 lg:p-3.5 border border-slate-100 dark:border-slate-700 rounded-xl lg:rounded-2xl hover:border-blue-300 hover:bg-blue-50 dark:bg-blue-950/20 hover-scale group">
                            <div class="w-9 h-9 lg:w-10 lg:h-10 bg-blue-50 dark:bg-blue-950 rounded-xl border border-blue-100 dark:border-blue-800 flex items-center justify-center text-blue-600 dark:text-blue-400 group-hover:bg-blue-100 group-hover:text-blue-700 dark:text-blue-400 transition-colors">
                                <svg class="w-4 h-4 lg:w-5 lg:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs lg:text-sm font-bold text-slate-800 dark:text-slate-200 group-hover:text-blue-700 dark:text-blue-400 transition-colors">My Savings</p>
                                <p class="text-[11px] text-slate-600 dark:text-slate-400 mt-0.5">View all accounts</p>
                            </div>
                        </a>
                        <a href="{{ route('member.msacco') }}" class="flex items-center gap-3 lg:gap-4 p-3 lg:p-3.5 border border-slate-100 dark:border-slate-700 rounded-xl lg:rounded-2xl hover:border-purple-300 hover:bg-purple-50 dark:bg-purple-950/20 hover-scale group">
                            <div class="w-9 h-9 lg:w-10 lg:h-10 bg-purple-50 dark:bg-purple-950 rounded-xl border border-purple-100 flex items-center justify-center text-purple-600 dark:text-purple-400 group-hover:bg-purple-100 group-hover:text-purple-700 dark:text-purple-400 transition-colors">
                                <svg class="w-4 h-4 lg:w-5 lg:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs lg:text-sm font-bold text-slate-800 dark:text-slate-200 group-hover:text-purple-700 dark:text-purple-400 transition-colors">M-SACCO Mobile</p>
                                <p class="text-[11px] text-slate-600 dark:text-slate-400 mt-0.5">Access via mobile phone</p>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="bg-white dark:bg-slate-800 rounded-2xl lg:rounded-3xl border border-slate-200 dark:border-slate-700/60 p-4 lg:p-6 shadow-sm">
                    <h3 class="font-black text-slate-900 dark:text-white mb-4 lg:mb-5 text-xs uppercase tracking-wider">Member Details</h3>
                    <div class="space-y-3 lg:space-y-4 text-xs">
                        <div class="flex justify-between items-center py-1.5 border-b border-slate-50">
                            <span class="text-slate-600 dark:text-slate-400 font-medium">Full Name</span>
                            <span class="text-slate-800 dark:text-slate-200 font-bold text-right">{{ $member->full_name ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-1.5 border-b border-slate-50">
                            <span class="text-slate-600 dark:text-slate-400 font-medium">Membership #</span>
                            <span class="text-slate-800 dark:text-slate-200 font-mono font-bold text-right">#{{ $member->membership_number }}</span>
                        </div>
                        <div class="flex justify-between items-center py-1.5 border-b border-slate-50">
                            <span class="text-slate-600 dark:text-slate-400 font-medium">Phone</span>
                            <span class="text-slate-800 dark:text-slate-200 font-bold text-right">{{ $member->phone ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-1.5 border-b border-slate-50">
                            <span class="text-slate-600 dark:text-slate-400 font-medium">Email</span>
                            <span class="text-slate-800 dark:text-slate-200 font-bold text-right truncate max-w-[150px]">{{ $member->email ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-1.5 border-b border-slate-50">
                            <span class="text-slate-600 dark:text-slate-400 font-medium">National ID</span>
                            <span class="text-slate-800 dark:text-slate-200 font-mono font-bold text-right">{{ $member->national_id ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-1.5 border-b border-slate-50">
                            <span class="text-slate-600 dark:text-slate-400 font-medium">District</span>
                            <span class="text-slate-800 dark:text-slate-200 font-bold text-right">{{ $member->district ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-1.5">
                            <span class="text-slate-600 dark:text-slate-400 font-medium">Member Category</span>
                            <span class="text-slate-800 dark:text-slate-200 font-bold capitalize text-right">{{ $member->category ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-emerald-800 to-emerald-950 text-white p-4 lg:p-6 rounded-2xl lg:rounded-3xl relative overflow-hidden shadow-md">
                    <div class="absolute -right-12 -top-12 w-32 h-32 bg-white dark:bg-slate-800/10 rounded-full blur-2xl"></div>
                    <h3 class="font-black text-base lg:text-lg mb-2 relative z-10 font-sans">Need Assistance?</h3>
                    <p class="text-xs text-emerald-100/75 mb-4 lg:mb-6 relative z-10 leading-relaxed">Reach out to our support team for quick resolutions.</p>
                    <div class="space-y-2 lg:space-y-3 relative z-10 font-sans">
                        <a href="tel:{{ $settings_values['org_phone'] ?? '+256775125122' }}" class="flex items-center gap-3 bg-white dark:bg-slate-800/10 hover:bg-white dark:bg-slate-800/20 p-2.5 rounded-xl transition-all duration-300 font-medium text-xs">
                            <div class="w-8 h-8 rounded-lg bg-emerald-50 dark:bg-emerald-950/20 flex items-center justify-center">
                                <svg class="w-4 h-4 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <span>{{ $settings_values['org_phone'] ?? '+256 775 125122' }}</span>
                        </a>
                        <a href="{{ route('member.support') }}" class="flex items-center gap-3 bg-white dark:bg-slate-800/10 hover:bg-white dark:bg-slate-800/20 p-2.5 rounded-xl transition-all duration-300 font-medium text-xs">
                            <div class="w-8 h-8 rounded-lg bg-emerald-50 dark:bg-emerald-950/20 flex items-center justify-center">
                                <svg class="w-4 h-4 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <span>Contact Support</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection