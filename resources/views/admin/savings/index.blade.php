@extends('layouts.admin')

@section('title', 'Savings Accounts')
@section('page_title', 'Savings Accounts')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
        <div class="flex items-center justify-between mb-5">
            <div>
                <h3 class="text-base font-semibold text-gray-900">All Savings Accounts</h3>
                <p class="text-xs text-gray-500 mt-0.5">View member savings accounts and balances</p>
            </div>
            @if($pendingCount > 0)
                <a href="{{ route('admin.savings.index', ['status' => 'pending']) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-amber-50 border border-amber-200 text-amber-700 text-sm font-medium rounded-lg hover:bg-amber-100 transition-colors">
                    <span class="w-2 h-2 bg-amber-500 rounded-full"></span>
                    {{ $pendingCount }} Pending Approval
                </a>
            @endif
        </div>

    <form method="GET" class="mb-5 flex flex-wrap gap-3">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search account no., member..." class="flex-1 min-w-[200px] rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
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
        <button type="submit" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition-colors">Filter</button>
        @if(request()->anyFilled(['search', 'status', 'branch_id']))
            <a href="{{ route('admin.savings.index') }}" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition-colors">Clear</a>
        @endif
    </form>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left border-b border-gray-100">
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Account No.</th>
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Member</th>
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Type</th>
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Balance</th>
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Branch</th>
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Status</th>
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($accounts as $account)
                    <tr class="border-b border-gray-50 hover:bg-gray-50/80 transition-colors">
                        <td class="py-3 px-4 font-medium text-gray-900">{{ $account->account_number }}</td>
                        <td class="py-3 px-4 text-gray-500">{{ $account->member?->full_name ?? '—' }}</td>
                        <td class="py-3 px-4 text-gray-500">{{ ucfirst($account->account_type ?? '—') }}</td>
                        <td class="py-3 px-4 text-gray-900 font-medium">{{ number_format($account->balance) }}</td>
                        <td class="py-3 px-4 text-gray-500">{{ $account->branch?->name ?? '—' }}</td>
                        <td class="py-3 px-4">
                            <span class="inline-flex items-center space-x-1.5 px-2.5 py-1 rounded-full text-[11px] font-medium
                                {{ $account->status === 'pending' ? 'bg-amber-50 text-amber-700 border border-amber-200' : '' }}
                                {{ $account->status === 'active' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : '' }}
                                {{ $account->status === 'dormant' ? 'bg-slate-50 text-slate-600 border border-slate-200' : '' }}
                                {{ $account->status === 'frozen' ? 'bg-blue-50 text-blue-700 border border-blue-200' : '' }}
                                {{ $account->status === 'closed' ? 'bg-red-50 text-red-700 border border-red-200' : '' }}">
                                <span class="w-1.5 h-1.5 rounded-full
                                    {{ $account->status === 'pending' ? 'bg-amber-500' : '' }}
                                    {{ $account->status === 'active' ? 'bg-emerald-500' : '' }}
                                    {{ $account->status === 'dormant' ? 'bg-slate-400' : '' }}
                                    {{ $account->status === 'frozen' ? 'bg-blue-500' : '' }}
                                    {{ $account->status === 'closed' ? 'bg-red-500' : '' }}">
                                </span>
                                {{ ucfirst($account->status) }}
                            </span>
                        </td>
                        <td class="py-3 px-4">
                            <a href="{{ route('admin.savings.show', $account) }}" class="text-gray-400 hover:text-blue-600 transition-colors p-1.5 rounded-lg hover:bg-blue-50 inline-block" title="View">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-10 text-center text-gray-400">
                            <svg class="w-10 h-10 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            <p>No savings accounts found.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5">
        {{ $accounts->links() }}
    </div>
</div>
@endsection