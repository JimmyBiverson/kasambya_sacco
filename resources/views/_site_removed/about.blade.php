@extends('layouts.app')

@section('title', 'About Us')
@section('meta_description', 'Learn about Kasambya SACCO — our mission, vision, values, and community impact.')

@section('content')

<section class="relative overflow-hidden bg-gradient-to-r from-emerald-700 to-emerald-500 text-white">
    <div class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_top,_rgba(255,255,255,0.22),_transparent_60%)]"></div>
    <div class="relative max-w-7xl mx-auto px-4 py-24 grid lg:grid-cols-2 gap-12 items-center">
        <div class="space-y-6">
            <p class="text-sm uppercase tracking-[0.32em] text-emerald-200">About Kasambya SACCO</p>
            <h1 class="text-5xl md:text-6xl font-extrabold">A cooperative rooted in community, savings and trust.</h1>
            <p class="max-w-2xl text-lg text-emerald-100 leading-relaxed">Kasambya SACCO is a member-owned financial cooperative dedicated to empowering our community through accessible and affordable financial services. Since our founding, we have grown into a trusted institution serving members across Kasambya and neighboring districts.</p>
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="{{ route('services') }}" class="btn-primary">Our Services</a>
                <a href="{{ route('contact') }}" class="inline-flex items-center justify-center border border-white/30 text-white hover:border-white hover:bg-white/10 rounded-full px-6 py-3 transition">Contact Us</a>
            </div>
        </div>
        <div class="grid gap-5 sm:grid-cols-2">
            <div class="rounded-[2rem] overflow-hidden shadow-2xl bg-white">
                <img src="{{ asset('images/office.jpg') }}" alt="Kasambya SACCO office" class="w-full h-full object-cover">
            </div>
            <div class="rounded-[2rem] overflow-hidden shadow-2xl bg-white">
                <img src="{{ asset('images/team.jpg') }}" alt="Kasambya SACCO team" class="w-full h-full object-cover">
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid gap-10 lg:grid-cols-3">
            <div class="rounded-3xl bg-white p-10 shadow-sm border border-slate-200">
                <h2 class="text-xl font-semibold text-emerald-700">Our Vision</h2>
                <p class="mt-4 text-slate-600">To provide affordable and sustainable financial services that uplift our members and their communities.</p>
            </div>
            <div class="rounded-3xl bg-white p-10 shadow-sm border border-slate-200">
                <h2 class="text-xl font-semibold text-emerald-700">Our Mission</h2>
                <p class="mt-4 text-slate-600">To build a strong spirit of saving, mobilize savings for productive investment, and promote financial literacy.</p>
            </div>
            <div class="rounded-3xl bg-white p-10 shadow-sm border border-slate-200">
                <h2 class="text-xl font-semibold text-emerald-700">Our Values</h2>
                <p class="mt-4 text-slate-600">We are guided by integrity, transparency, accountability and innovation.</p>
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <p class="text-sm uppercase tracking-[0.32em] text-emerald-600">What sets us apart</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold text-slate-900">Built for members, powered by trust.</h2>
        </div>
        <div class="grid gap-6 md:grid-cols-3">
            <div class="rounded-3xl bg-emerald-50 p-8 shadow-sm border border-emerald-100">
                <h3 class="text-lg font-semibold text-emerald-700">Community First</h3>
                <p class="mt-3 text-slate-600">We focus on member needs and community impact, not profit alone.</p>
            </div>
            <div class="rounded-3xl bg-emerald-50 p-8 shadow-sm border border-emerald-100">
                <h3 class="text-lg font-semibold text-emerald-700">Transparent Terms</h3>
                <p class="mt-3 text-slate-600">Clear loan conditions and honest service every step of the way.</p>
            </div>
            <div class="rounded-3xl bg-emerald-50 p-8 shadow-sm border border-emerald-100">
                <h3 class="text-lg font-semibold text-emerald-700">Member Support</h3>
                <p class="mt-3 text-slate-600">Friendly guidance and fast resolution for all member inquiries.</p>
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4 text-center">
            <div class="rounded-3xl bg-white p-8 shadow-sm border border-slate-200">
                <div class="text-4xl font-bold text-emerald-700">25+</div>
                <p class="mt-3 text-slate-600">Districts Served</p>
            </div>
            <div class="rounded-3xl bg-white p-8 shadow-sm border border-slate-200">
                <div class="text-4xl font-bold text-emerald-700">21+</div>
                <p class="mt-3 text-slate-600">Years of Experience</p>
            </div>
            <div class="rounded-3xl bg-white p-8 shadow-sm border border-slate-200">
                <div class="text-4xl font-bold text-emerald-700">10K</div>
                <p class="mt-3 text-slate-600">Satisfied Members</p>
            </div>
            <div class="rounded-3xl bg-white p-8 shadow-sm border border-slate-200">
                <div class="text-4xl font-bold text-emerald-700">50+</div>
                <p class="mt-3 text-slate-600">Professional Staff</p>
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-white text-center">
    <div class="max-w-3xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-slate-900">Ready to build your savings with us?</h2>
        <p class="mt-4 text-lg text-slate-600">Contact our team today to learn more about joining Kasambya SACCO.</p>
        <a href="{{ route('contact') }}" class="btn-primary mt-8 inline-block">Contact Us</a>
    </div>
