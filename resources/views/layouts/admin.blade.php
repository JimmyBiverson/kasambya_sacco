<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ dark: localStorage.getItem('theme') === 'dark' }" x-effect="document.documentElement.classList.toggle('dark', dark); localStorage.setItem('theme', dark ? 'dark' : 'light')">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') — Admin | Kasambya SACCO</title>
    <meta name="description" content="Kasambya SACCO Admin Panel">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @php
        $favicon = $settings_values['org_favicon'] ?? ($settings_values['org_logo'] ?? null);
    @endphp
    @if(!empty($favicon))
        <link rel="icon" href="{{ Storage::url($favicon) }}" />
        <link rel="shortcut icon" href="{{ Storage::url($favicon) }}" />
    @endif
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
    @stack('styles')
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>
    <style>[x-cloak] { display: none !important; }</style>
</head>
<body class="font-sans antialiased text-slate-800 bg-slate-100 dark:bg-slate-900 dark:text-slate-200 transition-colors duration-200" style="--theme-primary: {{ $theme_primary_value ?? '#10b981' }}; --theme-secondary: {{ $theme_secondary_value ?? '#06b6d4' }};">

    <div x-data="{ sidebarOpen: false }" class="h-screen flex overflow-hidden">

        {{-- Mobile Overlay --}}
        <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-slate-900/20 lg:hidden"></div>

        {{-- Sidebar --}}
        <aside :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}" class="admin-sidebar fixed inset-y-0 left-0 z-50 w-64 bg-white dark:bg-slate-950 text-slate-700 dark:text-slate-300 border-r border-slate-200 dark:border-slate-800 transform transition-transform duration-200 ease-in-out lg:translate-x-0 lg:static lg:z-auto lg:h-screen flex flex-col shadow-xl overflow-hidden">

            {{-- Logo --}}
            <div class="flex items-center justify-between h-16 px-5 border-b border-gray-800 dark:border-slate-800">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3">
                    <div class="w-9 h-9 bg-gradient-to-br from-amber-500 to-amber-600 rounded-lg flex items-center justify-center text-white font-bold text-sm shadow-lg shadow-amber-500/20">MS</div>
                    <div>
                        <div class="text-white font-bold text-sm leading-tight">Kasambya</div>
                        <div class="text-amber-400 text-[10px] leading-tight -mt-0.5 tracking-wider uppercase font-semibold">Admin Panel</div>
                    </div>
                </a>
                <button @click="sidebarOpen = false" class="lg:hidden text-gray-400 hover:text-white transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            {{-- Nav --}}
            <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-0.5">

                <p class="px-3 py-2 text-[10px] font-semibold text-gray-500 uppercase tracking-widest">Main</p>

                <a href="{{ route('admin.dashboard') }}" class="group flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150 {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-600/20 text-emerald-300 shadow-sm border border-emerald-600/30' : 'text-gray-300 hover:text-white hover:bg-gray-800/60' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('home') }}" class="group flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150 text-gray-300 hover:text-white hover:bg-gray-800/60">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    <span>View Public Site</span>
                </a>

                <p class="px-3 pt-5 pb-2 text-[10px] font-semibold text-gray-500 uppercase tracking-widest">Members</p>

                <div class="space-y-0.5">
                    <a href="{{ route('admin.members.index') }}" class="group flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150 {{ request()->routeIs('admin.members.*') ? 'bg-emerald-600/20 text-emerald-300 shadow-sm border border-emerald-600/30' : 'text-gray-300 hover:text-white hover:bg-gray-800/60' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        <span>All Members</span>
                    </a>

                    <a href="{{ route('admin.applications.index') }}" class="group flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150 {{ request()->routeIs('admin.applications.*') ? 'bg-emerald-600/20 text-emerald-300 shadow-sm border border-emerald-600/30' : 'text-gray-300 hover:text-white hover:bg-gray-800/60' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <span>Applications</span>
                    </a>
                </div>

                <p class="px-3 pt-5 pb-2 text-[10px] font-semibold text-gray-500 uppercase tracking-widest">Loans</p>

                <div class="space-y-0.5">
                    <a href="{{ route('admin.loans.index') }}" class="group flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150 {{ request()->routeIs('admin.loans.*') ? 'bg-emerald-600/20 text-emerald-300 shadow-sm border border-emerald-600/30' : 'text-gray-300 hover:text-white hover:bg-gray-800/60' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>All Loans</span>
                    </a>

                    <a href="{{ route('admin.loan-products.index') }}" class="group flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150 {{ request()->routeIs('admin.loan-products.*') ? 'bg-emerald-600/20 text-emerald-300 shadow-sm border border-emerald-600/30' : 'text-gray-300 hover:text-white hover:bg-gray-800/60' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        <span>Loan Products</span>
                    </a>
                </div>

                <p class="px-3 pt-5 pb-2 text-[10px] font-semibold text-gray-500 uppercase tracking-widest">Savings</p>

                <div class="space-y-0.5">
                    <a href="{{ route('admin.savings.index') }}" class="group flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150 {{ request()->routeIs('admin.savings.*') ? 'bg-emerald-600/20 text-emerald-300 shadow-sm border border-emerald-600/30' : 'text-gray-300 hover:text-white hover:bg-gray-800/60' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        <span>Accounts</span>
                    </a>

                    <a href="{{ route('admin.branches.index') }}" class="group flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150 {{ request()->routeIs('admin.branches.*') ? 'bg-emerald-600/20 text-emerald-300 shadow-sm border border-emerald-600/30' : 'text-gray-300 hover:text-white hover:bg-gray-800/60' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        <span>Branches</span>
                    </a>
                </div>

                <p class="px-3 pt-5 pb-2 text-[10px] font-semibold text-gray-500 uppercase tracking-widest">Content</p>

                <div class="space-y-0.5">
                    <a href="{{ route('admin.slides.index') }}" class="group flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150 {{ request()->routeIs('admin.slides.*') ? 'bg-emerald-600/20 text-emerald-300 shadow-sm border border-emerald-600/30' : 'text-gray-300 hover:text-white hover:bg-gray-800/60' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span>Slides / Banners</span>
                    </a>

                    <a href="{{ route('admin.services.index') }}" class="group flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150 {{ request()->routeIs('admin.services.*') ? 'bg-emerald-600/20 text-emerald-300 shadow-sm border border-emerald-600/30' : 'text-gray-300 hover:text-white hover:bg-gray-800/60' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <span>Services / Products</span>
                    </a>

                    <a href="{{ route('admin.pages.index') }}" class="group flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150 {{ request()->routeIs('admin.pages.*') ? 'bg-emerald-600/20 text-emerald-300 shadow-sm border border-emerald-600/30' : 'text-gray-300 hover:text-white hover:bg-gray-800/60' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <span>Pages</span>
                    </a>

                    <a href="{{ route('admin.news.index') }}" class="group flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150 {{ request()->routeIs('admin.news.*') ? 'bg-emerald-600/20 text-emerald-300 shadow-sm border border-emerald-600/30' : 'text-gray-300 hover:text-white hover:bg-gray-800/60' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                        <span>News & Events</span>
                    </a>

                    <a href="{{ route('admin.team-members.index') }}" class="group flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150 {{ request()->routeIs('admin.team-members.*') ? 'bg-emerald-600/20 text-emerald-300 shadow-sm border border-emerald-600/30' : 'text-gray-300 hover:text-white hover:bg-gray-800/60' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        <span>Team Members</span>
                    </a>

                    <a href="{{ route('admin.partners.index') }}" class="group flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150 {{ request()->routeIs('admin.partners.*') ? 'bg-emerald-600/20 text-emerald-300 shadow-sm border border-emerald-600/30' : 'text-gray-300 hover:text-white hover:bg-gray-800/60' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z"/></svg>
                        <span>Partners</span>
                    </a>

                    <a href="{{ route('admin.faqs.index') }}" class="group flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150 {{ request()->routeIs('admin.faqs.*') ? 'bg-emerald-600/20 text-emerald-300 shadow-sm border border-emerald-600/30' : 'text-gray-300 hover:text-white hover:bg-gray-800/60' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                        <span>FAQs</span>
                    </a>

                    <a href="{{ route('admin.contacts.index') }}" class="group flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150 {{ request()->routeIs('admin.contacts.*') ? 'bg-emerald-600/20 text-emerald-300 shadow-sm border border-emerald-600/30' : 'text-gray-300 hover:text-white hover:bg-gray-800/60' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <span>Contact Messages</span>
                    </a>
                </div>

                <p class="px-3 pt-5 pb-2 text-[10px] font-semibold text-gray-500 uppercase tracking-widest">System</p>

                <div class="space-y-0.5">
                    <a href="{{ route('admin.users.index') }}" class="group flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150 {{ request()->routeIs('admin.users.*') ? 'bg-emerald-600/20 text-emerald-300 shadow-sm border border-emerald-600/30' : 'text-gray-300 hover:text-white hover:bg-gray-800/60' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/></svg>
                        <span>Admin Users</span>
                    </a>

                    <a href="{{ route('admin.settings.index') }}" class="group flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150 {{ request()->routeIs('admin.settings.*') ? 'bg-emerald-600/20 text-emerald-300 shadow-sm border border-emerald-600/30' : 'text-gray-300 hover:text-white hover:bg-gray-800/60' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span>Settings</span>
                    </a>

                    <a href="{{ route('admin.activity-log.index') }}" class="group flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150 {{ request()->routeIs('admin.activity-log.*') ? 'bg-emerald-600/20 text-emerald-300 shadow-sm border border-emerald-600/30' : 'text-gray-300 hover:text-white hover:bg-gray-800/60' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        <span>Activity Log</span>
                    </a>
                </div>
            </nav>

            {{-- Sidebar Footer --}}
            <div class="border-t border-gray-800 dark:border-slate-800 p-4">
                <div class="flex items-center space-x-3">
                    <div class="w-9 h-9 bg-gradient-to-br from-emerald-600 to-emerald-700 rounded-lg flex items-center justify-center text-white font-bold text-sm uppercase shadow-lg">{{ substr(Auth::user()->name ?? 'A', 0, 2) }}</div>
                    <div class="flex-1 min-w-0">
                        <div class="text-sm font-medium text-gray-200 truncate">{{ Auth::user()->name ?? 'Admin' }}</div>
                        <div class="text-[11px] text-emerald-400 truncate font-medium">{{ Auth::user()->roles->pluck('name')->implode(', ') ?: 'Admin' }}</div>
                    </div>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-500 hover:text-red-400 transition-colors p-1.5 rounded-lg hover:bg-gray-800" title="Logout">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        {{-- Main Content Area --}}
        <div class="flex-1 flex flex-col h-screen min-w-0">

            {{-- Top Bar --}}
            <header x-data="{ notificationsOpen: false }" class="bg-white dark:bg-slate-950 border-b border-gray-200 dark:border-slate-800 h-16 flex items-center px-4 lg:px-6 sticky top-0 z-30 shadow-sm">
                <button @click="sidebarOpen = true" class="lg:hidden text-gray-400 hover:text-gray-600 mr-3 p-1.5 rounded-lg hover:bg-gray-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>

                <div class="flex items-center flex-1">
                    <div class="flex items-center space-x-2 text-sm text-gray-500">
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-emerald-600 transition-colors font-medium">Admin</a>
                        <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        <span class="text-gray-900 font-semibold">@yield('page_title', 'Dashboard')</span>
                    </div>
                </div>

                <div class="flex items-center space-x-2">
                    <button @click="dark = !dark" class="text-gray-500 hover:text-amber-500 p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors" title="Toggle dark mode">
                        <svg x-cloak x-show="!dark" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                        <svg x-cloak x-show="dark" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    </button>
                    <div class="relative" @click.outside="notificationsOpen = false">
                        <button @click="notificationsOpen = !notificationsOpen" class="relative text-gray-500 hover:text-emerald-600 transition-colors p-2 rounded-full hover:bg-slate-100">
                            <span class="sr-only">View notifications</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0a3 3 0 11-6 0h6z"/></svg>
                            @php $totalNotifications = ($adminNotifications['pending_applications'] ?? 0) + ($adminNotifications['unread_contacts'] ?? 0) + ($adminNotifications['pending_members'] ?? 0); @endphp
                            <span id="total-notifications-badge" class="absolute -right-0.5 -top-0.5 inline-flex items-center justify-center rounded-full bg-rose-600 text-white text-[10px] font-bold leading-none px-1.5 py-0.5" style="{{ $totalNotifications > 0 ? '' : 'display:none;' }}">{{ $totalNotifications }}</span>
                        </button>
                        <div x-show="notificationsOpen" x-cloak class="absolute right-0 mt-2 w-80 bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-3xl shadow-xl overflow-hidden z-50">
                            <div class="p-4 space-y-3">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-semibold text-slate-900">Admin alerts</p>
                                        <p class="text-xs text-slate-500">Stay on top of pending approvals and messages.</p>
                                    </div>
                                    <span class="text-[11px] uppercase tracking-wider text-slate-500">{{ $totalNotifications }} new</span>
                                </div>
                                <a href="{{ route('admin.applications.index') }}" class="block rounded-2xl bg-slate-50 hover:bg-slate-100 p-3 transition"> 
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-semibold text-slate-900">Pending applications</p>
                                            <p class="text-xs text-slate-500">Applicants waiting approval</p>
                                        </div>
                                        <span id="pending-applications-count" class="inline-flex items-center justify-center rounded-full bg-amber-500 text-white text-[11px] font-semibold px-2 py-1">{{ $adminNotifications['pending_applications'] ?? 0 }}</span>
                                    </div>
                                </a>
                                <a href="{{ route('admin.contacts.index') }}" class="block rounded-2xl bg-slate-50 hover:bg-slate-100 p-3 transition">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-semibold text-slate-900">Unread messages</p>
                                            <p class="text-xs text-slate-500">Visitors contacted your site</p>
                                        </div>
                                        <span id="unread-contacts-count" class="inline-flex items-center justify-center rounded-full bg-red-600 text-white text-[11px] font-semibold px-2 py-1">{{ $adminNotifications['unread_contacts'] ?? 0 }}</span>
                                    </div>
                                </a>
                                <a href="{{ route('admin.members.index') }}" class="block rounded-2xl bg-slate-50 hover:bg-slate-100 p-3 transition">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-semibold text-slate-900">Pending member reviews</p>
                                            <p class="text-xs text-slate-500">New member accounts awaiting review</p>
                                        </div>
                                        <span id="pending-members-count" class="inline-flex items-center justify-center rounded-full bg-sky-600 text-white text-[11px] font-semibold px-2 py-1">{{ $adminNotifications['pending_members'] ?? 0 }}</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('home') }}" target="_blank" class="text-xs text-gray-500 hover:text-emerald-600 font-medium flex items-center space-x-1.5 px-3 py-1.5 rounded-lg hover:bg-gray-100 transition-all">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        <span class="hidden sm:inline">View Site</span>
                    </a>
                </div>
            </header>

            {{-- Page Content --}}
            <main class="flex-1 overflow-y-auto p-4 lg:p-6 bg-slate-50 dark:bg-slate-900">
                @if(session('success'))
                    <div class="mb-5 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl px-4 py-3 text-sm flex items-center space-x-2">
                        <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif
                @if(session('error'))
                    <div class="mb-5 bg-red-50 border border-red-200 text-red-800 rounded-xl px-4 py-3 text-sm flex items-center space-x-2">
                        <svg class="w-4 h-4 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif
                @yield('content')
            </main>

            {{-- Footer --}}
            <footer class="border-t border-gray-200 bg-white px-4 lg:px-6 py-3">
                <div class="flex flex-col sm:flex-row items-center justify-between text-xs text-gray-400">
                    <p>&copy; {{ date('Y') }} Kasambya SACCO Ltd. All rights reserved.</p>
                    <p class="mt-1 sm:mt-0">v1.0.0 — Powered by <span class="font-medium text-gray-500">Kasambya SACCO</span></p>
                </div>
            </footer>
        </div>
    </div>

    <style>
        html { transition: background-color 0.2s ease; }
        .nav-item {
            @apply flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150;
        }
        .nav-item.active {
            @apply bg-emerald-600/20 text-emerald-300 shadow-sm border border-emerald-600/30;
        }
        *::-webkit-scrollbar { width: 6px; }
        *::-webkit-scrollbar-track { background: transparent; }
        *::-webkit-scrollbar-thumb { background: rgba(15,23,42,0.25); border-radius: 8px; }
        *::-webkit-scrollbar-thumb:hover { background: rgba(15,23,42,0.35); }
        .stat-card-gradient-1 { background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%); }
        .stat-card-gradient-2 { background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%); }
        .stat-card-gradient-3 { background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); }
        .stat-card-gradient-4 { background: linear-gradient(135deg, #f5f3ff 0%, #ede9fe 100%); }
        .admin-sidebar a {
            color: #475569 !important;
        }
        .admin-sidebar a:hover {
            color: #0f172a !important;
            background: #f8fafc !important;
        }
        .admin-sidebar .sidebar-footer {
            border-top-color: #e2e8f0;
        }

        /* Dark-mode fallbacks for common utility classes to avoid editing many views */
        .dark .bg-white { background-color: #0f1724 !important; }
        .dark .bg-slate-50 { background-color: #0b1220 !important; }
        .dark .text-gray-900, .dark .text-slate-900, .dark .text-slate-800 { color: #e6eef6 !important; }
        .dark .text-gray-500, .dark .text-slate-500, .dark .text-slate-450 { color: #9aa3ad !important; }
        .dark .border-gray-100, .dark .border-slate-100, .dark .border-slate-200 { border-color: #263241 !important; }
        .dark .shadow-sm { box-shadow: 0 1px 2px rgba(0,0,0,0.5) !important; }
        .dark .hover\:bg-gray-50:hover { background-color: rgba(255,255,255,0.02) !important; }
    </style>

    @stack('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const countsUrl = '{{ route('admin.notifications.counts') }}';

            async function fetchCounts() {
                try {
                    const res = await fetch(countsUrl, { credentials: 'same-origin', headers: { 'X-Requested-With': 'XMLHttpRequest' } });
                    if (!res.ok) return;
                    const data = await res.json();
                    const total = (data.pending_applications || 0) + (data.unread_contacts || 0) + (data.pending_members || 0);

                    const pa = document.getElementById('pending-applications-count');
                    const uc = document.getElementById('unread-contacts-count');
                    const pm = document.getElementById('pending-members-count');
                    const tb = document.getElementById('total-notifications-badge');

                    if (pa) pa.textContent = data.pending_applications || 0;
                    if (uc) uc.textContent = data.unread_contacts || 0;
                    if (pm) pm.textContent = data.pending_members || 0;

                    if (tb) {
                        if (total > 0) {
                            tb.style.display = 'inline-flex';
                            tb.textContent = total;
                        } else {
                            tb.style.display = 'none';
                        }
                    }
                } catch (e) {
                    console.error('Error fetching admin counts', e);
                }
            }

            window.fetchCounts = fetchCounts;
            fetchCounts();
            setInterval(fetchCounts, 30000);
        });
    </script>
    <script>
        // AJAX handler for application status forms
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.ajax-status-form select').forEach(function (sel) {
                sel.addEventListener('change', async function (e) {
                    const form = sel.closest('form');
                    if (!form) return;
                    const appId = form.dataset.appId;
                    const formData = new FormData(form);

                    try {
                        const res = await fetch(form.action, {
                            method: 'POST',
                            credentials: 'same-origin',
                            headers: { 'X-Requested-With': 'XMLHttpRequest' },
                            body: formData,
                        });

                        if (!res.ok) throw new Error('Network error');

                        const data = await res.json().catch(() => null);
                        const statusText = sel.options[sel.selectedIndex].textContent || sel.value;

                        // update status label
                        const label = document.getElementById('application-status-' + appId);
                        if (label) label.textContent = statusText.charAt(0).toUpperCase() + statusText.slice(1);

                        // refresh counts if returned
                        if (data) {
                            const pa = document.getElementById('pending-applications-count');
                            const uc = document.getElementById('unread-contacts-count');
                            const pm = document.getElementById('pending-members-count');
                            const tb = document.getElementById('total-notifications-badge');
                            const total = (data.pending_applications || 0) + (data.unread_contacts || 0) + (data.pending_members || 0);

                            if (pa) pa.textContent = data.pending_applications || 0;
                            if (uc) uc.textContent = data.unread_contacts || 0;
                            if (pm) pm.textContent = data.pending_members || 0;

                            if (tb) {
                                if (total > 0) {
                                    tb.style.display = 'inline-flex';
                                    tb.textContent = total;
                                } else {
                                    tb.style.display = 'none';
                                }
                            }
                        } else {
                            // fallback: re-fetch counts
                            window.fetchCounts && window.fetchCounts();
                        }

                    } catch (err) {
                        console.error('Failed to update application status', err);
                        alert('Unable to update status. Try again.');
                    }
                });
            });
        });
    </script>
</body>
</html>
