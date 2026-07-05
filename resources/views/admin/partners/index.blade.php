@extends('layouts.admin')

@section('title', 'Partners')
@section('page_title', 'Partners')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
    <div class="flex items-center justify-between mb-5">
        <div>
            <h3 class="text-base font-semibold text-gray-900">All Partners</h3>
            <p class="text-xs text-gray-500 mt-0.5">Manage partner logos displayed on the homepage</p>
        </div>
        <a href="{{ route('admin.partners.create') }}" class="inline-flex items-center space-x-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span>New Partner</span>
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left border-b border-gray-100">
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Logo</th>
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Name</th>
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">URL</th>
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Order</th>
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($partners as $partner)
                    <tr class="border-b border-gray-50 hover:bg-gray-50/80 transition-colors">
                        <td class="py-3 px-4">
                            @if($partner->logo)
                                <img src="{{ asset('storage/' . $partner->logo) }}" class="w-16 h-10 object-contain rounded-lg border" alt="{{ $partner->name }}">
                            @else
                                <span class="text-gray-400 text-xs">No logo</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 font-medium text-gray-900">{{ $partner->name }}</td>
                        <td class="py-3 px-4 text-gray-500 max-w-xs truncate">{{ $partner->url ?? '—' }}</td>
                        <td class="py-3 px-4 text-gray-500">{{ $partner->sort_order ?? 0 }}</td>
                        <td class="py-3 px-4">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('admin.partners.edit', $partner) }}" class="text-gray-400 hover:text-emerald-600 transition-colors p-1.5 rounded-lg hover:bg-emerald-50" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <form method="POST" action="{{ route('admin.partners.destroy', $partner) }}" onsubmit="return confirm('Delete this partner?')">
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
                        <td colspan="5" class="py-10 text-center text-gray-400">
                            <svg class="w-10 h-10 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z"/></svg>
                            <p>No partners yet. <a href="{{ route('admin.partners.create') }}" class="text-emerald-600 font-medium hover:underline">Add one</a>.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5">
        {{ $partners->links() }}
    </div>
</div>
@endsection
