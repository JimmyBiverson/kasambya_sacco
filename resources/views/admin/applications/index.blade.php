@extends('layouts.admin')

@section('title', 'Applications')
@section('page_title', 'Membership Applications')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
    <div class="flex items-center justify-between mb-5">
        <div>
            <h3 class="text-base font-semibold text-gray-900">All Applications</h3>
            <p class="text-xs text-gray-500 mt-0.5">Membership applications from the website</p>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left border-b border-gray-100">
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Name</th>
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Email</th>
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Phone</th>
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Product Type</th>
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Status</th>
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Date</th>
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($applications as $app)
                    <tr id="application-row-{{ $app->id }}" class="border-b border-gray-50 hover:bg-gray-50/80 transition-colors">
                        <td class="py-3 px-4 font-medium text-gray-900">{{ $app->full_name }}</td>
                        <td class="py-3 px-4 text-gray-500">{{ $app->email }}</td>
                        <td class="py-3 px-4 text-gray-500">{{ $app->phone }}</td>
                        <td class="py-3 px-4 text-gray-500">{{ $app->product_type ?? '—' }}</td>
                        <td class="py-3 px-4">
                            <span class="inline-flex items-center space-x-1.5 px-2.5 py-1 rounded-full text-[11px] font-medium
                                {{ $app->status === 'approved' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : '' }}
                                {{ $app->status === 'rejected' ? 'bg-red-50 text-red-700 border border-red-200' : '' }}
                                {{ $app->status === 'contacted' ? 'bg-blue-50 text-blue-700 border border-blue-200' : '' }}
                                {{ $app->status === 'pending' || !$app->status ? 'bg-amber-50 text-amber-700 border border-amber-200' : '' }}">
                                <span class="w-1.5 h-1.5 rounded-full
                                    {{ $app->status === 'approved' ? 'bg-emerald-500' : '' }}
                                    {{ $app->status === 'rejected' ? 'bg-red-500' : '' }}
                                    {{ $app->status === 'contacted' ? 'bg-blue-500' : '' }}
                                    {{ $app->status === 'pending' || !$app->status ? 'bg-amber-500' : '' }}">
                                </span>
                                <span id="application-status-{{ $app->id }}">{{ ucfirst($app->status ?? 'pending') }}</span>
                            </span>
                        </td>
                        <td class="py-3 px-4 text-gray-500">{{ $app->created_at->format('d M Y') }}</td>
                        <td class="py-3 px-4">
                            <div class="flex items-center space-x-2">
                                <form method="POST" action="{{ route('admin.applications.update-status', $app) }}" class="flex items-center space-x-1 ajax-status-form" data-app-id="{{ $app->id }}">
                                    @csrf @method('PATCH')
                                    <select name="status" class="text-xs border border-gray-200 rounded-lg py-1 px-2 focus:ring-emerald-500 focus:border-emerald-500">
                                        <option value="pending" {{ ($app->status ?? 'pending') === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="contacted" {{ $app->status === 'contacted' ? 'selected' : '' }}>Contacted</option>
                                        <option value="approved" {{ $app->status === 'approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="rejected" {{ $app->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                </form>
                                <form method="POST" action="{{ route('admin.applications.destroy', $app) }}" onsubmit="return confirm('Delete this application?')">
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
                        <td colspan="7" class="py-10 text-center text-gray-400">
                            <svg class="w-10 h-10 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            <p>No applications yet.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5">
        {{ $applications->links() }}
    </div>
</div>
@endsection