</section>

@endsection
<section class="py-20 border-t border-zinc-900 bg-black">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-white">Our Vision, Mission & Values</h2>
            <p class="text-gray-500 mt-4 text-lg max-w-2xl mx-auto">Guided by our core principles, we strive to deliver exceptional financial services to our members.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="border border-zinc-800 p-8 hover:border-zinc-600 transition-colors">
                <div class="text-white mb-4">
                    <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M2 12h4l3-9 3 18 3-9h4"/>
                    </svg>
                </div>
                <h3 class="text-white font-semibold text-lg mb-3">Our Vision</h3>
                <p class="text-gray-500 text-sm leading-relaxed">To be the leading member-owned financial cooperative that transforms lives and builds sustainable communities by providing accessible, affordable, and innovative financial services.</p>
            </div>
            <div class="border border-zinc-800 p-8 hover:border-zinc-600 transition-colors">
                <div class="text-white mb-4">
                    <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>
                    </svg>
                </div>
                <h3 class="text-white font-semibold text-lg mb-3">Our Mission</h3>
                <p class="text-gray-500 text-sm leading-relaxed">To develop a strong spirit of saving among our members, mobilize savings for productive investment, provide affordable credit, and promote financial literacy for sustainable socio-economic development.</p>
            </div>
            <div class="border border-zinc-800 p-8 hover:border-zinc-600 transition-colors">
                <div class="text-white mb-4">
                    <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                    </svg>
                </div>
                <h3 class="text-white font-semibold text-lg mb-3">Core Values</h3>
                <ul class="space-y-2 text-sm text-gray-500">
                    <li class="flex items-baseline gap-2"><span class="text-white">-</span> Integrity &ndash; Upholding honesty in all operations</li>
                    <li class="flex items-baseline gap-2"><span class="text-white">-</span> Transparency &ndash; Open communication with members</li>
                    <li class="flex items-baseline gap-2"><span class="text-white">-</span> Member Focus &ndash; Prioritizing member needs</li>
                    <li class="flex items-baseline gap-2"><span class="text-white">-</span> Accountability &ndash; Responsible management of resources</li>
                    <li class="flex items-baseline gap-2"><span class="text-white">-</span> Innovation &ndash; Embracing modern financial solutions</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="py-20 border-t border-zinc-900 bg-black">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-white">Our Impact in Numbers</h2>
            <p class="text-gray-500 mt-4 text-lg">Kasambya SACCO by the numbers</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="text-4xl md:text-5xl font-bold text-white mb-2">50+</div>
                <div class="text-gray-500">Professional Staff</div>
            </div>
            <div class="text-center">
                <div class="text-4xl md:text-5xl font-bold text-white mb-2">25+</div>
                <div class="text-gray-500">Districts Served</div>
            </div>
            <div class="text-center">
                <div class="text-4xl md:text-5xl font-bold text-white mb-2">21+</div>
                <div class="text-gray-500">Years of Experience</div>
            </div>
            <div class="text-center">
                <div class="text-4xl md:text-5xl font-bold text-white mb-2">10K</div>
                <div class="text-gray-500">Satisfied Customers</div>
            </div>
        </div>
    </div>
</section>

