<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Kasambya SACCO') - Kasambya SACCO</title>
    <meta name="description" content="@yield('meta_description', 'Kasambya SACCO - Safe Savings & Affordable Loans.')">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --theme-primary: {{ $theme_primary_value ?? '#10b981' }};
            --theme-primary-dark: {{ $theme_secondary_value ?? '#047857' }};
        }
    </style>
    @stack('styles')
</head>
<body class="font-sans antialiased">

    <div id="app">

        <!-- Navigation -->
        <header class="fixed top-0 left-0 right-0 z-50 bg-black/80 backdrop-blur-lg border-b border-zinc-800" x-data="{ mobileOpen: false }">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex items-center justify-between h-16">
                    <!-- Logo -->
                    <a href="{{ route('home') }}" class="flex-shrink-0 text-white font-bold text-lg">
                            @if(!empty($settings_values['org_logo']))
                                <img src="{{ Storage::url($settings_values['org_logo']) }}" alt="{{ $settings_values['org_name'] ?? 'Kasambya SACCO' }}" class="h-8 w-auto">
                            @else
                                {{ $settings_values['org_name'] ?? 'Kasambya SACCO' }}
                            @endif
                    </a>

                    <!-- Desktop Navigation -->
                    <nav class="hidden lg:flex items-center space-x-1">
                        <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'text-white' : '' }}">HOME</a>

                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" @click.outside="open = false" class="nav-link flex items-center">
                                ABOUT
                                <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            <div x-show="open" class="absolute top-full left-0 mt-1 w-56 bg-zinc-900 border border-zinc-700 py-2 z-50">
                                <a href="{{ route('history') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-zinc-800 hover:text-white">Our History</a>
                                <a href="{{ route('about') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-zinc-800 hover:text-white">Kasambya SACCO</a>
                                <a href="{{ route('manager-message') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-zinc-800 hover:text-white">Message from the Manager</a>
                                <a href="{{ route('reports') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-zinc-800 hover:text-white">Financial Reports</a>
                            </div>
                        </div>

                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" @click.outside="open = false" class="nav-link flex items-center">
                                PRODUCTS & SERVICES
                                <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            <div x-show="open" class="absolute top-full left-0 mt-1 w-64 bg-zinc-900 border border-zinc-700 py-2 z-50">
                                <div class="px-4 py-1 text-xs font-semibold text-gray-500 uppercase tracking-wider">Saving Products</div>
                                <a href="{{ route('services') }}" class="block px-4 py-1.5 text-sm text-gray-300 hover:bg-zinc-800 hover:text-white">All Saving Accounts</a>
                                <div class="px-4 py-1 text-xs font-semibold text-gray-500 uppercase tracking-wider mt-1">Loan Products</div>
                                <a href="{{ route('loan-products') }}" class="block px-4 py-1.5 text-sm text-gray-300 hover:bg-zinc-800 hover:text-white">All Loan Products</a>
                                <div class="border-t border-zinc-700 my-1"></div>
                                <a href="{{ route('msacco') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-zinc-800 hover:text-white">M-SACCO Services</a>
                            </div>
                        </div>

                        <a href="{{ route('news') }}" class="nav-link {{ request()->routeIs('news*') ? 'text-white' : '' }}">NEWS & EVENTS</a>
                        <a href="{{ route('careers') }}" class="nav-link {{ request()->routeIs('careers') ? 'text-white' : '' }}">CAREERS</a>
                        <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'text-white' : '' }}">CONTACT</a>
                    </nav>

                    <div class="flex items-center space-x-4">
                        <a href="{{ route('application') }}" class="hidden sm:inline-block btn-primary text-sm">Become Member</a>

                        <button @click="mobileOpen = !mobileOpen" class="lg:hidden p-2 rounded-md text-gray-400 hover:text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path :class="{'hidden': mobileOpen, 'inline-flex': !mobileOpen}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                                <path :class="{'inline-flex': mobileOpen, 'hidden': !mobileOpen}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Navigation -->
            <div x-show="mobileOpen" class="lg:hidden border-t border-zinc-800 bg-black">
                <div class="px-4 py-3 space-y-2">
                    <a href="{{ route('home') }}" class="block py-2 text-gray-300 font-medium hover:text-white">HOME</a>

                    <div x-data="{ aboutOpen: false }">
                        <button @click="aboutOpen = !aboutOpen" class="flex items-center justify-between w-full py-2 text-gray-300 font-medium hover:text-white">
                            ABOUT
                            <svg :class="{'rotate-180': aboutOpen}" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="aboutOpen" class="pl-4 space-y-1 pb-2">
                            <a href="{{ route('history') }}" class="block py-1.5 text-sm text-gray-400 hover:text-white">Our History</a>
                            <a href="{{ route('about') }}" class="block py-1.5 text-sm text-gray-400 hover:text-white">Kasambya SACCO</a>
                            <a href="{{ route('manager-message') }}" class="block py-1.5 text-sm text-gray-400 hover:text-white">Message from the Manager</a>
                            <a href="{{ route('reports') }}" class="block py-1.5 text-sm text-gray-400 hover:text-white">Financial Reports</a>
                        </div>
                    </div>

                    <div x-data="{ productsOpen: false }">
                        <button @click="productsOpen = !productsOpen" class="flex items-center justify-between w-full py-2 text-gray-300 font-medium hover:text-white">
                            PRODUCTS & SERVICES
                            <svg :class="{'rotate-180': productsOpen}" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="productsOpen" class="pl-4 space-y-1 pb-2">
                            <div class="text-xs font-semibold text-gray-500 mt-1">Saving Products</div>
                            <a href="{{ route('services') }}" class="block py-1.5 text-sm text-gray-400 hover:text-white">All Saving Accounts</a>
                            <div class="text-xs font-semibold text-gray-500 mt-1">Loan Products</div>
                            <a href="{{ route('loan-products') }}" class="block py-1.5 text-sm text-gray-400 hover:text-white">All Loan Products</a>
                            <a href="{{ route('msacco') }}" class="block py-1.5 text-sm text-gray-400 hover:text-white">M-SACCO Services</a>
                        </div>
                    </div>

                    <a href="{{ route('news') }}" class="block py-2 text-gray-300 font-medium hover:text-white">NEWS & EVENTS</a>
                    <a href="{{ route('careers') }}" class="block py-2 text-gray-300 font-medium hover:text-white">CAREERS</a>
                    <a href="{{ route('contact') }}" class="block py-2 text-gray-300 font-medium hover:text-white">CONTACT</a>
                    <a href="{{ route('application') }}" class="block py-2 btn-primary text-sm mt-2">Become Member</a>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="pt-16">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="border-t border-zinc-800 bg-black">
            <div class="max-w-7xl mx-auto px-4 py-12">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div>
                        <span class="text-white font-bold text-lg">Kasambya SACCO</span>
                        <p class="text-gray-500 text-sm leading-relaxed mt-3">
                            Kasambya SACCO was established in 1999 and registered under Registration <strong class="text-gray-400">Number 6682</strong> by the Registrar of Cooperative Societies.
                        </p>
                    </div>

                    <div>
                        <h3 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Quick Links</h3>
                        <ul class="space-y-2 text-sm">
                            <li><a href="{{ route('application') }}" class="text-gray-500 hover:text-white transition-colors">Apply for Loan</a></li>
                            <li><a href="{{ route('news') }}" class="text-gray-500 hover:text-white transition-colors">News & Events</a></li>
                            <li><a href="{{ route('history') }}" class="text-gray-500 hover:text-white transition-colors">Our History</a></li>
                            <li><a href="{{ route('reports') }}" class="text-gray-500 hover:text-white transition-colors">Financial Reports</a></li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Account Types</h3>
                        <ul class="space-y-2 text-sm">
                            <li><a href="{{ route('services') }}" class="text-gray-500 hover:text-white transition-colors">Group Account</a></li>
                            <li><a href="{{ route('services') }}" class="text-gray-500 hover:text-white transition-colors">Individual Account</a></li>
                            <li><a href="{{ route('services') }}" class="text-gray-500 hover:text-white transition-colors">Institutional Account</a></li>
                            <li><a href="{{ route('services') }}" class="text-gray-400 hover:text-white transition-colors font-medium">View All Account Types</a></li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Contact</h3>
                        <div class="space-y-3 text-sm text-gray-500">
                            <p>Kasambya Town, Uganda</p>
                            <p>{{ $settings->get('org_email')->value ?? 'info@kasambyasacco.com' }}</p>
                            <p>{{ $settings->get('org_phone')->value ?? '+256 0775 125 122 / 0779 892 660' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-t border-zinc-900">
                <div class="max-w-7xl mx-auto px-4 py-4 flex flex-col sm:flex-row items-center justify-between text-sm text-gray-600">
                    <p>&copy; {{ date('Y') }} Kasambya SACCO. All Rights Reserved.</p>
                </div>
            </div>
        </footer>

    </div>

    @stack('scripts')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
