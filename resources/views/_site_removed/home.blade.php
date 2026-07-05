@extends('layouts.app')

@section('title', 'Home')
@section('meta_description', 'Kasambya SACCO - Safe Savings & Affordable Loans')

@section('content')
<!-- Hero -->
<section class="relative overflow-hidden bg-gradient-to-r from-emerald-600/80 to-emerald-500/60 text-white">
    <div class="max-w-7xl mx-auto px-4 py-28 grid lg:grid-cols-2 gap-8 items-center">
        <div class="space-y-6">
            <h1 class="text-4xl lg:text-5xl font-extrabold leading-tight">Safe Savings & Affordable Loans</h1>
            <p class="text-lg max-w-2xl">Join Kasambya SACCO for trusted savings, low-interest loans, and community-focused financial services across Kasambya and surrounding districts.</p>
            <div class="flex items-center gap-3">
                <a href="{{ route('application') }}" class="btn-primary">Become Member</a>
                <a href="{{ route('services') }}" class="text-white underline">View Saving Products</a>
            </div>
        </div>

        <div class="hidden lg:block">
            <img src="https://kasambyasacco.com/wp-content/uploads/2026/03/group-photo.png" alt="Group" class="rounded-2xl shadow-xl mx-auto w-[520px] animate-fade-in">
        </div>
    </div>
</section>

<!-- Why choose us -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-2xl font-bold text-emerald-700">Why Choose Us</h2>
        <p class="text-slate-600 mt-2 max-w-2xl">We are more than just a SACCO—we are a trusted partner committed to your financial growth and success.</p>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-8">
            <div class="p-6 bg-emerald-50 rounded-2xl shadow-sm hover:shadow-md transition-shadow">
                <h3 class="font-semibold text-emerald-700">We act with Integrity</h3>
                <p class="text-sm text-slate-600 mt-2">You can rely on us to handle your finances with honesty and strong ethical standards.</p>
            </div>
            <div class="p-6 bg-emerald-50 rounded-2xl shadow-sm hover:shadow-md transition-shadow">
                <h3 class="font-semibold text-emerald-700">We practice Transparency</h3>
                <p class="text-sm text-slate-600 mt-2">Every transaction and decision is open and accountable.</p>
            </div>
            <div class="p-6 bg-emerald-50 rounded-2xl shadow-sm hover:shadow-md transition-shadow">
                <h3 class="font-semibold text-emerald-700">We value Your Time</h3>
                <p class="text-sm text-slate-600 mt-2">Fast approvals and efficient service for members.</p>
            </div>
            <div class="p-6 bg-emerald-50 rounded-2xl shadow-sm hover:shadow-md transition-shadow">
                <h3 class="font-semibold text-emerald-700">Customer Care</h3>
                <p class="text-sm text-slate-600 mt-2">We prioritize the needs and satisfaction of our members.</p>
            </div>
        </div>
    </div>
</section>

<!-- Products grid -->
<section class="py-16 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-2xl font-bold text-emerald-700">Our Key Saving Products</h2>
        <p class="text-slate-600 mt-2">A variety of savings and account services designed to meet different needs.</p>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-8">
            <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition-all">
                <h4 class="font-semibold">Voluntary Savings</h4>
                <p class="text-sm text-slate-600 mt-2">Save flexibly and withdraw when needed.</p>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition-all">
                <h4 class="font-semibold">Fixed Savings</h4>
                <p class="text-sm text-slate-600 mt-2">Deposit for a fixed term to gain higher returns.</p>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition-all">
                <h4 class="font-semibold">Minor Account</h4>
                <p class="text-sm text-slate-600 mt-2">Accounts for children managed by a parent.</p>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition-all">
                <h4 class="font-semibold">Share Savings</h4>
                <p class="text-sm text-slate-600 mt-2">Members contribute share capital representing ownership.</p>
            </div>
        </div>
    </div>
</section>

<!-- Membership CTA -->
<section class="py-16 bg-emerald-600 text-white">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h3 class="text-2xl font-bold">Become a Member</h3>
        <p class="mt-2 max-w-2xl mx-auto">Join now to access low-interest loans, savings products, and member benefits.</p>
        <div class="mt-6">
            <a href="{{ route('application') }}" class="btn-primary">Apply Now</a>
        </div>
    </div>
</section>

<!-- News preview -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-2xl font-bold text-emerald-700">News & Events</h2>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
            @foreach(
                \App\Models\NewsEvent::where('is_published', true)->orderByDesc('published_at')->limit(3)->get()
                as $news)
                <article class="bg-slate-50 rounded-2xl p-4 shadow-sm hover:shadow-md transition-all">
                    <h4 class="font-semibold"><a href="{{ route('news.show', $news->slug) }}">{{ $news->title }}</a></h4>
                    <p class="text-sm text-slate-600 mt-2">{{ \Illuminate\Support\Str::limit(strip_tags($news->content ?? $news->excerpt ?? ''), 120) }}</p>
                    <div class="mt-3 text-xs text-gray-500">{{ $news->published_at?->format('M d, Y') }}</div>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="relative h-screen flex items-center justify-center overflow-hidden">
    <div class="waves"></div>
    <div class="relative z-10 text-center px-4 max-w-4xl mx-auto">
        <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 leading-tight">Safe Savings & Affordable Loans</h1>
                <p class="text-lg md:text-xl text-gray-400 mb-10 max-w-2xl mx-auto">We provide secure savings options and low-interest loans to help you achieve your financial goals.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('services') }}" class="btn-primary text-base px-8 py-3">View Saving Products</a>
            <a href="{{ route('application') }}" class="inline-block border border-white text-white font-semibold py-3 px-8 text-base hover:bg-white hover:text-black transition-all duration-200">Become a Member</a>
        </div>
    </div>
</section>

<!-- Vision / Mission / Values -->
<section class="py-20 bg-black">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-white">Who We Are</h2>
            <p class="text-gray-500 mt-4 text-lg max-w-2xl mx-auto">Kasambya SACCO is a member-owned financial cooperative dedicated to empowering our community.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="border border-zinc-800 p-8 hover:border-zinc-600 transition-colors">
                <div class="text-white mb-4">
                    <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M2 12h4l3-9 3 18 3-9h4"/>
                    </svg>
                </div>
                <h3 class="text-white font-semibold text-lg mb-3">Our Vision</h3>
                <p class="text-gray-500 text-sm leading-relaxed">To provide affordable and sustainable financial services to our members.</p>
                <a href="{{ route('about') }}" class="text-gray-400 hover:text-white text-sm font-medium mt-4 inline-block">Read More</a>
            </div>
            <div class="border border-zinc-800 p-8 hover:border-zinc-600 transition-colors">
                <div class="text-white mb-4">
                    <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>
                    </svg>
                </div>
                <h3 class="text-white font-semibold text-lg mb-3">Our Mission</h3>
                <p class="text-gray-500 text-sm leading-relaxed">To develop a strong spirit of saving among our members.</p>
                <a href="{{ route('about') }}" class="text-gray-400 hover:text-white text-sm font-medium mt-4 inline-block">Read More</a>
            </div>
            <div class="border border-zinc-800 p-8 hover:border-zinc-600 transition-colors">
                <div class="text-white mb-4">
                    <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                    </svg>
                </div>
                <h3 class="text-white font-semibold text-lg mb-3">Core Values</h3>
                <p class="text-gray-500 text-sm leading-relaxed">We uphold honesty and ethical conduct in all our operations.</p>
                <a href="{{ route('about') }}" class="text-gray-400 hover:text-white text-sm font-medium mt-4 inline-block">Read More</a>
            </div>
            <div class="border border-zinc-800 p-8 hover:border-zinc-600 transition-colors">
                <div class="text-white mb-4">
                    <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                    </svg>
                </div>
                <h3 class="text-white font-semibold text-lg mb-3">Customer Care</h3>
                <p class="text-gray-500 text-sm leading-relaxed">We prioritize the needs and satisfaction of our members.</p>
                <a href="{{ route('about') }}" class="text-gray-400 hover:text-white text-sm font-medium mt-4 inline-block">Read More</a>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="py-20 border-t border-zinc-900 bg-black">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-white">Why Choose Us</h2>
            <p class="text-gray-500 mt-4 text-lg max-w-2xl mx-auto">We are committed to providing the highest quality financial services to our members.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="border border-zinc-800 p-8 hover:border-zinc-600 transition-colors">
                <div class="text-white mb-4">
                    <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                    </svg>
                </div>
                <h3 class="text-white font-semibold text-lg mb-3">We act with Integrity</h3>
                <p class="text-gray-500 text-sm leading-relaxed">We maintain the highest standards of honesty and ethical behavior in all our dealings with members and stakeholders.</p>
            </div>
            <div class="border border-zinc-800 p-8 hover:border-zinc-600 transition-colors">
                <div class="text-white mb-4">
                    <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M21 12a9 9 0 0 1-9 9m9-9a9 9 0 0 0-9-9m9 9H3m9 9a9 9 0 0 1-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 0 1 9-9"/>
                    </svg>
                </div>
                <h3 class="text-white font-semibold text-lg mb-3">We practice Transparency</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Our operations are open and transparent. Members have full visibility into how their funds are managed.</p>
            </div>
            <div class="border border-zinc-800 p-8 hover:border-zinc-600 transition-colors">
                <div class="text-white mb-4">
                    <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                    </svg>
                </div>
                <h3 class="text-white font-semibold text-lg mb-3">We value Your Time</h3>
                <p class="text-gray-500 text-sm leading-relaxed">We have streamlined our processes to ensure quick service delivery and minimal waiting times for our members.</p>
            </div>
        </div>
    </div>
