@extends('layouts.member')

@section('title', 'Transactions')
@section('page_title', 'Transactions')

@section('content')

<section class="bg-gradient-to-br from-emerald-900 to-emerald-950 text-white relative overflow-hidden">
    <div class="absolute -right-24 -top-24 w-96 h-96 bg-emerald-800/15 rounded-full blur-3xl"></div>
    <div class="absolute -left-20 -bottom-20 w-96 h-96 bg-green-900/10 rounded-full blur-3xl"></div>
    <div class="px-4 lg:px-8 py-8 relative z-10">
        <div>
            <h1 class="text-2xl md:text-3xl font-black tracking-tight text-white">Transaction History</h1>
            <p class="text-emerald-100/70 text-sm mt-1">Total deposits: <span class="text-emerald-300 font-bold">UGX {{ number_format($totalDeposits, 2) }}</span> &middot; Withdrawals: <span class="text-red-300 font-bold">UGX {{ number_format($totalWithdrawals, 2) }}</span></p>
        </div>
    </div>
</section>

<section class="py-8 bg-slate-50 dark:bg-slate-900">
    <div class="px-4 lg:px-8">

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 lg:gap-6 mb-8">
            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700/60 p-4 lg:p-5 shadow-sm">
                <p class="text-[10px] uppercase font-bold text-slate-600 dark:text-slate-400 tracking-wider">Total Deposits</p>
                <p class="text-xl lg:text-2xl font-black text-emerald-700 dark:text-emerald-400 mt-1 font-sans">UGX {{ number_format($totalDeposits, 2) }}</p>
            </div>
            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700/60 p-4 lg:p-5 shadow-sm">
                <p class="text-[10px] uppercase font-bold text-slate-600 dark:text-slate-400 tracking-wider">Total Withdrawals</p>
                <p class="text-xl lg:text-2xl font-black text-red-700 dark:text-red-400 mt-1 font-sans">UGX {{ number_format($totalWithdrawals, 2) }}</p>
            </div>
            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700/60 p-4 lg:p-5 shadow-sm">
                <p class="text-[10px] uppercase font-bold text-slate-600 dark:text-slate-400 tracking-wider">Net Balance</p>
                <p class="text-xl lg:text-2xl font-black text-slate-900 dark:text-white mt-1 font-sans">UGX {{ number_format($totalDeposits - $totalWithdrawals, 2) }}</p>
            </div>
        </div>

        @if($transactions->count())
            <div class="bg-white dark:bg-slate-800 rounded-2xl lg:rounded-3xl border border-slate-200 dark:border-slate-700/60 overflow-hidden shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-xs lg:text-sm">
                        <thead>
                            <tr class="bg-slate-50 dark:bg-slate-900 border-b border-slate-200 dark:border-slate-700">
                                <th class="text-left py-3 px-4 font-bold text-slate-600 dark:text-slate-400">Date</th>
                                <th class="text-left py-3 px-4 font-bold text-slate-600 dark:text-slate-400">Type</th>
                                <th class="text-left py-3 px-4 font-bold text-slate-600 dark:text-slate-400">Reference</th>
                                <th class="text-left py-3 px-4 font-bold text-slate-600 dark:text-slate-400">Description</th>
                                <th class="text-right py-3 px-4 font-bold text-slate-600 dark:text-slate-400">Amount</th>
                                <th class="text-right py-3 px-4 font-bold text-slate-600 dark:text-slate-400">Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions as $txn)
                                <tr class="border-b border-slate-100 dark:border-slate-700 hover:bg-slate-50 dark:bg-slate-900/50 transition-colors">
                                    <td class="py-3 px-4 text-slate-600 dark:text-slate-400 font-mono whitespace-nowrap">{{ $txn->created_at->format('d M Y, h:i A') }}</td>
                                    <td class="py-3 px-4">
                                        <span class="text-[10px] font-bold px-2 py-0.5 rounded-full capitalize border {{ $txn->type === 'deposit' ? 'bg-emerald-50 dark:bg-emerald-950 border-emerald-100 dark:border-emerald-800 text-emerald-700 dark:text-emerald-400' : 'bg-red-50 dark:bg-red-950 border-red-100 dark:border-red-800 text-red-700 dark:text-red-400' }}">
                                            {{ $txn->type }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 font-mono text-slate-600 dark:text-slate-400">{{ $txn->reference ?? 'N/A' }}</td>
                                    <td class="py-3 px-4 text-slate-600 dark:text-slate-400 max-w-[200px] truncate">{{ $txn->description ?? '-' }}</td>
                                    <td class="py-3 px-4 text-right font-mono font-bold {{ $txn->type === 'deposit' ? 'text-emerald-700 dark:text-emerald-400' : 'text-red-700 dark:text-red-400' }}">
                                        {{ $txn->type === 'deposit' ? '+' : '-' }} UGX {{ number_format($txn->amount, 2) }}
                                    </td>
                                    <td class="py-3 px-4 text-right font-mono text-slate-700 dark:text-slate-300">UGX {{ number_format($txn->balance_after, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-6">
                {{ $transactions->links() }}
            </div>
        @else
            <div class="text-center py-20">
                <div class="w-16 h-16 bg-slate-100 dark:bg-slate-700 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-slate-600 dark:text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                </div>
                <p class="text-slate-600 dark:text-slate-400 font-medium">No transactions found.</p>
            </div>
        @endif
    </div>
</section>

@endsection