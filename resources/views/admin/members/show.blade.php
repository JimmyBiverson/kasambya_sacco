@extends('layouts.admin')

@section('title', $member->full_name)
@section('page_title', $member->full_name)

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
    <div class="lg:col-span-1">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 text-center">
            @if($member->photo)
                <img src="{{ asset('storage/' . $member->photo) }}" alt="" class="w-28 h-28 rounded-full object-cover mx-auto border-4 border-emerald-100">
            @else
                <div class="w-28 h-28 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700 font-bold text-3xl mx-auto border-4 border-emerald-100">{{ substr($member->full_name, 0, 2) }}</div>
            @endif
            <h3 class="text-lg font-bold text-gray-900 mt-4">{{ $member->full_name }}</h3>
            <p class="text-sm text-gray-500">{{ $member->membership_number }}</p>
            <div class="mt-3">
                <span class="inline-flex items-center space-x-1.5 px-3 py-1 rounded-full text-xs font-medium {{ $member->status === 'active' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : ($member->status === 'pending' ? 'bg-amber-50 text-amber-700 border border-amber-200' : 'bg-red-50 text-red-700 border border-red-200') }}">
                    <span class="w-1.5 h-1.5 rounded-full {{ $member->status === 'active' ? 'bg-emerald-500' : ($member->status === 'pending' ? 'bg-amber-500' : 'bg-red-500') }}"></span>
                    {{ ucfirst($member->status) }}
                </span>
            </div>
            <div class="mt-5 space-y-3 text-left">
                <div class="flex justify-between text-sm"><span class="text-gray-500">Branch</span><span class="font-medium text-gray-900">{{ $member->branch?->name ?? '—' }}</span></div>
                <div class="flex justify-between text-sm"><span class="text-gray-500">Category</span><span class="font-medium text-gray-900">{{ $member->category ?? '—' }}</span></div>
                <div class="flex justify-between text-sm"><span class="text-gray-500">Joined</span><span class="font-medium text-gray-900">{{ $member->joined_at?->format('d M Y') ?? '—' }}</span></div>
            </div>
            <div class="mt-5 flex space-x-2">
                <a href="{{ route('admin.members.edit', $member) }}" class="flex-1 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition-colors text-center">Edit</a>
                <form method="POST" action="{{ route('admin.members.destroy', $member) }}" onsubmit="return confirm('Delete this member?')" class="flex-1">
                    @csrf @method('DELETE')
                    <button type="submit" class="w-full px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors">Delete</button>
                </form>
            </div>
            @if($member->status === 'active')
            <div class="mt-2">
                <form method="POST" action="{{ route('admin.members.impersonate', $member) }}" target="_blank">
                    @csrf
                    <button type="submit" class="w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors text-center">
                        <svg class="w-4 h-4 inline-block mr-1.5 -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                        Impersonate Login
                    </button>
                </form>
            </div>
            @endif
        </div>
    </div>

    <div class="lg:col-span-2 space-y-5">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
            <h3 class="text-base font-semibold text-gray-900 mb-4">Personal Information</h3>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div><span class="text-gray-500">Email</span><p class="font-medium text-gray-900">{{ $member->email ?? '—' }}</p></div>
                <div><span class="text-gray-500">Phone</span><p class="font-medium text-gray-900">{{ $member->phone ?? '—' }}</p></div>
                <div><span class="text-gray-500">Gender</span><p class="font-medium text-gray-900">{{ ucfirst($member->gender ?? '—') }}</p></div>
                <div><span class="text-gray-500">Date of Birth</span><p class="font-medium text-gray-900">{{ $member->dob?->format('d M Y') ?? '—' }}</p></div>
                <div><span class="text-gray-500">National ID</span><p class="font-medium text-gray-900">{{ $member->national_id ?? '—' }}</p></div>
                <div><span class="text-gray-500">Passport No.</span><p class="font-medium text-gray-900">{{ $member->passport_number ?? '—' }}</p></div>
                <div><span class="text-gray-500">Occupation</span><p class="font-medium text-gray-900">{{ $member->occupation ?? '—' }}</p></div>
                <div><span class="text-gray-500">Employer</span><p class="font-medium text-gray-900">{{ $member->employer ?? '—' }}</p></div>
                <div><span class="text-gray-500">Monthly Income</span><p class="font-medium text-gray-900">{{ $member->monthly_income ? number_format($member->monthly_income) . ' UGX' : '—' }}</p></div>
                <div><span class="text-gray-500">District</span><p class="font-medium text-gray-900">{{ $member->district ?? '—' }}</p></div>
            </div>
            <div class="mt-4"><span class="text-gray-500 text-sm">Address</span><p class="font-medium text-gray-900 text-sm">{{ $member->address ?? '—' }}</p></div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
            <h3 class="text-base font-semibold text-gray-900 mb-4">Next of Kin</h3>
            <div class="grid grid-cols-3 gap-4 text-sm">
                <div><span class="text-gray-500">Name</span><p class="font-medium text-gray-900">{{ $member->next_of_kin_name ?? '—' }}</p></div>
                <div><span class="text-gray-500">Phone</span><p class="font-medium text-gray-900">{{ $member->next_of_kin_phone ?? '—' }}</p></div>
                <div><span class="text-gray-500">Relationship</span><p class="font-medium text-gray-900">{{ $member->next_of_kin_relationship ?? '—' }}</p></div>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-5">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                <h3 class="text-base font-semibold text-gray-900 mb-3">Loans ({{ $member->loans->count() }})</h3>
                @forelse($member->loans->take(5) as $loan)
                    <div class="flex justify-between text-sm py-2 border-b border-gray-50 last:border-0">
                        <span class="text-gray-600">{{ $loan->application_number }}</span>
                        <span class="font-medium {{ $loan->status === 'active' ? 'text-emerald-600' : 'text-gray-500' }}">{{ number_format($loan->disbursed_amount ?? $loan->applied_amount) }} UGX</span>
                    </div>
                @empty
                    <p class="text-sm text-gray-400">No loans.</p>
                @endforelse
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                <h3 class="text-base font-semibold text-gray-900 mb-3">Savings ({{ $member->savingsAccounts->count() }})</h3>
                @forelse($member->savingsAccounts->take(5) as $savings)
                    <div class="flex justify-between text-sm py-2 border-b border-gray-50 last:border-0">
                        <span class="text-gray-600">{{ $savings->account_number }}</span>
                        <span class="font-medium {{ $savings->status === 'active' ? 'text-emerald-600' : 'text-gray-500' }}">{{ number_format($savings->balance) }} UGX</span>
                    </div>
                @empty
                    <p class="text-sm text-gray-400">No savings accounts.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection