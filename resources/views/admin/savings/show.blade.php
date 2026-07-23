@extends('layouts.admin')

@section('title', 'Savings Account ' . $savings->account_number)
@section('page_title', 'Savings Account #' . $savings->account_number)

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
    <div class="lg:col-span-1 space-y-5">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
            <h3 class="text-base font-semibold text-gray-900 mb-4">Account Details</h3>
            <div class="space-y-3 text-sm">
                <div class="flex justify-between"><span class="text-gray-500">Account No.</span><span class="font-medium text-gray-900">{{ $savings->account_number }}</span></div>
                <div class="flex justify-between"><span class="text-gray-500">Type</span><span class="font-medium text-gray-900">{{ ucfirst($savings->account_type) }}</span></div>
                <div class="flex justify-between"><span class="text-gray-500">Balance</span><span class="font-medium text-lg text-emerald-600">{{ number_format($savings->balance) }} UGX</span></div>
                <div class="flex justify-between"><span class="text-gray-500">Interest Rate</span><span class="font-medium text-gray-900">{{ $savings->interest_rate ?? '—' }}%</span></div>
                <div class="flex justify-between"><span class="text-gray-500">Target Amount</span><span class="font-medium text-gray-900">{{ $savings->target_amount ? number_format($savings->target_amount) . ' UGX' : '—' }}</span></div>
                <div class="flex justify-between"><span class="text-gray-500">Maturity</span><span class="font-medium text-gray-900">{{ $savings->maturity_date?->format('d M Y') ?? '—' }}</span></div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Status</span>
                    <span class="inline-flex items-center space-x-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-medium
                        {{ $savings->status === 'pending' ? 'bg-amber-50 text-amber-700 border border-amber-200' : '' }}
                        {{ $savings->status === 'active' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : '' }}
                        {{ $savings->status === 'dormant' ? 'bg-slate-50 text-slate-600 border border-slate-200' : '' }}
                        {{ $savings->status === 'frozen' ? 'bg-blue-50 text-blue-700 border border-blue-200' : '' }}
                        {{ $savings->status === 'closed' ? 'bg-red-50 text-red-700 border border-red-200' : '' }}">
                        {{ ucfirst($savings->status) }}
                    </span>
                </div>
                @if($savings->approvedBy)
                    <div class="mt-2 text-xs text-slate-500">
                        Approved by {{ $savings->approvedBy->name }} on {{ $savings->approved_at?->format('d M Y H:i') }}
                    </div>
                @endif
            </div>
        </div>

        @if($savings->status === 'pending')
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                <h3 class="text-base font-semibold text-gray-900 mb-4">Approval Action</h3>
                <div class="flex items-center gap-3">
                    <form action="{{ route('admin.savings.approve', $savings) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition-colors" onclick="return confirm('Approve this savings account?')">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Approve Account
                        </button>
                    </form>
                    <form action="{{ route('admin.savings.reject', $savings) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-red-50 hover:bg-red-100 text-red-700 text-sm font-medium rounded-lg border border-red-200 transition-colors" onclick="return confirm('Reject this savings account? This will close the account.')">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            Reject
                        </button>
                    </form>
                </div>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
            <h3 class="text-base font-semibold text-gray-900 mb-4">Member</h3>
            <div class="flex items-center space-x-3 mb-3">
                @if($savings->member?->photo)
                    <img src="{{ asset('storage/' . $savings->member->photo) }}" alt="" class="w-12 h-12 rounded-full object-cover">
                @else
                    <div class="w-12 h-12 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700 font-bold">{{ substr($savings->member?->full_name ?? '?', 0, 2) }}</div>
                @endif
                <div>
                    <p class="font-medium text-gray-900">{{ $savings->member?->full_name ?? '—' }}</p>
                    <p class="text-xs text-gray-500">{{ $savings->member?->membership_number ?? '—' }}</p>
                </div>
            </div>
            <div class="space-y-2 text-sm">
                <div class="flex justify-between"><span class="text-gray-500">Phone</span><span class="font-medium">{{ $savings->member?->phone ?? '—' }}</span></div>
                <div class="flex justify-between"><span class="text-gray-500">Branch</span><span class="font-medium">{{ $savings->member?->branch?->name ?? '—' }}</span></div>
            </div>
        </div>
    </div>

    <div class="lg:col-span-2">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
            <h3 class="text-base font-semibold text-gray-900 mb-4">Transaction History ({{ $savings->transactions->count() }})</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left border-b border-gray-100">
                            <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Date</th>
                            <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Type</th>
                            <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Amount</th>
                            <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Balance After</th>
                            <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Reference</th>
                            <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($savings->transactions as $txn)
                            <tr class="border-b border-gray-50 hover:bg-gray-50/80 transition-colors">
                                <td class="py-3 px-4 text-gray-900 whitespace-nowrap">{{ $txn->created_at->format('d M Y H:i') }}</td>
                                <td class="py-3 px-4">
                                    <span class="inline-flex items-center space-x-1.5 px-2.5 py-1 rounded-full text-[11px] font-medium {{ $txn->type === 'deposit' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-red-50 text-red-700 border border-red-200' }}">
                                        {{ ucfirst($txn->type) }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 font-medium {{ $txn->type === 'deposit' ? 'text-emerald-600' : 'text-red-600' }}">{{ number_format($txn->amount) }}</td>
                                <td class="py-3 px-4 text-gray-900">{{ number_format($txn->balance_after ?? 0) }}</td>
                                <td class="py-3 px-4 text-gray-500">{{ $txn->reference ?? '—' }}</td>
                                <td class="py-3 px-4 text-gray-500 max-w-[200px] truncate">{{ $txn->description ?? '—' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-10 text-center text-gray-400">
                                    <svg class="w-10 h-10 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                    <p>No transactions yet.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection