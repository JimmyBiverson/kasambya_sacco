@extends('layouts.member')

@section('title', 'My Profile')
@section('page_title', 'My Profile')

@section('content')

<section class="bg-gradient-to-br from-emerald-900 to-emerald-950 text-white relative overflow-hidden">
    <div class="absolute -right-24 -top-24 w-96 h-96 bg-emerald-800/15 rounded-full blur-3xl"></div>
    <div class="absolute -left-20 -bottom-20 w-96 h-96 bg-green-900/10 rounded-full blur-3xl"></div>
    <div class="px-4 lg:px-8 py-8 relative z-10">
        <div>
            <h1 class="text-2xl md:text-3xl font-black tracking-tight text-white">My Profile</h1>
            <p class="text-emerald-100/70 text-sm mt-1">View and update your membership information</p>
        </div>
    </div>
</section>

<section class="py-8 bg-slate-50 dark:bg-slate-900">
    <div class="px-4 lg:px-8 max-w-4xl">
        @if(session('success'))
            <div class="mb-6 bg-emerald-50 dark:bg-emerald-950 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-300 rounded-xl px-4 py-3 text-sm flex items-center gap-2">
                <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white dark:bg-slate-800 rounded-2xl lg:rounded-3xl border border-slate-200 dark:border-slate-700/60 p-6 lg:p-8 shadow-sm" x-data="{ editing: false }">
            <div class="flex items-center gap-4 lg:gap-6 mb-8 pb-6 border-b border-slate-100 dark:border-slate-700">
                <div class="w-16 h-16 lg:w-20 lg:h-20 bg-emerald-100 dark:bg-emerald-900 rounded-2xl flex items-center justify-center text-2xl lg:text-3xl font-black text-emerald-700 dark:text-emerald-400">
                    {{ strtoupper(substr($member->full_name ?? $member->membership_number, 0, 2)) }}
                </div>
                <div>
                    <h2 class="text-xl lg:text-2xl font-bold text-slate-900 dark:text-white">{{ $member->full_name ?? 'N/A' }}</h2>
                    <p class="text-sm text-slate-600 dark:text-slate-400">Member since {{ $member->joined_at?->format('M Y') ?? 'N/A' }}</p>
                    <span class="inline-block mt-1 text-[10px] font-bold px-2.5 py-0.5 rounded-full uppercase border {{ $member->status === 'active' ? 'bg-emerald-50 dark:bg-emerald-950 border-emerald-200 dark:border-emerald-800 text-emerald-700 dark:text-emerald-400' : 'bg-amber-50 dark:bg-amber-950 border-amber-200 dark:border-amber-800 text-amber-700 dark:text-amber-400' }}">
                        {{ $member->status }}
                    </span>
                </div>
                <button @click="editing = !editing" class="ml-auto text-sm font-medium px-4 py-2 rounded-xl transition-all"
                    :class="editing ? 'bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-400 hover:bg-slate-200' : 'bg-emerald-50 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-400 hover:bg-emerald-100 border border-emerald-200 dark:border-emerald-800'">
                    <span x-show="!editing">Edit Profile</span>
                    <span x-show="editing">Cancel</span>
                </button>
            </div>

            <form action="{{ route('member.profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <h3 class="font-bold text-slate-900 dark:text-white mb-4 text-sm uppercase tracking-wider">Personal Details</h3>
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between py-2 border-b border-slate-50">
                                <span class="text-slate-600 dark:text-slate-400">Full Name</span>
                                <span class="text-slate-800 dark:text-slate-200 font-medium text-right">{{ $member->full_name ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-slate-50">
                                <span class="text-slate-600 dark:text-slate-400">Membership #</span>
                                <span class="text-slate-800 dark:text-slate-200 font-mono font-medium text-right">#{{ $member->membership_number }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-slate-50">
                                <span class="text-slate-600 dark:text-slate-400">Date of Birth</span>
                                <span class="text-slate-800 dark:text-slate-200 font-medium text-right">{{ $member->dob?->format('d M Y') ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-slate-50">
                                <span class="text-slate-600 dark:text-slate-400">National ID (NIN)</span>
                                <span class="text-slate-800 dark:text-slate-200 font-mono font-medium text-right">{{ $member->national_id ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-slate-50">
                                <span class="text-slate-600 dark:text-slate-400">Gender</span>
                                <span class="text-slate-800 dark:text-slate-200 font-medium text-right capitalize">{{ $member->gender ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between py-2">
                                <span class="text-slate-600 dark:text-slate-400">Registered Branch</span>
                                <span class="text-slate-800 dark:text-slate-200 font-medium text-right">{{ $member->branch?->name ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="font-bold text-slate-900 dark:text-white mb-4 text-sm uppercase tracking-wider">Contact &amp; Employment</h3>
                        <div class="space-y-4">
                            <div>
                                <label for="phone" class="site-form-label text-xs">Phone Number</label>
                                <input type="text" id="phone" name="phone" value="{{ old('phone', $member->phone) }}" class="site-form-input text-sm" :class="{'bg-slate-50 dark:bg-slate-900': !editing}" x-bind:readonly="!editing">
                            </div>
                            <div>
                                <label for="email" class="site-form-label text-xs">Email Address</label>
                                <input type="email" id="email" name="email" value="{{ old('email', $member->email) }}" class="site-form-input text-sm" :class="{'bg-slate-50 dark:bg-slate-900': !editing}">
                            </div>
                            <div>
                                <label for="address" class="site-form-label text-xs">Address</label>
                                <input type="text" id="address" name="address" value="{{ old('address', $member->address) }}" class="site-form-input text-sm" :class="{'bg-slate-50 dark:bg-slate-900': !editing}">
                            </div>
                            <div>
                                <label for="district" class="site-form-label text-xs">District</label>
                                <input type="text" id="district" name="district" value="{{ old('district', $member->district) }}" class="site-form-input text-sm" :class="{'bg-slate-50 dark:bg-slate-900': !editing}">
                            </div>
                            <div>
                                <label for="occupation" class="site-form-label text-xs">Occupation</label>
                                <input type="text" id="occupation" name="occupation" value="{{ old('occupation', $member->occupation) }}" class="site-form-input text-sm" :class="{'bg-slate-50 dark:bg-slate-900': !editing}">
                            </div>
                            <div>
                                <label for="employer" class="site-form-label text-xs">Employer / Business</label>
                                <input type="text" id="employer" name="employer" value="{{ old('employer', $member->employer) }}" class="site-form-input text-sm" :class="{'bg-slate-50 dark:bg-slate-900': !editing}">
                            </div>
                            <div>
                                <label for="monthly_income" class="site-form-label text-xs">Monthly Income (UGX)</label>
                                <input type="number" id="monthly_income" name="monthly_income" value="{{ old('monthly_income', $member->monthly_income) }}" class="site-form-input text-sm" :class="{'bg-slate-50 dark:bg-slate-900': !editing}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="border-t border-slate-100 dark:border-slate-700 pt-6 mb-6">
                    <h3 class="font-bold text-slate-900 dark:text-white mb-4 text-sm uppercase tracking-wider">Next of Kin</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="next_of_kin_name" class="site-form-label text-xs">Full Name</label>
                            <input type="text" id="next_of_kin_name" name="next_of_kin_name" value="{{ old('next_of_kin_name', $member->next_of_kin_name) }}" class="site-form-input text-sm" :class="{'bg-slate-50 dark:bg-slate-900': !editing}">
                        </div>
                        <div>
                            <label for="next_of_kin_phone" class="site-form-label text-xs">Phone Number</label>
                            <input type="text" id="next_of_kin_phone" name="next_of_kin_phone" value="{{ old('next_of_kin_phone', $member->next_of_kin_phone) }}" class="site-form-input text-sm" :class="{'bg-slate-50 dark:bg-slate-900': !editing}">
                        </div>
                        <div>
                            <label for="next_of_kin_relationship" class="site-form-label text-xs">Relationship</label>
                            <input type="text" id="next_of_kin_relationship" name="next_of_kin_relationship" value="{{ old('next_of_kin_relationship', $member->next_of_kin_relationship) }}" class="site-form-input text-sm" :class="{'bg-slate-50 dark:bg-slate-900': !editing}">
                        </div>
                    </div>
                </div>

                <div class="border-t border-slate-100 dark:border-slate-700 pt-6">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="bg-slate-50 dark:bg-slate-900 rounded-xl p-4 text-center">
                            <p class="text-lg font-black text-emerald-700 dark:text-emerald-400">{{ $member->category ?? 'N/A' }}</p>
                            <p class="text-xs text-slate-600 dark:text-slate-400 mt-1">Member Category</p>
                        </div>
                        <div class="bg-slate-50 dark:bg-slate-900 rounded-xl p-4 text-center">
                            <p class="text-lg font-black text-emerald-700 dark:text-emerald-400">{{ $member->joined_at?->format('M Y') ?? 'N/A' }}</p>
                            <p class="text-xs text-slate-600 dark:text-slate-400 mt-1">Joined Date</p>
                        </div>
                        <div class="bg-slate-50 dark:bg-slate-900 rounded-xl p-4 text-center">
                            <p class="text-lg font-black text-emerald-700 dark:text-emerald-400 capitalize">{{ $member->status }}</p>
                            <p class="text-xs text-slate-600 dark:text-slate-400 mt-1">Account Status</p>
                        </div>
                    </div>
                </div>

                <div x-show="editing" class="mt-6 pt-6 border-t border-slate-100 dark:border-slate-700">
                    <button type="submit" class="site-btn-primary w-full text-center py-3.5 rounded-xl text-sm font-bold">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection