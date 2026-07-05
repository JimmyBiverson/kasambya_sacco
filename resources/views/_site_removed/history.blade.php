@extends('layouts.app')

@section('content')

<div class="page-header">
    <div class="max-w-7xl mx-auto px-4">
        <h1>Our History</h1>
        <p>The story of Kasambya SACCO</p>
    </div>
</div>

<section class="py-20 bg-black">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="border border-zinc-800 min-h-[380px] flex flex-col items-center justify-center text-gray-600 relative">
                <div class="absolute top-4 left-4 border border-zinc-700 px-4 py-2 text-white text-xl font-bold">Est. 1999</div>
                <span>Kasambya SACCO Headquarters</span>
            </div>
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Established in 1999</h2>
                <p class="text-gray-500 text-lg leading-relaxed mb-4">Kasambya SACCO was founded in 1999 by a group of visionary community members in Kasambya. Recognizing the need for accessible and affordable financial services in the area, they came together to form a member-owned savings and credit cooperative that would serve the community's financial needs.</p>
                <p class="text-gray-500 text-lg leading-relaxed mb-4">From humble beginnings with a small membership base and limited capital, the SACCO has grown steadily over the years. It was fully registered by the Registrar of Cooperative Societies under <strong class="text-gray-300">Registration Number 6682</strong>, gaining official recognition and regulatory oversight.</p>
                <p class="text-gray-500 text-lg leading-relaxed">Today, Kasambya SACCO stands as a testament to the power of collective action and community-driven development. With thousands of active members, a professional staff team, and a wide range of financial products and services, we continue to fulfill our founding mission of empowering our community through financial inclusion.</p>
            </div>
        </div>
    </div>
</section>

<section class="py-20 border-t border-zinc-900 bg-black">
    <div class="max-w-4xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-white">Our Journey</h2>
            <p class="text-gray-500 mt-4 text-lg">Key milestones in the history of Kasambya SACCO</p>
        </div>
        <div class="relative">
            <div class="absolute left-1/2 top-0 bottom-0 w-px bg-zinc-800 -translate-x-1/2 hidden md:block"></div>
            <div class="space-y-12">
                <div class="relative flex flex-col md:flex-row items-center md:items-start gap-8">
                    <div class="hidden md:block absolute left-1/2 top-0 w-4 h-4 bg-zinc-700 rounded-full -translate-x-1/2 z-10"></div>
                    <div class="md:w-[calc(50%-40px)] md:mr-auto border border-zinc-800 p-6">
                        <div class="text-gray-400 text-sm font-bold mb-2">1999</div>
                        <h3 class="text-white font-semibold text-lg mb-2">Foundation</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">Kasambya SACCO was established by community members in Kasambya Town to provide accessible savings and credit services.</p>
                    </div>
                    <div class="md:w-[calc(50%-40px)]"></div>
                </div>
                <div class="relative flex flex-col md:flex-row items-center md:items-start gap-8">
                    <div class="hidden md:block absolute left-1/2 top-0 w-4 h-4 bg-zinc-700 rounded-full -translate-x-1/2 z-10"></div>
                    <div class="md:w-[calc(50%-40px)]"></div>
                    <div class="md:w-[calc(50%-40px)] md:ml-auto border border-zinc-800 p-6">
                        <div class="text-gray-400 text-sm font-bold mb-2">2005</div>
                        <h3 class="text-white font-semibold text-lg mb-2">Official Registration</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">The SACCO was fully registered by the Registrar of Cooperative Societies, gaining official regulatory status and recognition.</p>
                    </div>
                </div>
                <div class="relative flex flex-col md:flex-row items-center md:items-start gap-8">
                    <div class="hidden md:block absolute left-1/2 top-0 w-4 h-4 bg-zinc-700 rounded-full -translate-x-1/2 z-10"></div>
                    <div class="md:w-[calc(50%-40px)] md:mr-auto border border-zinc-800 p-6">
                        <div class="text-gray-400 text-sm font-bold mb-2">2010</div>
                        <h3 class="text-white font-semibold text-lg mb-2">Expansion of Services</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">Expanded the range of loan products to include development loans, school fees loans, and emergency loans to better serve member needs.</p>
                    </div>
                    <div class="md:w-[calc(50%-40px)]"></div>
                </div>
                <div class="relative flex flex-col md:flex-row items-center md:items-start gap-8">
                    <div class="hidden md:block absolute left-1/2 top-0 w-4 h-4 bg-zinc-700 rounded-full -translate-x-1/2 z-10"></div>
                    <div class="md:w-[calc(50%-40px)]"></div>
                    <div class="md:w-[calc(50%-40px)] md:ml-auto border border-zinc-800 p-6">
                        <div class="text-gray-400 text-sm font-bold mb-2">2015</div>
                        <h3 class="text-white font-semibold text-lg mb-2">Membership Growth</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">Membership surpassed 5,000 active members, reflecting growing trust in the SACCO's services and management.</p>
                    </div>
                </div>
                <div class="relative flex flex-col md:flex-row items-center md:items-start gap-8">
                    <div class="hidden md:block absolute left-1/2 top-0 w-4 h-4 bg-zinc-700 rounded-full -translate-x-1/2 z-10"></div>
                    <div class="md:w-[calc(50%-40px)] md:mr-auto border border-zinc-800 p-6">
                        <div class="text-gray-400 text-sm font-bold mb-2">2020</div>
                        <h3 class="text-white font-semibold text-lg mb-2">Digital Transformation</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">Launched the M-SACCO mobile banking platform, enabling members to access their accounts, make payments, and apply for loans via mobile phone.</p>
                    </div>
                    <div class="md:w-[calc(50%-40px)]"></div>
                </div>
                <div class="relative flex flex-col md:flex-row items-center md:items-start gap-8">
                    <div class="hidden md:block absolute left-1/2 top-0 w-4 h-4 bg-zinc-700 rounded-full -translate-x-1/2 z-10"></div>
                    <div class="md:w-[calc(50%-40px)]"></div>
                    <div class="md:w-[calc(50%-40px)] md:ml-auto border border-zinc-800 p-6">
                        <div class="text-gray-400 text-sm font-bold mb-2">2026</div>
                        <h3 class="text-white font-semibold text-lg mb-2">Continued Growth</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">Serving over 10,000 members across 25+ districts with a professional team of 50+ staff and a comprehensive range of financial products.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-20 border-t border-zinc-900 bg-black">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-white">Vision, Mission & Core Values</h2>
            <p class="text-gray-500 mt-4 text-lg">The principles that have guided us since 1999</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="border border-zinc-800 p-8 hover:border-zinc-600 transition-colors">
                <div class="text-white mb-4">
                    <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M2 12h4l3-9 3 18 3-9h4"/></svg>
                </div>
                <h3 class="text-white font-semibold text-lg mb-3">Our Vision</h3>
                <p class="text-gray-500 text-sm leading-relaxed">To provide affordable and sustainable financial services to our members, fostering economic growth and community development throughout the region.</p>
            </div>
            <div class="border border-zinc-800 p-8 hover:border-zinc-600 transition-colors">
                <div class="text-white mb-4">
                    <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                </div>
                <h3 class="text-white font-semibold text-lg mb-3">Our Mission</h3>
                <p class="text-gray-500 text-sm leading-relaxed">To develop a strong spirit of saving among our members, mobilize savings for productive investment, and provide affordable credit to improve livelihoods.</p>
            </div>
            <div class="border border-zinc-800 p-8 hover:border-zinc-600 transition-colors">
                <div class="text-white mb-4">
                    <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                <h3 class="text-white font-semibold text-lg mb-3">Core Values</h3>
                <ul class="space-y-1 text-sm text-gray-500">
                    <li class="flex items-baseline gap-2"><span class="text-gray-400">-</span> Integrity and honesty in all operations</li>
                    <li class="flex items-baseline gap-2"><span class="text-gray-400">-</span> Transparency and accountability to members</li>
                    <li class="flex items-baseline gap-2"><span class="text-gray-400">-</span> Member-focused service delivery</li>
                    <li class="flex items-baseline gap-2"><span class="text-gray-400">-</span> Innovation and continuous improvement</li>
                    <li class="flex items-baseline gap-2"><span class="text-gray-400">-</span> Teamwork and collaboration</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="py-20 border-t border-zinc-900 bg-black">
    <div class="max-w-4xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-white">The Amazing Team</h2>
            <p class="text-gray-500 mt-4 text-lg">Meet the leadership driving Kasambya SACCO forward</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="border border-zinc-800 p-6 text-center hover:border-zinc-600 transition-colors">
                <div class="w-28 h-28 rounded-full border-2 border-zinc-600 mx-auto mb-4 flex items-center justify-center text-gray-400 text-lg">BB</div>
                <h4 class="text-white font-semibold">Byamukama Bernard</h4>
                <div class="text-gray-500 text-sm mt-1">SACCO Manager</div>
                <p class="text-gray-600 text-xs mt-3 leading-relaxed">Provides strategic direction and leadership, ensuring the SACCO fulfills its mission of serving members with integrity and excellence.</p>
                <div class="flex justify-center gap-2 mt-4">
                    <a href="#" class="w-8 h-8 border border-zinc-700 flex items-center justify-center text-gray-500 hover:border-white hover:text-white transition-colors"><svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></a>
                    <a href="#" class="w-8 h-8 border border-zinc-700 flex items-center justify-center text-gray-500 hover:border-white hover:text-white transition-colors"><svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg></a>
                    <a href="#" class="w-8 h-8 border border-zinc-700 flex items-center justify-center text-gray-500 hover:border-white hover:text-white transition-colors"><svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg></a>
                </div>
            </div>
            <div class="border border-zinc-800 p-6 text-center hover:border-zinc-600 transition-colors">
                <div class="w-28 h-28 rounded-full border-2 border-zinc-600 mx-auto mb-4 flex items-center justify-center text-gray-400 text-lg">AC</div>
                <h4 class="text-white font-semibold">Ampeire Charity</h4>
                <div class="text-gray-500 text-sm mt-1">Accountant / Finance Officer</div>
                <p class="text-gray-600 text-xs mt-3 leading-relaxed">Oversees all financial operations, budgeting, accounting, and ensures compliance with financial regulations and reporting standards.</p>
                <div class="flex justify-center gap-2 mt-4">
                    <a href="#" class="w-8 h-8 border border-zinc-700 flex items-center justify-center text-gray-500 hover:border-white hover:text-white transition-colors"><svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></a>
                    <a href="#" class="w-8 h-8 border border-zinc-700 flex items-center justify-center text-gray-500 hover:border-white hover:text-white transition-colors"><svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg></a>
                    <a href="#" class="w-8 h-8 border border-zinc-700 flex items-center justify-center text-gray-500 hover:border-white hover:text-white transition-colors"><svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg></a>
                </div>
            </div>
            <div class="border border-zinc-800 p-6 text-center hover:border-zinc-600 transition-colors">
                <div class="w-28 h-28 rounded-full border-2 border-zinc-600 mx-auto mb-4 flex items-center justify-center text-gray-400 text-lg">LA</div>
                <h4 class="text-white font-semibold">Loan Administrator</h4>
                <div class="text-gray-500 text-sm mt-1">Loan Administrator</div>
                <p class="text-gray-600 text-xs mt-3 leading-relaxed">Manages the loan application process, credit assessment, and ensures timely disbursement and recovery of loans.</p>
                <div class="flex justify-center gap-2 mt-4">
                    <a href="#" class="w-8 h-8 border border-zinc-700 flex items-center justify-center text-gray-500 hover:border-white hover:text-white transition-colors"><svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></a>
                    <a href="#" class="w-8 h-8 border border-zinc-700 flex items-center justify-center text-gray-500 hover:border-white hover:text-white transition-colors"><svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg></a>
                    <a href="#" class="w-8 h-8 border border-zinc-700 flex items-center justify-center text-gray-500 hover:border-white hover:text-white transition-colors"><svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg></a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