</section>

<!-- Stats -->
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

<!-- Key Saving Products -->
<section class="py-20 border-t border-zinc-900 bg-black">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-white">Key Saving Products</h2>
            <p class="text-gray-500 mt-4 text-lg max-w-2xl mx-auto">Explore our range of saving products designed to meet your unique financial needs.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($services as $service)
                <div class="border border-zinc-800 p-6 hover:border-zinc-600 transition-colors">
                    @if($service->icon)
                        <div class="text-white mb-4">{!! $service->icon !!}</div>
                    @else
                        <div class="text-white mb-4">
                            <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="23"/><line x1="8" y1="23" x2="16" y2="23"/>
                            </svg>
                        </div>
                    @endif
                    <h3 class="text-white font-semibold text-base mb-2">{{ $service->title }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-4">{{ Str::limit($service->description, 80) }}</p>
                    <a href="{{ $service->slug ? url('/services#' . $service->slug) : url('/services') }}" class="text-gray-400 hover:text-white text-sm font-medium">Learn More</a>
                </div>
            @empty
                <div class="col-span-full text-center py-10">
                    <p class="text-gray-500">No services available at the moment. Please check back later.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- M-SACCO -->
<section class="py-20 border-t border-zinc-900 bg-black">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">M-SACCO: Banking at Your Fingertips</h2>
                <p class="text-gray-500 text-lg leading-relaxed mb-8">Access your Kasambya SACCO account anytime, anywhere using your mobile phone. Our M-SACCO platform brings banking convenience directly to you.</p>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-gray-400 mt-0.5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                        <div><strong class="text-white">Convenience</strong> <span class="text-gray-500">&mdash; Access your account 24/7 from anywhere in Uganda.</span></div>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-gray-400 mt-0.5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        <div><strong class="text-white">Time Saving</strong> <span class="text-gray-500">&mdash; No more waiting in lines. Transact instantly.</span></div>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-gray-400 mt-0.5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        <div><strong class="text-white">Improved Financial Management</strong> <span class="text-gray-500">&mdash; Track your savings and transactions in real time.</span></div>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-gray-400 mt-0.5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        <div><strong class="text-white">Enhanced Security</strong> <span class="text-gray-500">&mdash; Your transactions and data are protected with industry-standard security.</span></div>
                    </li>
                </ul>
            </div>
            <div class="border border-zinc-800 p-8 text-center">
                <div class="text-2xl font-bold text-white mb-4">M-SACCO</div>
                <div class="border border-zinc-700 p-6">
                    <div class="text-lg text-gray-400">Mobile Banking</div>
                    <div class="text-sm text-gray-600 mt-2">Kasambya SACCO</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Latest News -->
<section class="py-20 border-t border-zinc-900 bg-black">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-white">Latest News</h2>
            <p class="text-gray-500 mt-4 text-lg max-w-2xl mx-auto">Stay updated with the latest news and announcements from Kasambya SACCO.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($latestNews as $news)
                <a href="{{ route('news.show', $news->slug) }}" class="border border-zinc-800 hover:border-zinc-600 transition-colors block">
                    <div class="p-6">
                        @if($news->category)<span class="text-xs text-gray-500 uppercase tracking-wider">{{ $news->category }}</span>@endif
                        <div class="text-xs text-gray-600 mt-1">{{ $news->published_at ? $news->published_at->format('F d, Y') : $news->created_at->format('F d, Y') }}</div>
                        <h3 class="text-white font-semibold text-base mt-3 mb-2">{{ $news->title }}</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">{{ Str::limit($news->excerpt ?? strip_tags($news->content), 120) }}</p>
                        <div class="text-gray-400 text-sm font-medium mt-4">{{ $news->author ?? 'Kasambya SACCO' }}</div>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center py-10">
                    <p class="text-gray-500">No news articles yet. Check back soon!</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="py-20 border-t border-zinc-900 bg-black">
    <div class="max-w-3xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-white">Frequently Asked Questions</h2>
            <p class="text-gray-500 mt-4 text-lg">Find answers to common questions about Kasambya SACCO and our services.</p>
        </div>
        <div class="space-y-3">
            @forelse($faqs as $faq)
                <div class="border border-zinc-800" x-data="{ open: false }">
                    <button @click="open = !open" class="w-full flex items-center justify-between px-6 py-4 text-left text-white hover:text-gray-300 transition-colors">
                        <span class="font-medium">{{ $faq->question }}</span>
                        <svg :class="{'rotate-180': open}" class="w-4 h-4 text-gray-500 transition-transform flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div x-show="open" class="px-6 pb-4">
                        <p class="text-gray-500 text-sm leading-relaxed">{{ $faq->answer }}</p>
                    </div>
                </div>
            @empty
                <div class="border border-zinc-800 px-6 py-4">
                    <p class="text-gray-500">No FAQs available at the moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Partners -->
<section class="py-16 border-t border-zinc-900 bg-black">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-white">Our Partners</h2>
            <p class="text-gray-500 mt-4 text-lg">We are proud to collaborate with these trusted organizations.</p>
        </div>
        <div class="overflow-hidden">
            <div class="flex gap-8 animate-scroll" style="animation: scroll 20s linear infinite;">
                @forelse($partners->merge($partners) as $partner)
                    <div class="flex-shrink-0 border border-zinc-800 px-8 py-4 text-gray-500 text-sm">{{ $partner->name }}</div>
                @empty
                    <div class="flex-shrink-0 border border-zinc-800 px-8 py-4 text-gray-500 text-sm">Partner 1</div>
                    <div class="flex-shrink-0 border border-zinc-800 px-8 py-4 text-gray-500 text-sm">Partner 2</div>
                    <div class="flex-shrink-0 border border-zinc-800 px-8 py-4 text-gray-500 text-sm">Partner 3</div>
                    <div class="flex-shrink-0 border border-zinc-800 px-8 py-4 text-gray-500 text-sm">Partner 4</div>
                    <div class="flex-shrink-0 border border-zinc-800 px-8 py-4 text-gray-500 text-sm">Partner 5</div>
                @endforelse
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-20 bg-black">
    <div class="max-w-3xl mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Ready to Join Kasambya SACCO?</h2>
        <p class="text-gray-500 text-lg mb-8">Start your journey towards financial freedom today.</p>
        <a href="tel:{{ $settings->get('org_phone')->value ?? '+256 0775 125 122' }}" class="text-gray-400 text-xl block mb-8 hover:text-white transition-colors">{{ $settings->get('org_phone')->value ?? '+256 0775 125 122' }}</a>
        <a href="{{ route('application') }}" class="btn-primary text-base px-10 py-3">Become a Member</a>
    </div>
</section>

<style>
@keyframes scroll {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}
</style>
@endsection