<section class="py-20 border-t border-zinc-900 bg-black">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-white">Management Staff</h2>
            <p class="text-gray-500 mt-4 text-lg">Meet our dedicated team of professionals committed to serving you.</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
            <div class="border border-zinc-800 p-6 text-center hover:border-zinc-600 transition-colors">
                <div class="w-24 h-24 rounded-full border-2 border-zinc-600 mx-auto mb-4 flex items-center justify-center text-gray-400 text-sm">BB</div>
                <h4 class="text-white font-semibold">Byamukama Bernard</h4>
                <div class="text-gray-500 text-sm mt-1">SACCO Manager</div>
                <p class="text-gray-600 text-xs mt-3 leading-relaxed">Providing strategic leadership and oversight for all SACCO operations.</p>
                <div class="flex justify-center gap-2 mt-4">
                    <a href="#" class="w-8 h-8 border border-zinc-700 flex items-center justify-center text-gray-500 hover:border-white hover:text-white transition-colors">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="#" class="w-8 h-8 border border-zinc-700 flex items-center justify-center text-gray-500 hover:border-white hover:text-white transition-colors">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                    </a>
                    <a href="#" class="w-8 h-8 border border-zinc-700 flex items-center justify-center text-gray-500 hover:border-white hover:text-white transition-colors">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                </div>
            </div>
            <div class="border border-zinc-800 p-6 text-center hover:border-zinc-600 transition-colors">
                <div class="w-24 h-24 rounded-full border-2 border-zinc-600 mx-auto mb-4 flex items-center justify-center text-gray-400 text-sm">AC</div>
                <h4 class="text-white font-semibold">Ampeire Charity</h4>
                <div class="text-gray-500 text-sm mt-1">Accountant/Finance Officer</div>
                <p class="text-gray-600 text-xs mt-3 leading-relaxed">Managing the financial records, budgeting, and ensuring financial compliance.</p>
                <div class="flex justify-center gap-2 mt-4">
                    <a href="#" class="w-8 h-8 border border-zinc-700 flex items-center justify-center text-gray-500 hover:border-white hover:text-white transition-colors">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="#" class="w-8 h-8 border border-zinc-700 flex items-center justify-center text-gray-500 hover:border-white hover:text-white transition-colors">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                    </a>
                    <a href="#" class="w-8 h-8 border border-zinc-700 flex items-center justify-center text-gray-500 hover:border-white hover:text-white transition-colors">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                </div>
            </div>
            <div class="border border-zinc-800 p-6 text-center hover:border-zinc-600 transition-colors">
                <div class="w-24 h-24 rounded-full border-2 border-zinc-600 mx-auto mb-4 flex items-center justify-center text-gray-400 text-sm">SE</div>
                <h4 class="text-white font-semibold">Ssebayima Edwine</h4>
                <div class="text-gray-500 text-sm mt-1">Credit Supervisor</div>
                <p class="text-gray-600 text-xs mt-3 leading-relaxed">Overseeing credit assessment, loan disbursement, and recovery processes.</p>
                <div class="flex justify-center gap-2 mt-4">
                    <a href="#" class="w-8 h-8 border border-zinc-700 flex items-center justify-center text-gray-500 hover:border-white hover:text-white transition-colors"><svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></a>
                    <a href="#" class="w-8 h-8 border border-zinc-700 flex items-center justify-center text-gray-500 hover:border-white hover:text-white transition-colors"><svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg></a>
                    <a href="#" class="w-8 h-8 border border-zinc-700 flex items-center justify-center text-gray-500 hover:border-white hover:text-white transition-colors"><svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg></a>
                </div>
            </div>
            <div class="border border-zinc-800 p-6 text-center hover:border-zinc-600 transition-colors">
                <div class="w-24 h-24 rounded-full border-2 border-zinc-600 mx-auto mb-4 flex items-center justify-center text-gray-400 text-sm">NR</div>
                <h4 class="text-white font-semibold">Nyakato Rose</h4>
                <div class="text-gray-500 text-sm mt-1">ICT Officer</div>
                <p class="text-gray-600 text-xs mt-3 leading-relaxed">Managing technology infrastructure, M-SACCO platform, and digital services.</p>
                <div class="flex justify-center gap-2 mt-4">
                    <a href="#" class="w-8 h-8 border border-zinc-700 flex items-center justify-center text-gray-500 hover:border-white hover:text-white transition-colors"><svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></a>
                    <a href="#" class="w-8 h-8 border border-zinc-700 flex items-center justify-center text-gray-500 hover:border-white hover:text-white transition-colors"><svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg></a>
                    <a href="#" class="w-8 h-8 border border-zinc-700 flex items-center justify-center text-gray-500 hover:border-white hover:text-white transition-colors"><svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg></a>
                </div>
            </div>
            <div class="border border-zinc-800 p-6 text-center hover:border-zinc-600 transition-colors">
                <div class="w-24 h-24 rounded-full border-2 border-zinc-600 mx-auto mb-4 flex items-center justify-center text-gray-400 text-sm">KR</div>
                <h4 class="text-white font-semibold">Kizito Richard</h4>
                <div class="text-gray-500 text-sm mt-1">Loan Officer</div>
                <p class="text-gray-600 text-xs mt-3 leading-relaxed">Assisting members with loan applications, inquiries, and repayment plans.</p>
                <div class="flex justify-center gap-2 mt-4">
                    <a href="#" class="w-8 h-8 border border-zinc-700 flex items-center justify-center text-gray-500 hover:border-white hover:text-white transition-colors"><svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></a>
                    <a href="#" class="w-8 h-8 border border-zinc-700 flex items-center justify-center text-gray-500 hover:border-white hover:text-white transition-colors"><svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg></a>
                    <a href="#" class="w-8 h-8 border border-zinc-700 flex items-center justify-center text-gray-500 hover:border-white hover:text-white transition-colors"><svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg></a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-20 border-t border-zinc-900 bg-black">
    <div class="max-w-3xl mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Join us today to start your journey to financial growth</h2>
        <p class="text-gray-500 text-lg mb-8">Become a member and access affordable loans, secure savings, and a community that cares about your financial well-being.</p>
        <a href="{{ route('contact') }}" class="btn-primary text-base px-10 py-3">Let's get in touch</a>
    </div>
</section>

@endsection
