@extends('layouts.admin')

@section('title', 'Activity Log')
@section('page_title', 'Activity Log')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
    <div class="flex items-center justify-between mb-5">
        <div>
            <h3 class="text-base font-semibold text-gray-900">Audit Trail</h3>
            <p class="text-xs text-gray-500 mt-0.5">All CRUD operations and system events</p>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left border-b border-gray-100">
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">User</th>
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Action</th>
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Target</th>
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">IP Address</th>
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Logged At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                    <tr class="border-b border-gray-50 hover:bg-gray-50/80 transition-colors">
                        <td class="py-3 px-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 font-bold text-xs">{{ substr($log->username ?? '?', 0, 2) }}</div>
                                <div>
                                    <span class="font-medium text-gray-900">{{ $log->username ?? 'System' }}</span>
                                    <p class="text-xs text-gray-400">{{ $log->user?->email ?? '' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $log->action === 'created' ? 'bg-emerald-50 text-emerald-700' : '' }}
                                {{ $log->action === 'updated' ? 'bg-blue-50 text-blue-700' : '' }}
                                {{ $log->action === 'deleted' ? 'bg-red-50 text-red-700' : '' }}">
                                {{ ucfirst($log->action) }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-gray-500 text-xs">
                            <span class="font-mono">{{ class_basename($log->model_type) }}</span>
                            @if($log->model_id)
                                <span class="text-gray-400">#{{ $log->model_id }}</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-gray-500 font-mono text-xs">{{ $log->ip_address ?? '—' }}</td>
                        <td class="py-3 px-4 text-gray-500 whitespace-nowrap">{{ \Carbon\Carbon::parse($log->created_at)->format('d M Y H:i:s') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-10 text-center text-gray-400">
                            <svg class="w-10 h-10 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                            <p>No audit logs yet.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5">
        {{ $logs->links() }}
    </div>
</div>
@endsection