@extends('layouts.admin')

@section('title', 'Loan ' . $loan->application_number)
@section('page_title', 'Loan #' . ($loan->application_number ?? $loan->id))

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
    <div class="lg:col-span-2 space-y-5">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-base font-semibold text-gray-900">Loan Details</h3>
                <span class="inline-flex items-center space-x-1.5 px-2.5 py-1 rounded-full text-[11px] font-medium
                    {{ in_array($loan->status, ['active', 'approved', 'disbursed']) ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : '' }}
                    {{ $loan->status === 'pending' ? 'bg-amber-50 text-amber-700 border border-amber-200' : '' }}
                    {{ in_array($loan->status, ['rejected', 'defaulted', 'written_off']) ? 'bg-red-50 text-red-700 border border-red-200' : '' }}
                    {{ $loan->status === 'closed' ? 'bg-gray-50 text-gray-600 border border-gray-200' : '' }}">
                    {{ ucfirst($loan->status) }}
                </span>
            </div>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div><span class="text-gray-500">Applied Amount</span><p class="font-medium text-gray-900">{{ number_format($loan->applied_amount) }} UGX</p></div>
                <div><span class="text-gray-500">Approved Amount</span><p class="font-medium text-gray-900">{{ $loan->approved_amount ? number_format($loan->approved_amount) . ' UGX' : '—' }}</p></div>
                <div><span class="text-gray-500">Disbursed Amount</span><p class="font-medium text-gray-900">{{ $loan->disbursed_amount ? number_format($loan->disbursed_amount) . ' UGX' : '—' }}</p></div>
                <div><span class="text-gray-500">Interest Rate</span><p class="font-medium text-gray-900">{{ $loan->interest_rate ?? '—' }}%</p></div>
                <div><span class="text-gray-500">Term</span><p class="font-medium text-gray-900">{{ $loan->term_months ?? '—' }} months</p></div>
                <div><span class="text-gray-500">Purpose</span><p class="font-medium text-gray-900">{{ $loan->purpose ?? '—' }}</p></div>
                <div><span class="text-gray-500">Disbursement Method</span><p class="font-medium text-gray-900">{{ $loan->disbursement_method ?? '—' }}</p></div>
                <div><span class="text-gray-500">Disbursed At</span><p class="font-medium text-gray-900">{{ $loan->disbursed_at?->format('d M Y H:i') ?? '—' }}</p></div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
            <h3 class="text-base font-semibold text-gray-900 mb-4">Repayment Schedule ({{ $loan->schedules->count() }})</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left border-b border-gray-100">
                            <th class="pb-2 px-3 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">#</th>
                            <th class="pb-2 px-3 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Due Date</th>
                            <th class="pb-2 px-3 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Amount</th>
                            <th class="pb-2 px-3 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Paid</th>
                            <th class="pb-2 px-3 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($loan->schedules as $schedule)
                            <tr class="border-b border-gray-50">
                                <td class="py-2 px-3 text-gray-500">{{ $schedule->installment_number ?? $loop->iteration }}</td>
                                <td class="py-2 px-3 text-gray-900">{{ $schedule->due_date?->format('d M Y') ?? '—' }}</td>
                                <td class="py-2 px-3 text-gray-900">{{ number_format($schedule->amount ?? 0) }}</td>
                                <td class="py-2 px-3 text-gray-900">{{ number_format($schedule->paid_amount ?? 0) }}</td>
                                <td class="py-2 px-3">
                                    <span class="text-xs font-medium {{ ($schedule->status ?? 'pending') === 'paid' ? 'text-emerald-600' : (($schedule->status ?? 'pending') === 'overdue' ? 'text-red-600' : 'text-amber-600') }}">
                                        {{ ucfirst($schedule->status ?? 'pending') }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="py-4 text-center text-gray-400">No schedule entries.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
            <h3 class="text-base font-semibold text-gray-900 mb-4">Repayments ({{ $loan->repayments->count() }})</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left border-b border-gray-100">
                            <th class="pb-2 px-3 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Date</th>
                            <th class="pb-2 px-3 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Amount</th>
                            <th class="pb-2 px-3 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Method</th>
                            <th class="pb-2 px-3 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Reference</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($loan->repayments as $repayment)
                            <tr class="border-b border-gray-50">
                                <td class="py-2 px-3 text-gray-900">{{ $repayment->created_at->format('d M Y') }}</td>
                                <td class="py-2 px-3 text-gray-900 font-medium">{{ number_format($repayment->amount) }}</td>
                                <td class="py-2 px-3 text-gray-500">{{ $repayment->payment_method ?? '—' }}</td>
                                <td class="py-2 px-3 text-gray-500">{{ $repayment->reference ?? '—' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="py-4 text-center text-gray-400">No repayments yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="lg:col-span-1 space-y-5">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
            <h3 class="text-base font-semibold text-gray-900 mb-4">Member</h3>
            <div class="flex items-center space-x-3 mb-4">
                @if($loan->member?->photo)
                    <img src="{{ asset('storage/' . $loan->member->photo) }}" alt="" class="w-12 h-12 rounded-full object-cover">
                @else
                    <div class="w-12 h-12 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700 font-bold">{{ substr($loan->member?->full_name ?? '?', 0, 2) }}</div>
                @endif
                <div>
                    <p class="font-medium text-gray-900">{{ $loan->member?->full_name ?? '—' }}</p>
                    <p class="text-xs text-gray-500">{{ $loan->member?->membership_number ?? '—' }}</p>
                </div>
            </div>
            <div class="space-y-2 text-sm">
                <div class="flex justify-between"><span class="text-gray-500">Phone</span><span class="font-medium">{{ $loan->member?->phone ?? '—' }}</span></div>
                <div class="flex justify-between"><span class="text-gray-500">Branch</span><span class="font-medium">{{ $loan->member?->branch?->name ?? '—' }}</span></div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
            <h3 class="text-base font-semibold text-gray-900 mb-3">Loan Product</h3>
            <p class="font-medium text-gray-900">{{ $loan->loanProduct?->name ?? '—' }}</p>
            <p class="text-xs text-gray-500 mt-1">{{ $loan->loanProduct?->category ?? '' }}</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
            <h3 class="text-base font-semibold text-gray-900 mb-3">Branch</h3>
            <p class="font-medium text-gray-900">{{ $loan->branch?->name ?? '—' }}</p>
            <p class="text-xs text-gray-500 mt-1">{{ $loan->branch?->location ?? '' }}</p>
        </div>

        @if($loan->collaterals->count() > 0)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                <h3 class="text-base font-semibold text-gray-900 mb-3">Collaterals ({{ $loan->collaterals->count() }})</h3>
                @foreach($loan->collaterals as $collateral)
                    <div class="text-sm py-2 border-b border-gray-50 last:border-0">
                        <p class="font-medium text-gray-900">{{ $collateral->description ?? '—' }}</p>
                        <p class="text-xs text-gray-500">{{ $collateral->estimated_value ? number_format($collateral->estimated_value) . ' UGX' : '' }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection