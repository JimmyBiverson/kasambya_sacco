@extends('layouts.admin')

@section('title', 'Admin Users')
@section('page_title', 'Admin Users')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
    <div class="flex items-center justify-between mb-5">
        <div>
            <h3 class="text-base font-semibold text-gray-900">All Admin Users</h3>
            <p class="text-xs text-gray-500 mt-0.5">Manage system users and their roles</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center space-x-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span>New User</span>
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left border-b border-gray-100">
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Name</th>
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Email</th>
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Role</th>
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Joined</th>
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr class="border-b border-gray-50 hover:bg-gray-50/80 transition-colors">
                        <td class="py-3 px-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700 font-bold text-xs">{{ substr($user->name, 0, 2) }}</div>
                                <span class="font-medium text-gray-900">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="py-3 px-4 text-gray-500">{{ $user->email }}</td>
                        <td class="py-3 px-4">
                            @foreach($user->roles as $role)
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">{{ $role->name }}</span>
                            @endforeach
                        </td>
                        <td class="py-3 px-4 text-gray-500">{{ $user->created_at->format('d M Y') }}</td>
                        <td class="py-3 px-4">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('admin.users.edit', $user) }}" class="text-gray-400 hover:text-emerald-600 transition-colors p-1.5 rounded-lg hover:bg-emerald-50" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Delete this user?')">
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
                            <svg class="w-10 h-10 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <p>No users found.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5">
        {{ $users->links() }}
    </div>
</div>
@endsection