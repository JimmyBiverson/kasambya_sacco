@extends('layouts.admin')

@section('title', 'Contact Messages')
@section('page_title', 'Contact Messages')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
    <div class="flex items-center justify-between mb-5">
        <div>
            <h3 class="text-base font-semibold text-gray-900">All Messages</h3>
            <p class="text-xs text-gray-500 mt-0.5">Contact form submissions from the website</p>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left border-b border-gray-100">
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Status</th>
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Name</th>
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Email</th>
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Phone</th>
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Subject</th>
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Date</th>
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contacts as $contact)
                    <tr class="border-b border-gray-50 hover:bg-gray-50/80 transition-colors {{ !$contact->is_read ? 'bg-emerald-50/40' : '' }}">
                        <td class="py-3 px-4">
                            @if($contact->is_read)
                                <span class="text-gray-400 text-xs font-medium">Read</span>
                            @else
                                <span class="inline-flex items-center space-x-1.5 px-2.5 py-1 rounded-full text-[11px] font-medium bg-amber-50 text-amber-700 border border-amber-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                    New
                                </span>
                            @endif
                        </td>
                        <td class="py-3 px-4 font-medium text-gray-900">{{ $contact->name }}</td>
                        <td class="py-3 px-4 text-gray-500">{{ $contact->email }}</td>
                        <td class="py-3 px-4 text-gray-500">{{ $contact->phone ?? '—' }}</td>
                        <td class="py-3 px-4 text-gray-500 max-w-xs truncate">{{ $contact->subject ?? '—' }}</td>
                        <td class="py-3 px-4 text-gray-500">{{ $contact->created_at->format('d M Y H:i') }}</td>
                        <td class="py-3 px-4">
                            <div class="flex items-center space-x-2">
                                <form method="POST" action="{{ route('admin.contacts.toggle-read', $contact) }}">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="text-gray-400 hover:text-emerald-600 transition-colors p-1.5 rounded-lg hover:bg-emerald-50" title="{{ $contact->is_read ? 'Mark as unread' : 'Mark as read' }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.contacts.destroy', $contact) }}" onsubmit="return confirm('Delete this message?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-gray-400 hover:text-red-600 transition-colors p-1.5 rounded-lg hover:bg-red-50" title="Delete">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @if(!$contact->is_read)
                        <tr class="bg-emerald-50/20">
                            <td colspan="7" class="px-4 pb-3 text-sm text-gray-600">{{ Str::limit($contact->message, 300) }}</td>
                        </tr>
                    @endif
                @empty
                    <tr>
                        <td colspan="7" class="py-10 text-center text-gray-400">
                            <svg class="w-10 h-10 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <p>No messages yet.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5">
        {{ $contacts->links() }}
    </div>
</div>
@endsection
