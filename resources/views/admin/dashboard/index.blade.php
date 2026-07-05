@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')

{{-- Stats Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-6">
    <!-- Total Members -->
    <div class="glass-card rounded-3xl border border-slate-205/60 p-6 flex flex-col justify-between hover-scale">
        <div class="flex items-center justify-between mb-4">
            <div class="w-11 h-11 rounded-xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-600">
                <svg class="w-5.5 h-5.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </div>
            <span class="text-[10px] font-bold text-emerald-705 bg-emerald-50 border border-emerald-100/50 uppercase tracking-widest px-2.5 py-0.5 rounded-full">Total</span>
        </div>
        <div>
            <p class="text-3xl font-black text-slate-900 font-sans tracking-tight">{{ number_format($totalMembers) }}</p>
            <p class="text-xs text-slate-500 font-medium mt-1">Registered Members</p>
        </div>
        <div class="mt-4 w-full h-1.5 bg-slate-100 rounded-full overflow-hidden">
            <div class="h-full bg-emerald-500 rounded-full" style="width: {{ $totalMembers > 0 ? min(100, $totalMembers * 2) : 0 }}%"></div>
        </div>
    </div>

    <!-- Active Loans -->
    <div class="glass-card rounded-3xl border border-slate-205/60 p-6 flex flex-col justify-between hover-scale">
        <div class="flex items-center justify-between mb-4">
            <div class="w-11 h-11 rounded-xl bg-amber-50 border border-amber-100 flex items-center justify-center text-amber-600">
                <svg class="w-5.5 h-5.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <span class="text-[10px] font-bold text-amber-705 bg-amber-50 border border-amber-100/50 uppercase tracking-widest px-2.5 py-0.5 rounded-full">Active</span>
        </div>
        <div>
            <p class="text-3xl font-black text-slate-900 font-sans tracking-tight">{{ number_format($activeLoans) }}</p>
            <p class="text-xs text-slate-500 font-medium mt-1">Active Loans</p>
        </div>
        <div class="mt-4 w-full h-1.5 bg-slate-100 rounded-full overflow-hidden">
            <div class="h-full bg-amber-500 rounded-full" style="width: {{ $activeLoans > 0 ? min(100, $activeLoans * 5) : 0 }}%"></div>
        </div>
    </div>

    <!-- Total Savings -->
    <div class="glass-card rounded-3xl border border-slate-205/60 p-6 flex flex-col justify-between hover-scale">
        <div class="flex items-center justify-between mb-4">
            <div class="w-11 h-11 rounded-xl bg-blue-50 border border-blue-100 flex items-center justify-center text-blue-600">
                <svg class="w-5.5 h-5.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </div>
            <span class="text-[10px] font-bold text-blue-705 bg-blue-50 border border-blue-100/50 uppercase tracking-widest px-2.5 py-0.5 rounded-full">Total</span>
        </div>
        <div>
            <p class="text-3xl font-black text-slate-900 font-sans tracking-tight">UGX {{ number_format($totalSavings) }}</p>
            <p class="text-xs text-slate-500 font-medium mt-1">Total Savings</p>
        </div>
        <div class="mt-4 w-full h-1.5 bg-slate-100 rounded-full overflow-hidden">
            <div class="h-full bg-blue-500 rounded-full" style="width: {{ $totalSavings > 0 ? min(100, $totalSavings / 100000) : 0 }}%"></div>
        </div>
    </div>

    <!-- Active Branches -->
    <div class="glass-card rounded-3xl border border-slate-205/60 p-6 flex flex-col justify-between hover-scale">
        <div class="flex items-center justify-between mb-4">
            <div class="w-11 h-11 rounded-xl bg-purple-50 border border-purple-100 flex items-center justify-center text-purple-600">
                <svg class="w-5.5 h-5.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            </div>
            <span class="text-[10px] font-bold text-purple-705 bg-purple-50 border border-purple-100/50 uppercase tracking-widest px-2.5 py-0.5 rounded-full">Active</span>
        </div>
        <div>
            <p class="text-3xl font-black text-slate-900 font-sans tracking-tight">{{ number_format($totalBranches) }}</p>
            <p class="text-xs text-slate-500 font-medium mt-1">Active Branches</p>
        </div>
        <div class="mt-4 w-full h-1.5 bg-slate-100 rounded-full overflow-hidden">
            <div class="h-full bg-purple-500 rounded-full" style="width: {{ $totalBranches > 0 ? min(100, $totalBranches * 20) : 0 }}%"></div>
        </div>
    </div>
</div>

{{-- Charts Row --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    {{-- Bar Chart --}}
    <div class="bg-white rounded-3xl border border-slate-200/60 p-6 shadow-sm">
        <div class="flex items-center justify-between mb-5">
            <div>
                <h3 class="text-base font-black text-slate-900 tracking-tight font-sans">Monthly Deposits</h3>
                <p class="text-xs text-slate-450 mt-0.5 font-medium">Savings deposit trends over the last 6 months</p>
            </div>
            <span class="text-[10px] font-bold bg-slate-50 border border-slate-100 text-slate-500 px-3 py-1 rounded-full uppercase tracking-wider">UGX</span>
        </div>
        <div class="relative" style="height: 270px;">
            <canvas id="depositsChart"></canvas>
        </div>
    </div>

    {{-- Pie Chart --}}
    <div class="bg-white rounded-3xl border border-slate-200/60 p-6 shadow-sm">
        <div class="flex items-center justify-between mb-5">
            <div>
                <h3 class="text-base font-black text-slate-900 tracking-tight font-sans">Loan Distribution</h3>
                <p class="text-xs text-slate-455 mt-0.5 font-medium">Breakdown by loan product type</p>
            </div>
            <span class="text-[10px] font-bold bg-slate-50 border border-slate-100 text-slate-500 px-3 py-1 rounded-full uppercase tracking-wider font-mono">{{ $productCounts->sum() }} Active</span>
        </div>
        <div class="relative" style="height: 270px;">
            <canvas id="loansPieChart"></canvas>
        </div>
    </div>
</div>

{{-- Bottom Row --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">

    {{-- Gender Doughnut --}}
    <div class="bg-white rounded-3xl border border-slate-200/60 p-6 shadow-sm flex flex-col justify-between">
        <div class="flex items-center justify-between mb-5">
            <div>
                <h3 class="text-base font-black text-slate-909 tracking-tight font-sans">Members by Gender</h3>
                <p class="text-xs text-slate-455 mt-0.5 font-medium">Demographic breakdown</p>
            </div>
        </div>
        <div class="relative flex-1 flex items-center justify-center" style="height: 210px;">
            <canvas id="genderChart"></canvas>
        </div>
        <div class="flex items-center justify-center space-x-6 mt-4 pt-4 border-t border-slate-100">
            <div class="flex items-center space-x-2">
                <span class="w-2.5 h-2.5 rounded-full bg-blue-500 shadow shadow-blue-500/20"></span>
                <span class="text-xs font-semibold text-slate-600">Male <strong class="text-slate-905 ml-0.5 font-mono font-bold">{{ $maleCount }}</strong></span>
            </div>
            <div class="flex items-center space-x-2">
                <span class="w-2.5 h-2.5 rounded-full bg-pink-500 shadow shadow-pink-500/20"></span>
                <span class="text-xs font-semibold text-slate-600">Female <strong class="text-slate-905 ml-0.5 font-mono font-bold">{{ $femaleCount }}</strong></span>
            </div>
        </div>
    </div>

    {{-- Recent Members Table --}}
    <div class="bg-white rounded-3xl border border-slate-200/60 p-6 shadow-sm lg:col-span-2">
        <div class="flex items-center justify-between mb-5">
            <div>
                <h3 class="text-base font-black text-slate-909 tracking-tight font-sans">Recent Enrollments</h3>
                <p class="text-xs text-slate-455 mt-0.5 font-medium">Latest member registrations profile</p>
            </div>
            <span class="text-[10px] font-bold bg-slate-50 border border-slate-100 text-slate-500 px-3 py-1 rounded-full uppercase tracking-wider font-mono">{{ $recentMembers->count() }} Profiles</span>
        </div>
        <div class="overflow-x-auto rounded-2xl border border-slate-100">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 text-left border-b border-slate-100">
                        <th class="py-3 px-4 font-bold text-slate-550 text-[11px] uppercase tracking-wider">Member Name</th>
                        <th class="py-3 px-4 font-bold text-slate-550 text-[11px] uppercase tracking-wider">Membership No.</th>
                        <th class="py-3 px-4 font-bold text-slate-550 text-[11px] uppercase tracking-wider">Verification</th>
                        <th class="py-3 px-4 font-bold text-slate-550 text-[11px] uppercase tracking-wider">Date Joined</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentMembers as $m)
                        <tr class="border-b border-slate-100 hover:bg-slate-50/50 transition-colors last:border-0">
                            <td class="py-3.5 px-4 font-bold text-slate-800">{{ $m->full_name }}</td>
                            <td class="py-3.5 px-4 text-slate-500 font-mono text-xs">#{{ $m->membership_number ?? '—' }}</td>
                            <td class="py-3.5 px-4">
                                <span class="inline-flex items-center space-x-1.5 px-2.5 py-0.5 rounded-full border text-[10px] font-bold uppercase {{ $m->status === 'active' ? 'bg-emerald-50 text-emerald-700 border-emerald-100' : ($m->status === 'pending' ? 'bg-amber-50 text-amber-700 border-amber-100' : 'bg-red-50 text-red-700 border-red-100') }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $m->status === 'active' ? 'bg-emerald-500' : ($m->status === 'pending' ? 'bg-amber-500' : 'bg-red-500') }}"></span>
                                    {{ $m->status ?? 'unknown' }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-slate-500 font-mono text-xs">{{ $m->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-12 text-center text-slate-400">
                                <svg class="w-10 h-10 mx-auto mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <p class="text-sm font-medium">No members registered yet.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Second Stats Row --}}
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-6">
    <!-- Pending Applications -->
    <div class="glass-card rounded-3xl border border-slate-205/60 p-6 flex flex-col justify-between hover-scale">
        <div class="flex items-center justify-between mb-4">
            <div class="w-11 h-11 rounded-xl bg-amber-50 border border-amber-100 flex items-center justify-center text-amber-600">
                <svg class="w-5.5 h-5.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
            <span class="text-[10px] font-bold text-amber-705 bg-amber-50 border border-amber-100/50 uppercase tracking-widest px-2.5 py-0.5 rounded-full">Pending</span>
        </div>
        <div>
            <p class="text-3xl font-black text-slate-900 font-sans tracking-tight">{{ number_format($pendingApplications) }}</p>
            <p class="text-xs text-slate-500 font-medium mt-1">Pending Applications</p>
        </div>
        <div class="mt-4 w-full h-1.5 bg-slate-100 rounded-full overflow-hidden">
            <div class="h-full bg-amber-500 rounded-full" style="width: {{ $totalApplications > 0 ? ($pendingApplications / max($totalApplications, 1)) * 100 : 0 }}%"></div>
        </div>
    </div>

    <!-- Unread Messages -->
    <div class="glass-card rounded-3xl border border-slate-205/60 p-6 flex flex-col justify-between hover-scale">
        <div class="flex items-center justify-between mb-4">
            <div class="w-11 h-11 rounded-xl bg-red-50 border border-red-100 flex items-center justify-center text-red-650">
                <svg class="w-5.5 h-5.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            </div>
            <span class="text-[10px] font-bold text-red-705 bg-red-50 border border-red-100/50 uppercase tracking-widest px-2.5 py-0.5 rounded-full">Unread</span>
        </div>
        <div>
            <p class="text-3xl font-black text-slate-900 font-sans tracking-tight">{{ number_format($unreadContacts) }}</p>
            <p class="text-xs text-slate-500 font-medium mt-1">Unread Mail messages</p>
        </div>
        <div class="mt-4 w-full h-1.5 bg-slate-100 rounded-full overflow-hidden">
            <div class="h-full bg-red-600 rounded-full" style="width: {{ $unreadContacts > 0 ? min(100, $unreadContacts * 20) : 0 }}%"></div>
        </div>
    </div>

    <!-- Pending Members -->
    <div class="glass-card rounded-3xl border border-slate-205/60 p-6 flex flex-col justify-between hover-scale">
        <div class="flex items-center justify-between mb-4">
            <div class="w-11 h-11 rounded-xl bg-sky-50 border border-sky-100 flex items-center justify-center text-sky-600">
                <svg class="w-5.5 h-5.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            </div>
            <span class="text-[10px] font-bold text-sky-705 bg-sky-50 border border-sky-100/50 uppercase tracking-widest px-2.5 py-0.5 rounded-full">Review</span>
        </div>
        <div>
            <p class="text-3xl font-black text-slate-900 font-sans tracking-tight">{{ number_format($pendingMembers) }}</p>
            <p class="text-xs text-slate-500 font-medium mt-1">Members Awaiting Review</p>
        </div>
        <div class="mt-4 w-full h-1.5 bg-slate-100 rounded-full overflow-hidden">
            <div class="h-full bg-sky-500 rounded-full" style="width: {{ $pendingMembers > 0 ? min(100, $pendingMembers * 10) : 0 }}%"></div>
        </div>
    </div>

    <!-- Total Loaned -->
    <div class="glass-card rounded-3xl border border-slate-205/60 p-6 flex flex-col justify-between hover-scale">
        <div class="flex items-center justify-between mb-4">
            <div class="w-11 h-11 rounded-xl bg-violet-50 border border-violet-100 flex items-center justify-center text-violet-650">
                <svg class="w-5.5 h-5.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </div>
            <span class="text-[10px] font-bold text-violet-750 bg-violet-50 border border-violet-100/50 uppercase tracking-widest px-2.5 py-0.5 rounded-full">Disbursed</span>
        </div>
        <div>
            <p class="text-2xl font-black text-slate-900 font-sans tracking-tight">UGX {{ number_format($totalLoanedAmount) }}</p>
            <p class="text-xs text-slate-500 font-medium mt-1">Total Loan Capital disbursed</p>
        </div>
        <div class="mt-4 w-full h-1.5 bg-slate-100 rounded-full overflow-hidden">
            <div class="h-full bg-violet-550 rounded-full" style="width: {{ $totalLoanedAmount > 0 ? min(100, $totalLoanedAmount / 10000000) : 0 }}%"></div>
        </div>
    </div>
</div>

{{-- Quick Action Buttons --}}
<div class="bg-white rounded-3xl border border-slate-200/60 p-6 shadow-sm mb-6">
    <h3 class="text-base font-black text-slate-800 tracking-tight font-sans mb-5">Command Shortcuts</h3>
    <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-8 gap-4">
        <!-- Members -->
        <a href="{{ route('admin.members.index') }}" class="flex flex-col items-center justify-center rounded-2xl border border-slate-100 hover:border-emerald-250 p-4 bg-slate-50/30 hover:bg-emerald-50/10 transition-all duration-300 group hover-scale text-center">
            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 border border-emerald-100/50 flex items-center justify-center mb-2.5 group-hover:bg-emerald-100 transition-colors">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <span class="text-[11px] font-bold text-slate-600 group-hover:text-emerald-700 transition-colors tracking-wide">Members</span>
        </a>
        <!-- Applications -->
        <a href="{{ route('admin.applications.index') }}" class="flex flex-col items-center justify-center rounded-2xl border border-slate-100 hover:border-amber-250 p-4 bg-slate-50/30 hover:bg-amber-50/10 transition-all duration-300 group hover-scale text-center">
            <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 border border-amber-100/50 flex items-center justify-center mb-2.5 group-hover:bg-amber-100 transition-colors">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
            <span class="text-[11px] font-bold text-slate-600 group-hover:text-amber-700 transition-colors tracking-wide">Applications</span>
        </a>
        <!-- Loans -->
        <a href="{{ route('admin.loans.index') }}" class="flex flex-col items-center justify-center rounded-2xl border border-slate-100 hover:border-blue-250 p-4 bg-slate-50/30 hover:bg-blue-50/10 transition-all duration-300 group hover-scale text-center">
            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 border border-blue-100/50 flex items-center justify-center mb-2.5 group-hover:bg-blue-100 transition-colors">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <span class="text-[11px] font-bold text-slate-600 group-hover:text-blue-700 transition-colors tracking-wide">Loans</span>
        </a>
        <!-- Savings -->
        <a href="{{ route('admin.savings.index') }}" class="flex flex-col items-center justify-center rounded-2xl border border-slate-100 hover:border-purple-250 p-4 bg-slate-50/30 hover:bg-purple-50/10 transition-all duration-300 group hover-scale text-center">
            <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-650 border border-purple-100/50 flex items-center justify-center mb-2.5 group-hover:bg-purple-100 transition-colors">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </div>
            <span class="text-[11px] font-bold text-slate-600 group-hover:text-purple-700 transition-colors tracking-wide">Savings</span>
        </a>
        <!-- Slides -->
        <a href="{{ route('admin.slides.index') }}" class="flex flex-col items-center justify-center rounded-2xl border border-slate-100 hover:border-emerald-250 p-4 bg-slate-50/30 hover:bg-emerald-50/10 transition-all duration-300 group hover-scale text-center">
            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 border border-emerald-100/50 flex items-center justify-center mb-2.5 group-hover:bg-emerald-100 transition-colors">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            <span class="text-[11px] font-bold text-slate-600 group-hover:text-emerald-700 transition-colors tracking-wide">Slides</span>
        </a>
        <!-- News -->
        <a href="{{ route('admin.news.index') }}" class="flex flex-col items-center justify-center rounded-2xl border border-slate-100 hover:border-amber-250 p-4 bg-slate-50/30 hover:bg-amber-50/10 transition-all duration-300 group hover-scale text-center">
            <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 border border-amber-100/50 flex items-center justify-center mb-2.5 group-hover:bg-amber-100 transition-colors">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
            </div>
            <span class="text-[11px] font-bold text-slate-600 group-hover:text-amber-700 transition-colors tracking-wide">News</span>
        </a>
        <!-- Pages -->
        <a href="{{ route('admin.pages.index') }}" class="flex flex-col items-center justify-center rounded-2xl border border-slate-100 hover:border-blue-250 p-4 bg-slate-50/30 hover:bg-blue-50/10 transition-all duration-300 group hover-scale text-center">
            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 border border-blue-100/50 flex items-center justify-center mb-2.5 group-hover:bg-blue-100 transition-colors">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
            <span class="text-[11px] font-bold text-slate-600 group-hover:text-blue-700 transition-colors tracking-wide">Pages</span>
        </a>
        <!-- Settings -->
        <a href="{{ route('admin.settings.index') }}" class="flex flex-col items-center justify-center rounded-2xl border border-slate-100 hover:border-slate-300 p-4 bg-slate-50/30 hover:bg-slate-100 transition-all duration-300 group hover-scale text-center">
            <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-600 border border-slate-200 flex items-center justify-center mb-2.5 group-hover:bg-slate-200 transition-colors">
                <svg class="w-5 Q-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <span class="text-[11px] font-bold text-slate-600 group-hover:text-slate-900 transition-colors tracking-wide">Settings</span>
        </a>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var chartDefaults = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: { boxWidth: 10, padding: 14, font: { size: 10, family: 'Inter' }, color: '#6b7280' }
            }
        }
    };

    var depositsCtx = document.getElementById('depositsChart');
    if (depositsCtx) {
        new Chart(depositsCtx, {
            type: 'bar',
            data: {
                labels: {!! $chartLabels->toJson() !!},
                datasets: [{
                    label: 'Deposits',
                    data: {!! $chartData->toJson() !!},
                    backgroundColor: function(ctx) {
                        var gradient = ctx.chart.ctx.createLinearGradient(0, 0, 0, 270);
                        gradient.addColorStop(0, 'rgba(16, 185, 129, 0.8)');
                        gradient.addColorStop(1, 'rgba(16, 185, 129, 0.2)');
                        return gradient;
                    },
                    borderColor: '#10b981',
                    borderWidth: 1,
                    borderRadius: 4,
                    barPercentage: 0.55,
                }]
            },
            options: {
                ...chartDefaults,
                plugins: { ...chartDefaults.plugins, legend: { display: false } },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(v) { return v >= 1000000 ? (v/1000000).toFixed(1)+'M' : v >= 1000 ? (v/1000).toFixed(0)+'K' : v; },
                            font: { size: 10, family: 'Inter' }, color: '#9ca3af', maxTicksLimit: 6
                        },
                        grid: { color: 'rgba(0,0,0,0.04)', drawBorder: false }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { size: 10, family: 'Inter' }, color: '#9ca3af' }
                    }
                }
            }
        });
    }

    var loansCtx = document.getElementById('loansPieChart');
    if (loansCtx) {
        new Chart(loansCtx, {
            type: 'pie',
            data: {
                labels: {!! $productLabels->toJson() !!},
                datasets: [{
                    data: {!! $productCounts->toJson() !!},
                    backgroundColor: ['#10b981','#f59e0b','#3b82f6','#8b5cf6','#ec4899','#14b8a6','#f97316','#6366f1','#84cc16','#06b6d4'],
                    borderWidth: 2,
                    borderColor: '#ffffff',
                }]
            },
            options: {
                ...chartDefaults,
                plugins: {
                    ...chartDefaults.plugins,
                    legend: { position: 'bottom', labels: { boxWidth: 10, padding: 12, font: { size: 10, family: 'Inter' }, color: '#6b7280' } }
                }
            }
        });
    }

    var genderCtx = document.getElementById('genderChart');
    if (genderCtx) {
        new Chart(genderCtx, {
            type: 'doughnut',
            data: {
                labels: ['Male', 'Female'],
                datasets: [{
                    data: [{{ $maleCount }}, {{ $femaleCount }}],
                    backgroundColor: ['#3b82f6', '#ec4899'],
                    borderWidth: 3,
                    borderColor: '#ffffff',
                    hoverOffset: 8
                }]
            },
            options: {
                ...chartDefaults,
                cutout: '72%',
                plugins: {
                    ...chartDefaults.plugins,
                    legend: { display: false }
                }
            }
        });
    }
});
</script>
@endpush
