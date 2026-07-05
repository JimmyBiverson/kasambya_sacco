<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ dark: localStorage.getItem('theme') === 'dark' }" x-effect="document.documentElement.classList.toggle('dark', dark); localStorage.setItem('theme', dark ? 'dark' : 'light')">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Kasambya SACCO') - Kasambya SACCO</title>
    <meta name="description" content="@yield('meta_description', 'Kasambya SACCO - Safe Savings & Affordable Loans.')">
    {{-- Dynamic favicon / social preview --}}
    @php
        $favicon = $settings_values['org_favicon'] ?? ($settings_values['org_logo'] ?? null);
        $socialImage = $settings_values['org_logo'] ?? null;
    @endphp
    @if(!empty($favicon))
        <link rel="icon" href="{{ Storage::url($favicon) }}" />
        <link rel="shortcut icon" href="{{ Storage::url($favicon) }}" />
    @endif
    @if(!empty($socialImage))
        <meta property="og:image" content="{{ Storage::url($socialImage) }}" />
        <meta name="twitter:image" content="{{ Storage::url($socialImage) }}" />
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
<body class="font-sans antialiased bg-white text-gray-900 dark:bg-slate-900 dark:text-slate-200 transition-colors duration-200">

    <div id="app">

        <!-- Top Bar -->
        <div class="bg-green-800 text-green-100 text-sm">
            <div class="max-w-7xl mx-auto px-4 flex items-center justify-between h-10">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    <a href="tel:+256775125122" class="hover:text-white transition-colors">+256 775 125 122</a>
                </div>
                <div class="flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>Mon - Fri 8:45 AM - 5:00 PM | Sat: 8:45 AM - 3:00 PM</span>
                </div>
            </div>
        </div>

        <!-- Header -->
        <header class="sticky top-0 z-50 bg-white dark:bg-slate-950 border-b border-gray-200 dark:border-slate-800" x-data="{ mobileOpen: false }">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex items-center justify-between h-16">
                    <!-- Logo -->
                    <a href="{{ route('home') }}" class="flex-shrink-0">
                        @if(isset($settings) && $settings->has('org_logo') && $settings->get('org_logo')?->value)
                            <img src="{{ Storage::url($settings->get('org_logo')->value) }}" alt="{{ $settings->get('org_name')->value ?? 'Kasambya SACCO' }}" class="h-10 w-auto">
                        @else
                            <span class="text-xl font-bold text-green-700">Kasambya <span class="text-green-600">SACCO</span></span>
                        @endif
                    </a>

                    <!-- Desktop Navigation -->
                    <nav class="hidden lg:flex items-center space-x-1">
                        <a href="{{ route('home') }}" class="site-nav-link {{ request()->routeIs('home') ? 'text-green-600' : '' }}">HOME</a>

                        <!-- About Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" @click.outside="open = false" class="site-nav-link flex items-center gap-1 {{ request()->routeIs('history', 'about', 'manager-message', 'reports') ? 'text-green-600' : '' }}">
                                ABOUT
                                <svg class="w-3 h-3" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            <div x-show="open" @click.outside="open = false" x-cloak class="absolute left-0 mt-2 w-56 bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 rounded-lg shadow-md z-50 overflow-hidden">
                                <a href="{{ route('history') }}" class="block px-4 py-2.5 text-sm text-gray-700 dark:text-slate-200 hover:bg-green-50 hover:text-green-700">Our History</a>
                                <a href="{{ route('about') }}" class="block px-4 py-2.5 text-sm text-gray-700 dark:text-slate-200 hover:bg-green-50 hover:text-green-700">Kasambya SACCO</a>
                                <a href="{{ route('manager-message') }}" class="block px-4 py-2.5 text-sm text-gray-700 dark:text-slate-200 hover:bg-green-50 hover:text-green-700">Message from the Manager</a>
                                <a href="{{ route('reports') }}" class="block px-4 py-2.5 text-sm text-gray-700 dark:text-slate-200 hover:bg-green-50 hover:text-green-700">Financial Reports</a>
                            </div>
                        </div>

                        <!-- Products & Services Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" @click.outside="open = false" class="site-nav-link flex items-center gap-1 {{ request()->routeIs('services', 'loan-products', 'msacco') ? 'text-green-600' : '' }}">
                                PRODUCTS & SERVICES
                                <svg class="w-3 h-3" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            <div x-show="open" @click.outside="open = false" x-cloak class="absolute left-0 mt-2 w-[220px] bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 rounded-lg shadow-md z-50 overflow-hidden">
                                <div class="px-4 py-1.5 text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase tracking-wider">Saving Products</div>
                                <a href="{{ route('services') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-slate-200 hover:bg-green-50 hover:text-green-700">Our Services</a>
                                <div class="border-t border-gray-100 dark:border-slate-700 my-1"></div>
                                <div class="px-4 py-1.5 text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase tracking-wider">Loan Products</div>
                                <a href="{{ route('loan-products') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-slate-200 hover:bg-green-50 hover:text-green-700">Loan Products</a>
                                <div class="border-t border-gray-100 dark:border-slate-700 my-1"></div>
                                <a href="{{ route('msacco') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-slate-200 hover:bg-green-50 hover:text-green-700">M-SACCO Services</a>
                            </div>
                        </div>

                        <a href="{{ route('news') }}" class="site-nav-link {{ request()->routeIs('news*') ? 'text-green-600' : '' }}">NEWS & EVENTS</a>
                        <a href="{{ route('careers') }}" class="site-nav-link {{ request()->routeIs('careers') ? 'text-green-600' : '' }}">CAREERS</a>
                        <a href="{{ route('contact') }}" class="site-nav-link {{ request()->routeIs('contact') ? 'text-green-600' : '' }}">CONTACT</a>
                    </nav>

                    <div class="flex items-center space-x-3">
                        <button @click="dark = !dark" class="hidden sm:inline-flex text-gray-600 dark:text-slate-300 hover:text-amber-500 dark:hover:text-amber-400 p-1.5 rounded-lg hover:bg-gray-100 dark:hover:bg-slate-800 transition-all" title="Toggle dark mode">
                            <svg x-cloak x-show="!dark" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                            <svg x-cloak x-show="dark" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        </button>
                        <a href="{{ route('application') }}" class="hidden sm:inline-block site-btn-primary text-sm">Become Member</a>
                        @if(auth()->check() && auth()->user()->roles()->whereIn('name', ['Super Admin', 'Branch Manager', 'Loan Officer', 'Teller', 'Accountant', 'HR Officer', 'Auditor'])->exists())
                            <a href="{{ route('admin.dashboard') }}" class="hidden sm:inline-block bg-amber-600 hover:bg-amber-700 text-white text-xs font-semibold px-3 py-2 transition-colors">Admin Panel</a>
                        @endif
                        @if(session()->has('member_id'))
                            <a href="{{ route('member.dashboard') }}" class="hidden sm:inline-block text-sm text-green-700 hover:text-green-800 font-semibold">My Dashboard</a>
                            <form action="{{ route('member.logout') }}" method="POST" class="hidden sm:inline-block">
                                @csrf
                                <button type="submit" class="text-sm text-gray-500 hover:text-red-650 font-medium">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('member.login') }}" class="hidden sm:inline-block text-sm text-gray-600 hover:text-green-600 font-medium" title="Member Login">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                            </a>
                        @endif
                        <button @click="mobileOpen = !mobileOpen" class="lg:hidden p-2 rounded-md text-gray-600 hover:text-green-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path :class="{'hidden': mobileOpen, 'inline-flex': !mobileOpen}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                                <path :class="{'inline-flex': mobileOpen, 'hidden': !mobileOpen}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Navigation -->
            <div x-show="mobileOpen" class="lg:hidden border-t border-gray-200 bg-white" x-cloak>
                <div class="px-4 py-3 space-y-1">
                    <a href="{{ route('home') }}" class="mobile-nav-link">HOME</a>

                    <div x-data="{ aboutOpen: false }">
                        <button @click="aboutOpen = !aboutOpen" class="flex items-center justify-between w-full py-2 text-gray-700 font-medium hover:text-green-600">
                            ABOUT
                            <svg :class="{'rotate-180': aboutOpen}" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="aboutOpen" class="pl-4 space-y-1 pb-2">
                            <a href="{{ route('history') }}" class="block py-1.5 text-sm text-gray-600 hover:text-green-600">Our History</a>
                            <a href="{{ route('about') }}" class="block py-1.5 text-sm text-gray-600 hover:text-green-600">Kasambya SACCO</a>
                            <a href="{{ route('manager-message') }}" class="block py-1.5 text-sm text-gray-600 hover:text-green-600">Message from the Manager</a>
                            <a href="{{ route('reports') }}" class="block py-1.5 text-sm text-gray-600 hover:text-green-600">Financial Reports</a>
                        </div>
                    </div>

                    <div x-data="{ productsOpen: false }">
                        <button @click="productsOpen = !productsOpen" class="flex items-center justify-between w-full py-2 text-gray-700 font-medium hover:text-green-600">
                            PRODUCTS & SERVICES
                            <svg :class="{'rotate-180': productsOpen}" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="productsOpen" class="pl-4 space-y-1 pb-2">
                            <div class="text-xs font-semibold text-gray-500 mt-1">Saving Products</div>
                            <a href="{{ route('services') }}" class="block py-1.5 text-sm text-gray-600 hover:text-green-600">Our Services</a>
                            <div class="text-xs font-semibold text-gray-500 mt-1">Loan Products</div>
                            <a href="{{ route('loan-products') }}" class="block py-1.5 text-sm text-gray-600 hover:text-green-600">Loan Products</a>
                            <a href="{{ route('msacco') }}" class="block py-1.5 text-sm text-gray-600 hover:text-green-600">M-SACCO Services</a>
                        </div>
                    </div>

                    <a href="{{ route('news') }}" class="mobile-nav-link">NEWS & EVENTS</a>
                    <a href="{{ route('careers') }}" class="mobile-nav-link">CAREERS</a>
                    <a href="{{ route('contact') }}" class="mobile-nav-link">CONTACT</a>
                    <a href="{{ route('application') }}" class="block py-2 site-btn-primary text-sm text-center mt-3">Become Member</a>
                    @if(auth()->check() && auth()->user()->roles()->whereIn('name', ['Super Admin', 'Branch Manager', 'Loan Officer', 'Teller', 'Accountant', 'HR Officer', 'Auditor'])->exists())
                        <a href="{{ route('admin.dashboard') }}" class="block py-2 text-center text-sm bg-amber-600 hover:bg-amber-700 text-white font-medium mt-2">Admin Panel</a>
                    @endif
                    @if(session()->has('member_id'))
                        <a href="{{ route('member.dashboard') }}" class="block py-2 text-center text-sm text-green-700 font-semibold mt-2">My Dashboard</a>
                        <form action="{{ route('member.logout') }}" method="POST" class="mt-2">
                            @csrf
                            <button type="submit" class="w-full py-2 text-center text-sm text-red-500 font-medium border border-red-200">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('member.login') }}" class="block py-2 text-center text-sm text-gray-600 hover:text-green-600 mt-2">Member Login</a>
                    @endif
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-green-900 text-green-200">
            <div class="max-w-7xl mx-auto px-4 py-12">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- About -->
                    <div>
                        @if(isset($settings) && $settings->has('org_logo') && $settings->get('org_logo')?->value)
                            <img src="{{ Storage::url($settings->get('org_logo')->value) }}" alt="Kasambya SACCO" class="h-10 w-auto mb-4 brightness-0 invert">
                        @else
                            <span class="text-white font-bold text-lg mb-4 block">Kasambya SACCO</span>
                        @endif
                        <p class="text-green-300 text-sm leading-relaxed">
                            Kasambya SACCO was established in 2003 and registered under Registration <strong class="text-green-200">Number 6682</strong> by the Registrar of Cooperative Societies in accordance with the Cooperative Societies Statute of 1991.
                            <a href="{{ route('history') }}" class="text-green-300 hover:text-white underline mt-2 inline-block">learn more</a>
                        </p>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h3 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Quick Links</h3>
                        <ul class="space-y-2 text-sm">
                            <li><a href="{{ route('application') }}" class="text-green-300 hover:text-white transition-colors">Apply for Loan</a></li>
                            <li><a href="{{ route('news') }}" class="text-green-300 hover:text-white transition-colors">News & Events</a></li>
                            <li><a href="{{ route('history') }}" class="text-green-300 hover:text-white transition-colors">Our History</a></li>
                            <li><a href="{{ route('reports') }}" class="text-green-300 hover:text-white transition-colors">Financial Reports</a></li>
                        </ul>
                    </div>

                    <!-- Account & Loan Types -->
                    <div>
                        <h3 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Account Types</h3>
                        <ul class="space-y-2 text-sm">
                            <li><a href="{{ route('services') }}" class="text-green-300 hover:text-white transition-colors">Group Account</a></li>
                            <li><a href="{{ route('services') }}" class="text-green-300 hover:text-white transition-colors">Individual Account</a></li>
                            <li><a href="{{ route('services') }}" class="text-green-300 hover:text-white transition-colors">Institutional Account</a></li>
                            <li><a href="{{ route('services') }}" class="text-green-200 hover:text-white transition-colors font-medium">View All Account Types</a></li>
                        </ul>
                        <h3 class="text-white font-semibold mt-6 mb-4 text-sm uppercase tracking-wider">Loan Products</h3>
                        <ul class="space-y-2 text-sm">
                            <li><a href="{{ route('loan-products') }}" class="text-green-300 hover:text-white transition-colors">Agriculture Loan</a></li>
                            <li><a href="{{ route('loan-products') }}" class="text-green-300 hover:text-white transition-colors">Transport Loan</a></li>
                            <li><a href="{{ route('loan-products') }}" class="text-green-300 hover:text-white transition-colors">Housing Loan</a></li>
                            <li><a href="{{ route('loan-products') }}" class="text-green-200 hover:text-white transition-colors font-medium">All Loan Products</a></li>
                        </ul>
                    </div>

                    <!-- Contact -->
                    <div>
                        <h3 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Contact</h3>
                        <div class="space-y-3 text-sm text-green-300">
                            <p class="flex items-start gap-2">
                                <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                Kasambya Town Council, Masengere Road, Kasambya, Uganda
                            </p>
                            <p class="flex items-center gap-2">
                                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                {{ isset($settings) && $settings->has('org_email') ? $settings->get('org_email')->value : 'kasambyasacco@gmail.com' }}
                            </p>
                            <p class="flex items-center gap-2">
                                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                <a href="tel:+256775125122" class="hover:text-white transition-colors">+256 0775 125 122 / 0779 892 660</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-t border-green-800">
                <div class="max-w-7xl mx-auto px-4 py-4 flex flex-col sm:flex-row items-center justify-between text-sm text-green-400">
                    <p>&copy; {{ date('Y') }} Kasambya SACCO. All Rights Reserved.</p>
                    <div class="flex items-center space-x-4 mt-2 sm:mt-0">
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition-colors text-xs">Admin Portal</a>
                    </div>
                </div>
            </div>
        </footer>
    
    <style>
        /* Dark-mode quick fallbacks for site layout */
        .dark .bg-white { background-color: #0f1724 !important; }
        .dark .text-gray-900, .dark .text-gray-700 { color: #e6eef6 !important; }
        .dark .border-gray-200, .dark .border-gray-100 { border-color: #263241 !important; }
        .dark .bg-green-800 { background-color: #08303a !important; }
        .dark a.site-nav-link { color: #cfeee8 !important; }
    </style>

    </div>

    @stack('scripts')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
