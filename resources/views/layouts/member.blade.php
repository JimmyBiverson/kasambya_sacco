<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ dark: localStorage.getItem('theme') === 'dark' }" x-effect="document.documentElement.classList.toggle('dark', dark); localStorage.setItem('theme', dark ? 'dark' : 'light')">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') — Member | {{ $settings_values['org_name'] ?? 'Mubende Employees and Community Sacco Ltd' }}</title>
    <meta name="description" content="{{ $settings_values['org_name'] ?? 'Mubende Employees and Community Sacco Ltd' }} Member Portal">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>
    @php
        $favicon = $settings_values['org_favicon'] ?? ($settings_values['org_logo'] ?? null);
    @endphp
    @if(!empty($favicon))
        <link rel="icon" href="{{ asset('storage/'.$favicon) }}?v={{ md5($favicon) }}" />
        <link rel="shortcut icon" href="{{ asset('storage/'.$favicon) }}?v={{ md5($favicon) }}" />
    @else
        <link rel="icon" href="{{ asset('favicon.ico') }}" />
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />
    @endif
    @stack('styles')
</head>
<body class="font-sans antialiased text-slate-800 bg-slate-100 dark:bg-slate-900 dark:text-slate-200 transition-colors duration-200" style="--theme-primary: {{ $theme_primary_value ?? '#10b981' }}; --theme-secondary: {{ $theme_secondary_value ?? '#06b6d4' }}; --theme-accent: {{ $theme_accent_value ?? '#facc15' }}; --theme-primary-contrast: #ffffff; --theme-secondary-contrast: #ffffff; --theme-accent-contrast: #0f172a;">

    @php
        $member = $member ?? null;
        $initials = $member ? strtoupper(substr($member->full_name ?? $member->membership_number, 0, 2)) : 'MM';
        $themeActiveClasses = 'bg-theme-primary-soft dark:bg-theme-primary-surface text-theme-primary dark:text-theme-primary-contrast shadow-sm border border-theme-primary-light dark:border-theme-primary';
        $themeInactiveClasses = 'text-slate-700 dark:text-slate-300 hover:text-slate-900 dark:hover:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-800/50';
    @endphp

    <div x-data="{ sidebarOpen: false }" class="h-screen flex overflow-hidden">

        {{-- Mobile Overlay --}}
        <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-slate-900/20 dark:bg-slate-950/40 lg:hidden"></div>

        {{-- Sidebar --}}
        <aside :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}" class="fixed inset-y-0 left-0 z-50 w-64 bg-white dark:bg-slate-950 text-slate-700 dark:text-slate-300 border-r border-slate-200 dark:border-slate-800 transform -translate-x-full lg:translate-x-0 transition-transform duration-200 ease-in-out lg:static lg:z-auto flex flex-col shadow-xl">

            {{-- Logo --}}
            <div class="flex items-center justify-between h-16 px-5 border-b border-slate-200 dark:border-slate-800">
                <a href="{{ route('member.dashboard') }}" class="flex items-center space-x-3">
                    @php $orgLogo = $settings_values['org_logo'] ?? null; $orgName = $settings_values['org_name'] ?? 'Mubende Employees and Community Sacco Ltd'; $orgInitials = implode('', array_map(fn($w) => $w[0] ?? '', explode(' ', $orgName))); @endphp
                    @if(!empty($orgLogo))
                        <img src="{{ asset('storage/'.$orgLogo) }}" alt="{{ $orgName }}" class="h-9 w-auto rounded-lg">
                    @else
                        <div class="w-9 h-9 sidebar-brand rounded-lg flex items-center justify-center text-white font-bold text-sm shadow-lg shadow-theme-primary">{{ substr($orgInitials, 0, 2) }}</div>
                    @endif
                    <div>
                        <div class="text-slate-800 dark:text-slate-200 font-bold text-sm leading-tight">{{ $orgName }}</div>
                        <div class="text-theme-primary text-[10px] leading-tight -mt-0.5 tracking-wider uppercase font-semibold">Member Portal</div>
                    </div>
                </a>
                <button @click="sidebarOpen = false" class="lg:hidden text-slate-600 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-200 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            {{-- Nav --}}
            <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-0.5">

                <p class="px-3 py-2 text-[10px] font-semibold text-slate-600 dark:text-slate-400 uppercase tracking-widest">Main</p>

                <a href="{{ route('member.dashboard') }}" class="group flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150 {{ request()->routeIs('member.dashboard') ? $themeActiveClasses : $themeInactiveClasses }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span>Dashboard</span>
                </a>

                <p class="px-3 pt-5 pb-2 text-[10px] font-semibold text-slate-600 dark:text-slate-400 uppercase tracking-widest">Accounts</p>

                <div class="space-y-0.5">
                    <a href="{{ route('member.savings') }}" class="group flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150 {{ request()->routeIs('member.savings') ? $themeActiveClasses : $themeInactiveClasses }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        <span>My Savings</span>
                    </a>

                    <a href="{{ route('member.open-savings') }}" class="group flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150 {{ request()->routeIs('member.open-savings') ? $themeActiveClasses : $themeInactiveClasses }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                        <span>Open Savings Account</span>
                    </a>

                    <a href="{{ route('member.loans') }}" class="group flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150 {{ request()->routeIs('member.loans') ? $themeActiveClasses : $themeInactiveClasses }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>My Loans</span>
                    </a>

                    <a href="{{ route('member.transactions') }}" class="group flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150 {{ request()->routeIs('member.transactions') ? $themeActiveClasses : $themeInactiveClasses }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                        <span>Transactions</span>
                    </a>
                </div>

                <p class="px-3 pt-5 pb-2 text-[10px] font-semibold text-slate-600 dark:text-slate-400 uppercase tracking-widest">Services</p>

                <div class="space-y-0.5">
                    <a href="{{ route('member.apply-loan') }}" class="group flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150 {{ request()->routeIs('member.apply-loan') ? $themeActiveClasses : $themeInactiveClasses }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                        <span>Apply for Loan</span>
                    </a>

                    <a href="{{ route('member.msacco') }}" class="group flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150 {{ request()->routeIs('member.msacco') ? $themeActiveClasses : $themeInactiveClasses }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                        <span>M-SACCO Mobile</span>
                    </a>

                    <a href="{{ route('member.support') }}" class="group flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150 {{ request()->routeIs('member.support') ? $themeActiveClasses : $themeInactiveClasses }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <span>Support</span>
                    </a>

                    <a href="{{ route('member.documents') }}" class="group flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150 {{ request()->routeIs('member.documents') ? $themeActiveClasses : $themeInactiveClasses }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <span>My Documents</span>
                    </a>

                    <a href="{{ route('member.profile') }}" class="group flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150 {{ request()->routeIs('member.profile') ? $themeActiveClasses : $themeInactiveClasses }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        <span>My Profile</span>
                    </a>
                </div>
            </nav>

            {{-- Sidebar Footer with Member Info & Logout --}}
            <div class="border-t border-slate-200 dark:border-slate-800 p-4">
                <div class="flex items-center space-x-3">
                    <div class="w-9 h-9 sidebar-brand rounded-lg flex items-center justify-center text-white font-bold text-sm uppercase shadow-lg">{{ $initials }}</div>
                    <div class="flex-1 min-w-0">
                        <div class="text-sm font-medium text-slate-800 dark:text-slate-200 truncate">{{ $member->full_name ?? 'Member' }}</div>
                        <div class="text-[11px] text-emerald-600 truncate font-medium">#{{ $member->membership_number ?? 'N/A' }}</div>
                    </div>
                    <form method="POST" action="{{ route('member.logout') }}">
                        @csrf
                        <button type="submit" class="text-slate-600 dark:text-slate-400 hover:text-red-500 transition-colors p-1.5 rounded-lg hover:bg-red-50 dark:hover:bg-red-950/50" title="Logout">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        {{-- Main Content Area --}}
        <div class="flex-1 flex flex-col h-screen min-w-0">

            {{-- Top Bar --}}
            <header class="bg-white dark:bg-slate-950 border-b border-slate-200 dark:border-slate-800 h-16 flex items-center px-4 lg:px-6 sticky top-0 z-30 shadow-sm flex-shrink-0">
                <button @click="sidebarOpen = true" class="lg:hidden text-slate-600 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-200 mr-3 p-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>

                <div class="flex items-center flex-1">
                    <div class="flex items-center space-x-2 text-sm text-slate-600 dark:text-slate-400">
                        <a href="{{ route('member.dashboard') }}" class="hover:text-emerald-600 transition-colors font-medium">Member</a>
                        <svg class="w-3.5 h-3.5 text-slate-300 dark:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        <span class="text-slate-900 dark:text-white font-semibold">@yield('page_title', 'Dashboard')</span>
                    </div>
                </div>

                <div class="flex items-center space-x-2">
                    <button @click="dark = !dark" class="text-slate-600 dark:text-slate-400 hover:text-theme-accent dark:hover:text-theme-accent p-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 transition-all" title="Toggle dark mode">
                        <svg x-cloak x-show="!dark" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                        <svg x-cloak x-show="dark" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    </button>
                    <a href="{{ route('home') }}" target="_blank" class="text-xs text-slate-600 dark:text-slate-400 hover:text-emerald-600 font-medium flex items-center space-x-1.5 px-3 py-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 transition-all">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        <span class="hidden sm:inline">View Site</span>
                    </a>
                    <form method="POST" action="{{ route('member.logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-xs text-rose-600 hover:text-rose-700 hover:bg-rose-50 dark:hover:bg-rose-955/20 font-semibold flex items-center space-x-1.5 px-3 py-1.5 rounded-xl border border-rose-200 dark:border-rose-900/30 transition-all" title="Logout">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            <span class="hidden sm:inline">Logout</span>
                        </button>
                    </form>
                </div>
            </header>

            {{-- Page Content --}}
            <main class="flex-1 overflow-y-auto bg-slate-50 dark:bg-slate-900">
                @yield('content')
            </main>

            {{-- Footer --}}
            <footer class="border-t border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-950 px-4 lg:px-6 py-3 flex-shrink-0">
                <div class="flex flex-col sm:flex-row items-center justify-between text-xs text-slate-600 dark:text-slate-400">
                    <p>&copy; {{ date('Y') }} {{ $settings_values['org_name'] ?? 'Mubende Employees and Community Sacco Ltd' }} Ltd. All rights reserved.</p>
                    <p class="mt-1 sm:mt-0">Powered by {{ $settings_values['org_name'] ?? 'Mubende Employees and Community Sacco Ltd' }}</p>
                </div>
            </footer>
        </div>
    </div>

    <style>
        html { transition: background-color 0.2s ease; }
        [x-cloak] { display: none !important; }
        *::-webkit-scrollbar { width: 4px; }
        *::-webkit-scrollbar-track { background: transparent; }
        *::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.1); border-radius: 4px; }
        *::-webkit-scrollbar-thumb:hover { background: rgba(0,0,0,0.2); }
    </style>

    @stack('scripts')
</body>
</html>