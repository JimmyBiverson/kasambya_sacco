@extends('layouts.member')

@section('title', 'My Loans')
@section('page_title', 'My Loans')

@section('content')

<section class="bg-gradient-to-br from-emerald-900 to-emerald-950 text-white relative overflow-hidden">
    <div class="absolute -right-24 -top-24 w-96 h-96 bg-emerald-800/15 rounded-full blur-3xl"></div>
    <div class="absolute -left-20 -bottom-20 w-96 h-96 bg-green-900/10 rounded-full blur-3xl"></div>
    <div class="px-4 lg:px-8 py-8 relative z-10">
        <div>
            <h1 class="text-2xl md:text-3xl font-black tracking-tight text-white">My Loans</h1>
            <p class="text-emerald-100/70 text-sm mt-1">Total approved: <span class="text-emerald-300 font-bold">UGX {{ number_format($totalLoaned, 2) }}</span> &middot; Pending: <span class="text-amber-300 font-bold">UGX {{ number_format($totalPending, 2) }}</span></p>
        </div>
    </div>
</section>

<section class="py-8 bg-slate-50 dark:bg-slate-900">
    <div class="px-4 lg:px-8">

        @if($loanSummary->count())
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3 lg:gap-4 mb-8">
                @foreach($loanSummary as $summary)
                    <div class="bg-white dark:bg-slate-800 rounded-xl lg:rounded-2xl border border-slate-200 dark:border-slate-700/60 p-3 lg:p-4 text-center shadow-sm">
                        <p class="text-lg lg:text-xl font-black text-slate-900 dark:text-white font-mono">{{ $summary->count }}</p>
                        <p class="text-[10px] lg:text-xs font-medium mt-1 capitalize
                            {{ $summary->status === 'approved' ? 'text-emerald-600 dark:text-emerald-400' : '' }}
                            {{ $summary->status === 'pending' ? 'text-amber-600 dark:text-amber-400' : '' }}
                            {{ $summary->status === 'disbursed' ? 'text-blue-600 dark:text-blue-400' : '' }}
                            {{ $summary->status === 'rejected' ? 'text-red-600 dark:text-red-400' : '' }}
                            {{ $summary->status === 'closed' ? 'text-slate-600 dark:text-slate-400' : '' }}
                        ">{{ $summary->status }} (UGX {{ number_format($summary->total_disbursed, 0) }})</p>
                    </div>
                @endforeach
            </div>
        @endif

        @if($loans->count())
            <div class="bg-white dark:bg-slate-800 rounded-2xl lg:rounded-3xl border border-slate-200 dark:border-slate-700/60 overflow-hidden shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-xs lg:text-sm">
                        <thead>
                            <tr class="bg-slate-50 dark:bg-slate-900 border-b border-slate-200 dark:border-slate-700">
                                <th class="text-left py-3 px-4 font-bold text-slate-600 dark:text-slate-400">Product</th>
                                <th class="text-left py-3 px-4 font-bold text-slate-600 dark:text-slate-400">Application #</th>
                                <th class="text-right py-3 px-4 font-bold text-slate-600 dark:text-slate-400">Applied</th>
                                <th class="text-right py-3 px-4 font-bold text-slate-600 dark:text-slate-400">Disbursed</th>
                                <th class="text-right py-3 px-4 font-bold text-slate-600 dark:text-slate-400">Rate</th>
                                <th class="text-right py-3 px-4 font-bold text-slate-600 dark:text-slate-400">Term</th>
                                <th class="text-right py-3 px-4 font-bold text-slate-600 dark:text-slate-400">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($loans as $loan)
                                <tr class="border-b border-slate-100 dark:border-slate-700 hover:bg-slate-50 dark:bg-slate-900/50 transition-colors">
                                    <td class="py-3 px-4 font-semibold text-slate-800 dark:text-slate-200">{{ $loan->loanProduct?->name ?? 'Loan' }}</td>
                                    <td class="py-3 px-4 font-mono text-slate-600 dark:text-slate-400">{{ $loan->application_number ?? 'N/A' }}</td>
                                    <td class="py-3 px-4 text-right font-mono text-slate-700 dark:text-slate-300">UGX {{ number_format($loan->applied_amount ?? 0, 2) }}</td>
                                    <td class="py-3 px-4 text-right font-mono text-slate-700 dark:text-slate-300">UGX {{ number_format($loan->disbursed_amount ?? 0, 2) }}</td>
                                    <td class="py-3 px-4 text-right font-mono text-slate-700 dark:text-slate-300">{{ $loan->interest_rate ?? 0 }}%</td>
                                    <td class="py-3 px-4 text-right text-slate-700 dark:text-slate-300">{{ $loan->term_months ?? 0 }} months</td>
                                    <td class="py-3 px-4 text-right">
                                        <span class="text-[10px] font-bold px-2.5 py-0.5 rounded-full capitalize border whitespace-nowrap
                                            {{ $loan->status === 'approved' ? 'bg-emerald-50 dark:bg-emerald-950 border-emerald-100 dark:border-emerald-800 text-emerald-700 dark:text-emerald-400' : '' }}
                                            {{ $loan->status === 'pending' ? 'bg-amber-50 dark:bg-amber-950 border-amber-100 dark:border-amber-800 text-amber-700 dark:text-amber-400' : '' }}
                                            {{ $loan->status === 'disbursed' ? 'bg-blue-50 dark:bg-blue-950 border-blue-100 dark:border-blue-800 text-blue-700 dark:text-blue-400' : '' }}
                                            {{ $loan->status === 'rejected' ? 'bg-red-50 dark:bg-red-950 border-red-100 dark:border-red-800 text-red-700 dark:text-red-400' : '' }}
                                            {{ $loan->status === 'closed' ? 'bg-slate-50 dark:bg-slate-900 border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-400' : '' }}
                                        ">{{ $loan->status }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="text-center py-20">
                <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-slate-600 dark:text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <p class="text-slate-600 dark:text-slate-400 font-medium">No loan records found.</p>
                <a href="{{ route('member.apply-loan') }}" class="text-sm text-emerald-600 dark:text-emerald-400 font-bold hover:text-emerald-700 dark:text-emerald-400 mt-3 inline-block">Apply for a Loan &rarr;</a>
            </div>
        @endif
    </div>
</section>

@endsection