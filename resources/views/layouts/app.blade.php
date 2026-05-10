<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Kasambya Sacco') - Kasambya Sacco</title>
    <meta name="description" content="@yield('meta_description', 'Kasambya SACCO - Safe Savings & Affordable Loans. Join a trusted SACCO that empowers you with low-interest loans, secure savings, and financial growth.')">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @stack('styles')
</head>
<body class="font-sans antialiased text-gray-800">

    <!-- Top Bar -->
    <div class="top-bar text-white text-sm py-2">
        <div class="max-w-7xl mx-auto px-4 flex flex-wrap items-center justify-between">
            <div class="flex items-center space-x-4">
                <span class="flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/></svg>
                    +256 775 125 122
                </span>
                <span class="hidden md:flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg>
                    Mon - Fri 8:45 AM - 5:00 PM | Sat: 8:45 AM - 3:00 PM
                </span>
            </div>
            <div class="flex items-center space-x-3">
                <span class="hidden sm:inline">Low-Interest Loans • Secure Savings • Fast Approvals</span>
            </div>
        </div>
    </div>

    <!-- Header / Navigation -->
    <header class="bg-white shadow-sm sticky top-0 z-50" x-data="{ mobileOpen: false }">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex-shrink-0">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-green-700 rounded-full flex items-center justify-center text-white font-bold text-xl">KS</div>
                        <div class="ml-3">
                            <div class="text-green-800 font-bold text-lg leading-tight">Kasambya</div>
                            <div class="text-green-600 text-sm leading-tight -mt-1">SACCO</div>
                        </div>
                    </div>
                </a>

                <!-- Desktop Navigation -->
                <nav class="hidden lg:flex items-center space-x-1">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'text-green-700' : '' }}">HOME</a>
                    
                    <!-- About Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" @click.outside="open = false" class="nav-link flex items-center">
                            ABOUT
                            <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="open" class="absolute top-full left-0 mt-1 w-56 bg-white rounded-lg shadow-xl border border-gray-100 py-2 z-50">
                            <a href="{{ route('history') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700">Our History</a>
                            <a href="{{ route('about') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700">Kasambya Sacco</a>
                            <a href="{{ route('manager-message') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700">Message from the Manager</a>
                            <a href="{{ route('reports') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700">Financial Reports</a>
                        </div>
                    </div>

                    <!-- Products Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" @click.outside="open = false" class="nav-link flex items-center">
                            PRODUCTS & SERVICES
                            <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="open" class="absolute top-full left-0 mt-1 w-64 bg-white rounded-lg shadow-xl border border-gray-100 py-2 z-50">
                            <div class="px-4 py-1 text-xs font-semibold text-green-700 uppercase tracking-wider">Saving Products</div>
                            <a href="{{ route('services') }}" class="block px-4 py-1.5 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700">All Saving Accounts</a>
                            <div class="px-4 py-1 text-xs font-semibold text-green-700 uppercase tracking-wider mt-1">Loan Products</div>
                            <a href="{{ route('loan-products') }}" class="block px-4 py-1.5 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700">All Loan Products</a>
                            <div class="border-t my-1"></div>
                            <a href="{{ route('msacco') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700">M-SACCO Services</a>
                        </div>
                    </div>

                    <a href="{{ route('news') }}" class="nav-link {{ request()->routeIs('news*') ? 'text-green-700' : '' }}">NEWS & EVENTS</a>
                    <a href="{{ route('careers') }}" class="nav-link {{ request()->routeIs('careers') ? 'text-green-700' : '' }}">CAREERS</a>
                    <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'text-green-700' : '' }}">CONTACT</a>
                </nav>

                <!-- Become Member Button -->
                <div class="flex items-center space-x-4">
                    <a href="{{ route('application') }}" class="hidden sm:inline-block btn-gold text-sm">Become Member</a>
                    
                    <!-- Mobile menu button -->
                    <button @click="mobileOpen = !mobileOpen" class="lg:hidden p-2 rounded-md text-gray-600 hover:text-green-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path :class="{'hidden': mobileOpen, 'inline-flex': !mobileOpen}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            <path :class="{'inline-flex': mobileOpen, 'hidden': !mobileOpen}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div x-show="mobileOpen" class="lg:hidden border-t border-gray-200 bg-white">
            <div class="px-4 py-3 space-y-2">
                <a href="{{ route('home') }}" class="block py-2 text-gray-700 font-medium hover:text-green-700">HOME</a>
                
                <div x-data="{ aboutOpen: false }">
                    <button @click="aboutOpen = !aboutOpen" class="flex items-center justify-between w-full py-2 text-gray-700 font-medium hover:text-green-700">
                        ABOUT
                        <svg :class="{'rotate-180': aboutOpen}" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="aboutOpen" class="pl-4 space-y-1 pb-2">
                        <a href="{{ route('history') }}" class="block py-1.5 text-sm text-gray-600 hover:text-green-700">Our History</a>
                        <a href="{{ route('about') }}" class="block py-1.5 text-sm text-gray-600 hover:text-green-700">Kasambya Sacco</a>
                        <a href="{{ route('manager-message') }}" class="block py-1.5 text-sm text-gray-600 hover:text-green-700">Message from the Manager</a>
                        <a href="{{ route('reports') }}" class="block py-1.5 text-sm text-gray-600 hover:text-green-700">Financial Reports</a>
                    </div>
                </div>

                <div x-data="{ productsOpen: false }">
                    <button @click="productsOpen = !productsOpen" class="flex items-center justify-between w-full py-2 text-gray-700 font-medium hover:text-green-700">
                        PRODUCTS & SERVICES
                        <svg :class="{'rotate-180': productsOpen}" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="productsOpen" class="pl-4 space-y-1 pb-2">
                        <div class="text-xs font-semibold text-green-700 mt-1">Saving Products</div>
                        <a href="{{ route('services') }}" class="block py-1.5 text-sm text-gray-600 hover:text-green-700">All Saving Accounts</a>
                        <div class="text-xs font-semibold text-green-700 mt-1">Loan Products</div>
                        <a href="{{ route('loan-products') }}" class="block py-1.5 text-sm text-gray-600 hover:text-green-700">All Loan Products</a>
                        <a href="{{ route('msacco') }}" class="block py-1.5 text-sm text-gray-600 hover:text-green-700">M-SACCO Services</a>
                    </div>
                </div>

                <a href="{{ route('news') }}" class="block py-2 text-gray-700 font-medium hover:text-green-700">NEWS & EVENTS</a>
                <a href="{{ route('careers') }}" class="block py-2 text-gray-700 font-medium hover:text-green-700">CAREERS</a>
                <a href="{{ route('contact') }}" class="block py-2 text-gray-700 font-medium hover:text-green-700">CONTACT</a>
                <a href="{{ route('application') }}" class="block py-2 text-center btn-gold text-sm mt-2">Become Member</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer-section text-white">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- About -->
                <div>
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-green-800 font-bold">KS</div>
                        <span class="ml-3 text-lg font-bold">Kasambya Sacco</span>
                    </div>
                    <p class="text-gray-300 text-sm leading-relaxed">
                        Kasambya SACCO was established in 2003 and registered under Registration <strong>Number 6682</strong> by the Registrar of Cooperative Societies.
                    </p>
                    <a href="{{ route('history') }}" class="text-amber-400 hover:text-amber-300 text-sm font-medium mt-2 inline-block">learn more</a>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-bold mb-4">Quick Links</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('application') }}" class="text-gray-300 hover:text-amber-400 transition-colors">Apply for Loan</a></li>
                        <li><a href="{{ route('news') }}" class="text-gray-300 hover:text-amber-400 transition-colors">News & Events</a></li>
                        <li><a href="{{ route('history') }}" class="text-gray-300 hover:text-amber-400 transition-colors">Our History</a></li>
                        <li><a href="{{ route('reports') }}" class="text-gray-300 hover:text-amber-400 transition-colors">Financial Reports</a></li>
                    </ul>
                </div>

                <!-- Account Types -->
                <div>
                    <h3 class="text-lg font-bold mb-4">Account Types</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('services') }}" class="text-gray-300 hover:text-amber-400 transition-colors">Group Account</a></li>
                        <li><a href="{{ route('services') }}" class="text-gray-300 hover:text-amber-400 transition-colors">Individual Account</a></li>
                        <li><a href="{{ route('services') }}" class="text-gray-300 hover:text-amber-400 transition-colors">Institutional Account</a></li>
                        <li><a href="{{ route('services') }}" class="text-amber-400 hover:text-amber-300 transition-colors font-medium">View All Account Types</a></li>
                    </ul>
                    <h3 class="text-lg font-bold mt-6 mb-4">Loan Products</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('loan-products') }}" class="text-gray-300 hover:text-amber-400 transition-colors">Agriculture Loan</a></li>
                        <li><a href="{{ route('loan-products') }}" class="text-gray-300 hover:text-amber-400 transition-colors">Transport Loan</a></li>
                        <li><a href="{{ route('loan-products') }}" class="text-gray-300 hover:text-amber-400 transition-colors">Housing Loan</a></li>
                        <li><a href="{{ route('loan-products') }}" class="text-amber-400 hover:text-amber-300 transition-colors font-medium">All Loan Products</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h3 class="text-lg font-bold mb-4">Contact</h3>
                    <div class="space-y-3 text-sm text-gray-300">
                        <p class="flex items-start">
                            <svg class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Kasambya Town Council, Masengere Road, Kasambya, Uganda
                        </p>
                        <p class="flex items-center">
                            <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/></svg>
                            kasambyasacco@gmail.com
                        </p>
                        <p class="flex items-center">
                            <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/></svg>
                            +256 0775 125 122 / 0779 892 660
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom bar -->
        <div class="border-t border-green-800/50">
            <div class="max-w-7xl mx-auto px-4 py-4 flex flex-col sm:flex-row items-center justify-between text-sm text-gray-400">
                <p>&copy; {{ date('Y') }} Kasambya Sacco. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
