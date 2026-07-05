@extends('layouts.admin')

@section('title', 'Loans')
@section('page_title', 'Loans')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
    <div class="flex items-center justify-between mb-5">
        <div>
            <h3 class="text-base font-semibold text-gray-900">All Loans</h3>
            <p class="text-xs text-gray-500 mt-0.5">View and manage loan applications</p>
        </div>
    </div>

    <form method="GET" class="mb-5 flex flex-wrap gap-3">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search application no., member..." class="flex-1 min-w-[200px] rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
        <select name="status" class="rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
            <option value="">All Statuses</option>
            @foreach($statuses as $s)
                <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
            @endforeach
        </select>
        <select name="branch_id" class="rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
            <option value="">All Branches</option>
            @foreach($branches as $b)
                <option value="{{ $b->id }}" {{ request('branch_id') == $b->id ? 'selected' : '' }}>{{ $b->name }}</option>
            @endforeach
        </select>
        <select name="loan_product_id" class="rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
            <option value="">All Products</option>
            @foreach($loanProducts as $lp)
                <option value="{{ $lp->id }}" {{ request('loan_product_id') == $lp->id ? 'selected' : '' }}>{{ $lp->name }}</option>
            @endforeach
        </select>
        <button type="submit" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition-colors">Filter</button>
        @if(request()->anyFilled(['search', 'status', 'branch_id', 'loan_product_id']))
            <a href="{{ route('admin.loans.index') }}" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition-colors">Clear</a>
        @endif
    </form>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left border-b border-gray-100">
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Application No.</th>
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Member</th>
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Product</th>
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Amount</th>
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Branch</th>
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Status</th>
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Date</th>
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($loans as $loan)
                    <tr class="border-b border-gray-50 hover:bg-gray-50/80 transition-colors">
                        <td class="py-3 px-4 font-medium text-gray-900">{{ $loan->application_number ?? '—' }}</td>
                        <td class="py-3 px-4 text-gray-500">{{ $loan->member?->full_name ?? '—' }}</td>
                        <td class="py-3 px-4 text-gray-500">{{ $loan->loanProduct?->name ?? '—' }}</td>
                        <td class="py-3 px-4 text-gray-900 font-medium">{{ number_format($loan->disbursed_amount ?? $loan->approved_amount ?? $loan->applied_amount) }}</td>
                        <td class="py-3 px-4 text-gray-500">{{ $loan->branch?->name ?? '—' }}</td>
                        <td class="py-3 px-4">
                            <span class="inline-flex items-center space-x-1.5 px-2.5 py-1 rounded-full text-[11px] font-medium
                                {{ in_array($loan->status, ['active', 'approved', 'disbursed']) ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : '' }}
                                {{ $loan->status === 'pending' ? 'bg-amber-50 text-amber-700 border border-amber-200' : '' }}
                                {{ in_array($loan->status, ['rejected', 'defaulted', 'written_off']) ? 'bg-red-50 text-red-700 border border-red-200' : '' }}
                                {{ $loan->status === 'closed' ? 'bg-gray-50 text-gray-600 border border-gray-200' : '' }}">
                                <span class="w-1.5 h-1.5 rounded-full
                                    {{ in_array($loan->status, ['active', 'approved', 'disbursed']) ? 'bg-emerald-500' : '' }}
                                    {{ $loan->status === 'pending' ? 'bg-amber-500' : '' }}
                                    {{ in_array($loan->status, ['rejected', 'defaulted', 'written_off']) ? 'bg-red-500' : '' }}
                                    {{ $loan->status === 'closed' ? 'bg-gray-400' : '' }}">
                                </span>
                                {{ ucfirst($loan->status) }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-gray-500">{{ $loan->created_at->format('d M Y') }}</td>
                        <td class="py-3 px-4">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('admin.loans.show', $loan) }}" class="text-gray-400 hover:text-blue-600 transition-colors p-1.5 rounded-lg hover:bg-blue-50" title="View">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </a>
                                <form method="POST" action="{{ route('admin.loans.destroy', $loan) }}" onsubmit="return confirm('Delete this loan record?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-gray-400 hover:text-red-600 transition-colors p-1.5 rounded-lg hover:bg-red-50" title="Delete">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="py-10 text-center text-gray-400">
                            <svg class="w-10 h-10 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <p>No loans found.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5">
        {{ $loans->links() }}
    </div>
</div>
@endsection