<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ dark: localStorage.getItem('theme') === 'dark' }" x-effect="document.documentElement.classList.toggle('dark', dark); localStorage.setItem('theme', dark ? 'dark' : 'light')">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php
        $favicon = $settings_values['org_favicon'] ?? ($settings_values['org_logo'] ?? null);
        $socialImage = $settings_values['org_logo'] ?? null;
        $orgName = $settings_values['org_name'] ?? 'Mubende Employees and Community Sacco Ltd';
        $pageTitle = trim($__env->yieldContent('title')) ?: 'Home';
        $metaDesc = trim($__env->yieldContent('meta_description')) ?: ($settings_values['meta_description'] ?? 'Mubende Employees and Community Sacco Ltd - Safe Savings & Affordable Loans.');
    @endphp
    <title>{{ $pageTitle }} - {{ $orgName }}</title>
    <meta name="description" content="{{ $metaDesc }}" />
    @if(!empty($favicon))
        <link rel="icon" href="{{ asset('storage/'.$favicon) }}?v={{ md5($favicon) }}" />
        <link rel="shortcut icon" href="{{ asset('storage/'.$favicon) }}?v={{ md5($favicon) }}" />
    @else
        <link rel="icon" href="{{ asset('favicon.ico') }}" />
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />
    @endif
    <meta property="og:title" content="{{ $pageTitle }} - {{ $orgName }}" />
    <meta property="og:description" content="{{ $metaDesc }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="{{ $orgName }}" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $pageTitle }} - {{ $orgName }}" />
    <meta name="twitter:description" content="{{ $metaDesc }}" />
    @if(!empty($socialImage))
        <meta property="og:image" content="{{ asset('storage/'.$socialImage) }}?v={{ md5($socialImage) }}" />
        <meta name="twitter:image" content="{{ asset('storage/'.$socialImage) }}?v={{ md5($socialImage) }}" />
    @endif
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @stack('styles')
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>
</head>
<body class="font-sans antialiased bg-white text-gray-900 dark:bg-slate-900 dark:text-slate-200 transition-colors duration-200" style="--theme-primary: {{ $theme_primary_value ?? '#10b981' }}; --theme-secondary: {{ $theme_secondary_value ?? '#06b6d4' }}; --theme-accent: {{ $theme_accent_value ?? '#facc15' }}; --theme-primary-contrast: #ffffff; --theme-secondary-contrast: #ffffff; --theme-accent-contrast: #0f172a; --theme-nav: var(--theme-primary); --theme-footer: var(--theme-secondary);">

    <div id="app">

        <!-- Top Bar -->
        <div class="top-bar bg-theme-primary text-white text-sm">
            <div class="max-w-7xl mx-auto px-4 flex items-center justify-between h-10">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    <a href="tel:{{ $settings_values['org_phone'] ?? '+256775125122' }}" class="hover:text-white transition-colors">{{ $settings_values['org_phone'] ?? '+256 775 125 122' }}</a>
                </div>
                <div class="flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>{{ $settings_values['operating_hours'] ?? 'Mon - Fri 8:45 AM - 5:00 PM | Sat: 8:45 AM - 3:00 PM' }}</span>
                </div>
            </div>
        </div>

        <!-- Header -->
        <header class="site-header-shell sticky top-0 z-50 bg-white dark:bg-slate-950 border-b border-gray-200 dark:border-slate-800" x-data="{ mobileOpen: false }">
            <div class="max-w-7xl mx-auto px-3 sm:px-4">
                <div class="flex items-center justify-between min-h-16 py-3 gap-2">
                    <!-- Logo + Site Name -->
                    <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center gap-2 sm:gap-3 min-w-0">
                        @php
                            $navLogo   = $settings_values['org_logo'] ?? null;
                            $_orgName  = $settings_values['org_name'] ?? 'Mubende Employees and Community Sacco Ltd';
                            $nameParts = explode(' ', $_orgName);
                            $orgInitials = implode('', array_map(fn($w) => strtoupper($w[0] ?? ''), $nameParts));
                        @endphp
                        @if(!empty($navLogo))
                            <img src="{{ asset('storage/'.$navLogo) }}" alt="{{ $_orgName }}" class="h-10 w-auto rounded-lg">
                        @else
                            <div class="w-10 h-10 bg-theme-primary rounded-lg flex items-center justify-center text-white font-bold text-sm shadow-md">{{ substr($orgInitials, 0, 2) }}</div>
                        @endif
                        {{-- Subtle vertical divider --}}
                        <span class="w-px h-8 bg-slate-200 dark:bg-slate-700 rounded-full"></span>
                        <div class="leading-tight pl-1 min-w-0">
                            <span class="brand-title text-base font-extrabold text-slate-900 dark:text-white block truncate">{{ $nameParts[0] ?? 'Mubende' }}</span>
                            <span class="brand-subtitle text-xs font-semibold text-theme-primary tracking-wide uppercase block truncate">{{ implode(' ', array_slice($nameParts, 1)) ?: 'SACCO' }}</span>
                        </div>
                    </a>

                    <!-- Desktop Navigation -->
                    <nav class="hidden lg:flex items-center justify-center flex-1 nav-scroll min-w-max space-x-3 flex-nowrap whitespace-nowrap">
                        <a href="{{ route('home') }}" class="site-nav-link {{ request()->routeIs('home') ? 'text-theme-primary' : '' }}">HOME</a>

                        <!-- About Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" @click.outside="open = false" class="site-nav-link inline-flex flex-shrink-0 whitespace-nowrap {{ request()->routeIs('history', 'about', 'manager-message', 'reports') ? 'text-theme-primary' : '' }}">
                                <span class="inline-flex items-center gap-1 whitespace-nowrap">
                                    ABOUT
                                    <svg class="w-3 h-3 flex-shrink-0" :class="{'rotate-180': open}" style="vertical-align:middle;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                </span>
                            </button>
                            <div x-show="open" @click.outside="open = false" x-cloak class="absolute left-0 mt-2 w-56 bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 rounded-lg shadow-md z-50 overflow-hidden">
                                <a href="{{ route('history') }}" class="block px-4 py-2.5 text-sm text-gray-700 dark:text-slate-200 hover:text-theme-primary">Our History</a>
                                <a href="{{ route('about') }}" class="block px-4 py-2.5 text-sm text-gray-700 dark:text-slate-200 hover:text-theme-primary">Mubende Employees and Community Sacco Ltd</a>
                                <a href="{{ route('manager-message') }}" class="block px-4 py-2.5 text-sm text-gray-700 dark:text-slate-200 hover:text-theme-primary">Message from the Manager</a>
                                <a href="{{ route('reports') }}" class="block px-4 py-2.5 text-sm text-gray-700 dark:text-slate-200 hover:text-theme-primary">Financial Reports</a>
                            </div>
                        </div>

                        <!-- Products & Services Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" @click.outside="open = false" class="site-nav-link inline-flex flex-shrink-0 whitespace-nowrap leading-none {{ request()->routeIs('services', 'loan-products', 'msacco') ? 'text-theme-primary' : '' }}">
                                <span class="inline-flex items-center gap-1 whitespace-nowrap">
                                    PRODUCTS&nbsp;&amp;&nbsp;SERVICES
                                    <svg class="w-3 h-3 flex-shrink-0" :class="{'rotate-180': open}" style="vertical-align:middle;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                </span>
                            </button>
                            <div x-show="open" @click.outside="open = false" x-cloak class="absolute left-0 mt-2 w-[220px] bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 rounded-lg shadow-md z-50 overflow-hidden">
                                <a href="{{ route('services') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-slate-200 hover:text-theme-primary">Our Services</a>
                                <a href="{{ route('loan-products') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-slate-200 hover:text-theme-primary">Loan Products</a>
                                <div class="border-t border-gray-100 dark:border-slate-700 my-1"></div>
                                <a href="{{ route('msacco') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-slate-200 hover:text-theme-primary">M-SACCO Services</a>
                            </div>
                        </div>

                        <a href="{{ route('news') }}" class="site-nav-link {{ request()->routeIs('news*') ? 'text-theme-primary' : '' }}">NEWS</a>
                        <a href="{{ route('careers') }}" class="site-nav-link {{ request()->routeIs('careers') ? 'text-theme-primary' : '' }}">CAREERS</a>
                        <a href="{{ route('contact') }}" class="site-nav-link {{ request()->routeIs('contact') ? 'text-theme-primary' : '' }}">CONTACT</a>
                    </nav>

                    <div class="flex items-center space-x-3">
                        <button @click="dark = !dark" class="hidden sm:inline-flex text-gray-600 dark:text-slate-300 hover:text-theme-accent p-1.5 rounded-lg hover:bg-gray-100 dark:hover:bg-slate-800 transition-all" title="Toggle dark mode">
                            <svg x-cloak x-show="!dark" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                            <svg x-cloak x-show="dark" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        </button>
                        <a href="{{ route('application') }}" class="hidden sm:inline-block site-btn-primary text-sm">Become Member</a>
                        @if(auth()->check() && auth()->user()->roles()->whereIn('name', ['Super Admin', 'Branch Manager', 'Loan Officer', 'Teller', 'Accountant', 'HR Officer', 'Auditor'])->exists())
                            <a href="{{ route('admin.dashboard') }}" class="hidden sm:inline-block site-btn-secondary text-xs font-semibold px-3 py-2 transition-colors">Admin Panel</a>
                        @endif
                        @if(session()->has('member_id'))
                            <a href="{{ route('member.dashboard') }}" class="hidden sm:inline-block text-sm text-theme-primary hover:text-theme-secondary font-semibold">My Dashboard</a>
                            <form action="{{ route('member.logout') }}" method="POST" class="hidden sm:inline-block">
                                @csrf
                                <button type="submit" class="text-sm text-gray-500 hover:text-theme-accent font-medium">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('member.login') }}" class="hidden sm:inline-block text-sm text-gray-600 hover:text-theme-primary font-medium" title="Member Login">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                            </a>
                        @endif
                        <button @click="mobileOpen = !mobileOpen" class="lg:hidden ml-auto p-2 rounded-md text-gray-600 hover:text-theme-primary shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path :class="{'hidden': mobileOpen, 'inline-flex': !mobileOpen}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                                <path :class="{'inline-flex': mobileOpen, 'hidden': !mobileOpen}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Navigation -->
            <div x-show="mobileOpen" x-transition class="lg:hidden absolute left-0 right-0 top-full border-t border-gray-200 dark:border-slate-700 bg-white/95 dark:bg-slate-900/95 backdrop-blur-sm shadow-lg max-h-[calc(100vh-4rem)] overflow-y-auto z-40" x-cloak>
                <div class="px-4 py-3 space-y-1">
                    <a href="{{ route('home') }}" class="mobile-nav-link">HOME</a>

                    <div x-data="{ aboutOpen: false }">
                        <button @click="aboutOpen = !aboutOpen" class="flex items-center justify-between w-full py-2 text-gray-700 dark:text-slate-200 font-medium hover:text-theme-primary">
                            ABOUT
                            <svg :class="{'rotate-180': aboutOpen}" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="aboutOpen" class="pl-4 space-y-1 pb-2">
                            <a href="{{ route('history') }}" class="block py-1.5 text-sm text-gray-600 dark:text-slate-300 hover:text-theme-primary">Our History</a>
                            <a href="{{ route('about') }}" class="block py-1.5 text-sm text-gray-600 dark:text-slate-300 hover:text-theme-primary">Mubende Employees and Community Sacco Ltd</a>
                            <a href="{{ route('manager-message') }}" class="block py-1.5 text-sm text-gray-600 dark:text-slate-300 hover:text-theme-primary">Message from the Manager</a>
                            <a href="{{ route('reports') }}" class="block py-1.5 text-sm text-gray-600 dark:text-slate-300 hover:text-theme-primary">Financial Reports</a>
                        </div>
                    </div>

                    <div x-data="{ productsOpen: false }">
                        <button @click="productsOpen = !productsOpen" class="flex items-center justify-between w-full py-2 text-gray-700 dark:text-slate-200 font-medium hover:text-theme-primary">
                            PRODUCTS & SERVICES
                            <svg :class="{'rotate-180': productsOpen}" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="productsOpen" class="pl-4 space-y-1 pb-2">
                            <a href="{{ route('services') }}" class="block py-1.5 text-sm text-gray-600 dark:text-slate-300 hover:text-theme-primary">Our Services</a>
                            <a href="{{ route('loan-products') }}" class="block py-1.5 text-sm text-gray-600 dark:text-slate-300 hover:text-theme-primary">Loan Products</a>
                            <a href="{{ route('msacco') }}" class="block py-1.5 text-sm text-gray-600 dark:text-slate-300 hover:text-theme-primary">M-SACCO Services</a>
                        </div>
                    </div>

                    <a href="{{ route('news') }}" class="mobile-nav-link">NEWS & EVENTS</a>
                    <a href="{{ route('careers') }}" class="mobile-nav-link">CAREERS</a>
                    <a href="{{ route('contact') }}" class="mobile-nav-link">CONTACT</a>
                    <a href="{{ route('application') }}" class="block py-2 site-btn-primary text-sm text-center mt-3">Become Member</a>
                    @if(auth()->check() && auth()->user()->roles()->whereIn('name', ['Super Admin', 'Branch Manager', 'Loan Officer', 'Teller', 'Accountant', 'HR Officer', 'Auditor'])->exists())
                        <a href="{{ route('admin.dashboard') }}" class="block py-2 text-center text-sm site-btn-secondary mt-2">Admin Panel</a>
                    @endif
                    @if(session()->has('member_id'))
                        <a href="{{ route('member.dashboard') }}" class="block py-2 text-center text-sm text-theme-primary font-semibold mt-2">My Dashboard</a>
                        <form action="{{ route('member.logout') }}" method="POST" class="mt-2">
                            @csrf
                            <button type="submit" class="w-full py-2 text-center text-sm text-red-500 font-medium border border-red-200 dark:border-red-800">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('member.login') }}" class="block py-2 text-center text-sm text-gray-600 dark:text-slate-300 hover:text-theme-primary mt-2">Member Login</a>
                    @endif
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="site-footer text-theme-accent">
            <div class="max-w-7xl mx-auto px-4 py-12">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- About -->
                    <div>
                        @php $footerLogo = $settings_values['org_logo'] ?? null; @endphp
                        <div class="flex items-center space-x-3 mb-4">
                            @if(!empty($footerLogo))
                                <img src="{{ asset('storage/'.$footerLogo) }}" alt="{{ $orgName }}" class="h-10 w-auto brightness-0 invert">
                            @endif
                            <span class="text-white font-bold text-lg">{{ $orgName }}</span>
                        </div>
                        <p class="text-theme-accent text-sm leading-relaxed">
                            {{ $orgName }} was established in {{ $settings_values['org_established_year'] ?? '1999' }} and registered as <strong class="text-theme-accent">RCS {{ $settings_values['org_registration_number'] ?? '6323' }}</strong> by the Registrar of Cooperative Societies in accordance with the Cooperative Societies Statute of 1991.
                            <a href="{{ route('history') }}" class="text-theme-accent hover:text-white underline mt-2 inline-block">learn more</a>
                        </p>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h3 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Quick Links</h3>
                        <ul class="space-y-2 text-sm">
                            <li><a href="{{ route('application') }}" class="text-theme-accent hover:text-white transition-colors">Become a Member</a></li>
                            <li><a href="{{ route('services') }}" class="text-theme-accent hover:text-white transition-colors">Savings Products</a></li>
                            <li><a href="{{ route('loan-products') }}" class="text-theme-accent hover:text-white transition-colors">Loan Products</a></li>
                            <li><a href="{{ route('news') }}" class="text-theme-accent hover:text-white transition-colors">News &amp; Events</a></li>
                            <li><a href="{{ route('contact') }}" class="text-theme-accent hover:text-white transition-colors">Contact Us</a></li>
                        </ul>
                    </div>

                    <!-- Products & Services -->
                    <div>
                        <h3 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Products &amp; Services</h3>
                        <ul class="space-y-2 text-sm">
                            <li><a href="{{ route('services') }}" class="text-theme-accent hover:text-white transition-colors">Share Account</a></li>
                            <li><a href="{{ route('services') }}" class="text-theme-accent hover:text-white transition-colors">Free Savings</a></li>
                            <li><a href="{{ route('services') }}" class="text-theme-accent hover:text-white transition-colors">Group Savings</a></li>
                            <li><a href="{{ route('services') }}" class="text-theme-accent hover:text-white transition-colors">Fixed Savings</a></li>
                            <li><a href="{{ route('services') }}" class="text-theme-accent hover:text-white transition-colors">Young Dreamers</a></li>
                            <li><a href="{{ route('loan-products') }}" class="text-theme-accent hover:text-white transition-colors">All Loan Products</a></li>
                            <li><a href="{{ route('msacco') }}" class="text-theme-accent hover:text-white transition-colors">M-SACCO Services</a></li>
                        </ul>
                    </div>

                    <!-- Contact -->
                    <div>
                        <h3 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Contact</h3>
                        <ul class="space-y-2 text-sm text-theme-accent">
                            <li class="flex items-start gap-2">
                                <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span><strong class="text-white text-xs">HQ:</strong> {{ $settings_values['org_address'] ?? 'Kaweeri Cell, East Division opp Mubende District Head quaters, Mubende, Uganda' }}</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span><strong class="text-white text-xs">Kalamba Branch:</strong> Opp. Akatale Komubuulo</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span><strong class="text-white text-xs">Kassanda Center:</strong> At The Arcade</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                <span>{{ $settings_values['org_email'] ?? 'mubendehq@gmail.com' }}</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                <a href="tel:{{ $settings_values['org_phone'] ?? '+256775125122' }}" class="hover:text-white transition-colors">{{ $settings_values['org_phone'] ?? '+256 0775 125 122' }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="border-t border-theme-secondary">
                <div class="max-w-7xl mx-auto px-4 py-4 flex flex-col sm:flex-row items-center justify-between text-sm text-theme-accent">
                    <p>&copy; {{ date('Y') }} {{ $settings_values['org_name'] ?? 'Mubende Employees and Community Sacco Ltd' }}. All Rights Reserved.</p>
                    <div class="flex items-center space-x-4 mt-2 sm:mt-0">
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition-colors text-xs">Admin Portal</a>
                    </div>
                </div>
            </div>
        </footer>
    
    <style>
        /* Dark-mode quick fallbacks for site layout */
        .dark .bg-white { background-color: #0f1724 !important; }
        .dark .text-gray-900, .dark .text-gray-700, .dark .text-slate-900, .dark .text-slate-800 { color: #e6eef6 !important; }
        .dark .text-gray-600, .dark .text-slate-600, .dark .text-gray-500 { color: #9aa3ad !important; }
        .dark .border-gray-200, .dark .border-gray-100, .dark .border-slate-200, .dark .border-slate-100 { border-color: #263241 !important; }
        .dark .bg-gray-50, .dark .bg-gray-100, .dark .bg-slate-50 { background-color: #0b1220 !important; }
        .dark .bg-green-100, .dark .bg-emerald-50 { background-color: rgba(16,185,129,0.12) !important; }
        .dark .hover\:bg-gray-50:hover, .dark .hover\:bg-gray-100:hover { background-color: rgba(255,255,255,0.03) !important; }
        .dark .hover\:bg-emerald-50:hover, .dark .group-hover\:bg-emerald-100:hover { background-color: rgba(16,185,129,0.15) !important; }
        .dark a.site-nav-link { color: #cfeee8 !important; }
        .dark .mobile-nav-link { color: #cfeee8 !important; }
        .dark .faq-item { border-color: #263241 !important; }
        .dark .faq-item button { color: #e6eef6 !important; }
        .dark .news-card { background-color: #0f1724 !important; border-color: #263241 !important; }
        .dark .news-card h3, .dark .news-card p, .dark .news-card span { color: #e6eef6 !important; }
        .dark .service-card { background-color: #0f1724 !important; border-color: #263241 !important; }
        .dark .glass-card { background: rgba(15,23,42,0.7) !important; border-color: #263241 !important; }
        .dark .glass-card:hover { background: rgba(15,23,42,0.85) !important; }
        .dark .page-header { background-color: color-mix(in srgb, var(--theme-primary) 85%, black 15%) !important; }
        .dark .site-form-input { background-color: #1e293b !important; border-color: #334155 !important; color: #e2e8f0 !important; }
        .dark .site-form-label { color: #cbd5e1 !important; }
        .dark .breadcrumb { color: #94a3b8 !important; }
        .dark .breadcrumb a { color: #94a3b8 !important; }
        .dark .section-heading { color: #e6eef6 !important; }
        .dark .section-subheading { color: #94a3b8 !important; }
    </style>

    </div>

    @stack('scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 600,
                once: true,
                offset: 80,
            });
        });
    </script>
</body>
</html>
