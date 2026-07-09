@extends('layouts.member')

@section('title', 'My Savings')
@section('page_title', 'My Savings')

@section('content')

<section class="bg-gradient-to-br from-emerald-900 to-emerald-950 text-white relative overflow-hidden">
    <div class="absolute -right-24 -top-24 w-96 h-96 bg-emerald-800/15 rounded-full blur-3xl"></div>
    <div class="absolute -left-20 -bottom-20 w-96 h-96 bg-green-900/10 rounded-full blur-3xl"></div>
    <div class="px-4 lg:px-8 py-8 relative z-10">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-black tracking-tight text-white">My Savings Accounts</h1>
                <p class="text-emerald-100/70 text-sm mt-1">Total active savings: <span class="text-emerald-300 dark:text-emerald-400 font-bold">UGX {{ number_format($activeSavings, 2) }}</span></p>
            </div>
            <a href="{{ route('member.open-savings') }}" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold px-5 py-3 rounded-xl transition-all shadow-lg shadow-emerald-950/20 hover:scale-105">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                Open Savings Account
            </a>
        </div>
    </div>
</section>

<section class="py-8 bg-slate-50 dark:bg-slate-900">
    <div class="px-4 lg:px-8">
        @if($savingsAccounts->count())
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 lg:gap-6">
                @foreach($savingsAccounts as $account)
                    <div class="bg-white dark:bg-slate-800 rounded-2xl lg:rounded-3xl border border-slate-200 dark:border-slate-700/60 p-5 lg:p-6 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <p class="font-bold text-slate-800 dark:text-slate-200">{{ $account->account_type }} Account</p>
                                <p class="text-xs text-slate-600 dark:text-slate-400 font-medium mt-1 font-mono">{{ $account->account_number }}</p>
                            </div>
                            <span class="text-[10px] font-bold px-2.5 py-0.5 rounded-full capitalize border
                                {{ $account->status === 'active' ? 'bg-emerald-50 dark:bg-emerald-950 border-emerald-100 dark:border-emerald-800 text-emerald-700 dark:text-emerald-400' : '' }}
                                {{ $account->status === 'pending' ? 'bg-amber-50 dark:bg-amber-950 border-amber-200 dark:border-amber-800 text-amber-700 dark:text-amber-400' : '' }}
                                {{ $account->status === 'dormant' ? 'bg-slate-50 dark:bg-slate-900 border-slate-100 dark:border-slate-700 text-slate-600 dark:text-slate-400' : '' }}
                                {{ $account->status === 'frozen' ? 'bg-blue-50 dark:bg-blue-950 border-blue-100 dark:border-blue-800 text-blue-700 dark:text-blue-400' : '' }}
                                {{ $account->status === 'closed' ? 'bg-red-50 dark:bg-red-950 border-red-100 dark:border-red-800 text-red-700 dark:text-red-400' : '' }}
                            ">{{ $account->status }}</span>
                        </div>
                        <div class="mb-4">
                            <p class="text-[10px] uppercase font-bold text-slate-600 dark:text-slate-400 tracking-wider">Balance</p>
                            <p class="text-2xl lg:text-3xl font-black text-slate-950 dark:text-white mt-1 font-sans">UGX {{ number_format($account->balance, 2) }}</p>
                        </div>
                        @if($account->target_amount)
                            <div class="mb-4">
                                <p class="text-[10px] text-slate-600 dark:text-slate-400 font-medium">Target: UGX {{ number_format($account->target_amount, 2) }}</p>
                                <div class="mt-2 h-2 bg-slate-100 dark:bg-slate-700 rounded-full overflow-hidden">
                                    <div class="h-full bg-emerald-50 dark:bg-emerald-950 rounded-full" style="width: {{ min(($account->balance / max($account->target_amount, 1)) * 100, 100) }}%"></div>
                                </div>
                                <p class="text-[10px] text-slate-600 dark:text-slate-400 text-right mt-1">{{ number_format(min(($account->balance / max($account->target_amount, 1)) * 100, 100), 1) }}% of target met</p>
                            </div>
                        @endif
                        <div class="text-xs text-slate-600 dark:text-slate-400">
                            @if($account->branch)
                                <span class="block">Branch: {{ $account->branch->name }}</span>
                            @endif
                            <span class="block">Opened: {{ $account->created_at?->format('d M Y') ?? 'N/A' }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20">
                <div class="w-16 h-16 bg-slate-100 dark:bg-slate-700 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-slate-600 dark:text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <p class="text-slate-600 dark:text-slate-400 font-medium">No savings accounts found.</p>
                <p class="text-slate-600 dark:text-slate-400 text-sm mt-1">Open an account to start saving with Mubende Employees and Community Sacco Ltd.</p>
                <a href="{{ route('member.open-savings') }}" class="inline-flex items-center gap-2 mt-4 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold px-5 py-3 rounded-xl transition-all">Open Savings Account</a>
            </div>
        @endif
    </div>
</section>

@endsection