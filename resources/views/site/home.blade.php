@extends('layouts.site')

@section('title', 'Home')
@section('meta_description', 'Kasambya SACCO - Safe Savings & Affordable Loans. Join a trusted SACCO that empowers you with low-interest loans, secure savings, and financial growth.')

@section('content')

<!-- Hero Slider with Ken Burns Effect -->
@php
    $heroImages = [
        asset('images/slides/slide-1.jpg'),
        asset('images/slides/slide-2.jpg'),
        asset('images/slides/slide-3.jpg'),
        asset('images/slides/slide-4.jpg'),
        asset('images/slides/slide-5.jpg'),
    ];
@endphp

<section class="relative bg-green-900 text-white overflow-hidden" x-data="{
    current: 0,
    interval: null,
    slides: {{ json_encode($slides->map(fn($s, $idx) => [
        'image'   => $s->image_path ? asset('storage/' . $s->image_path) : ($heroImages[$idx] ?? $heroImages[0]),
        'title'   => $s->title ?? 'Safe Savings & Affordable Loans',
        'subtitle' => $s->subtitle ?? ($settings_values['hero_copy'] ?? 'Join a trusted SACCO that empowers you with low-interest loans, secure savings, and financial growth.'),
        'cta_text' => $s->cta_text ?? 'Become Member',
        'cta_url'  => $s->cta_url ?? route('application'),
        'origin'   => $idx % 3 === 0 ? '45% 55%' : ($idx % 3 === 1 ? '60% 40%' : '35% 50%'),
        'animClass' => 'ken-burns-' . ($idx % 3),
    ])->values()) }},
    goTo(i) {
        this.current = i;
        clearInterval(this.interval);
        this.interval = setInterval(() => {
            this.current = (this.current + 1) % this.slides.length;
        }, 7000);
    }
}" x-init="if (slides.length) { interval = setInterval(() => { current = (current + 1) % slides.length }, 7000) }">

    <!-- Dark overlay for readability -->
    <div class="absolute inset-0 bg-black/45 z-10"></div>

    <!-- Ken Burns image layer with crossfade -->
    <template x-for="(slide, i) in slides" :key="'img-' + i">
        <div class="absolute inset-0 z-0 overflow-hidden bg-gradient-to-br from-green-800 via-green-900 to-slate-900"
             :style="{ opacity: current === i ? 1 : 0, transition: 'opacity 1s ease-in-out' }">
            <img :src="slide.image" :alt="slide.title"
                 :class="'w-full h-full object-cover ' + slide.animClass"
                 :style="'transform-origin: ' + slide.origin + '; min-height: 520px;'"
                 @@error="$el.style.display='none'">
        </div>
    </template>

    <!-- Gradient overlay for depth -->
    <div class="absolute inset-0 z-[5] bg-gradient-to-r from-green-950/80 via-green-900/50 to-transparent"></div>
    <div class="absolute inset-0 z-[6] bg-gradient-to-t from-green-950/40 via-transparent to-transparent"></div>

    <!-- Content -->
    <div class="relative z-20 max-w-7xl mx-auto px-4 py-28 md:py-36 lg:py-44">

        <div class="grid grid-cols-1 grid-rows-1">
            <template x-for="(slide, i) in slides" :key="'content-' + i">
                 <div x-show="current === i" x-cloak
                      class="col-start-1 row-start-1 max-w-2xl bg-black/40 backdrop-blur-md p-8 md:p-12 rounded-3xl shadow-2xl relative overflow-hidden"
                      x-transition:enter="transition ease-out duration-1000"
                      x-transition:enter-start="opacity-0 translate-y-8 scale-95"
                      x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                      x-transition:leave="transition ease-in duration-500 absolute inset-0"
                      x-transition:leave-start="opacity-100 scale-100"
                      x-transition:leave-end="opacity-0 scale-95">
                    <div>
                        <p class="hero-content-fade text-sm uppercase tracking-[0.25em] text-emerald-450 font-bold mb-6">{{ $orgName }}</p>
                        <h1 class="hero-content-fade-delayed text-4xl md:text-6xl lg:text-7xl font-extrabold leading-[1.15] mb-6 text-white text-glow" x-text="slide.title"></h1>
                        <p class="hero-content-fade-delayed text-lg md:text-xl text-emerald-50 mb-10 max-w-xl leading-relaxed opacity-90" x-text="slide.subtitle"></p>
                        <div class="hero-content-fade-btn flex flex-wrap items-center gap-4">
                            <a :href="slide.cta_url" class="inline-block bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-8 py-3.5 text-base rounded-xl hover:shadow-2xl hover:scale-105 transition-all duration-300" x-text="slide.cta_text || 'Become Member'">Become Member</a>
                            <a href="{{ route('services') }}" class="inline-block border border-white/30 bg-white/5 hover:bg-white/10 text-white font-semibold px-8 py-3.5 text-base rounded-xl hover:scale-105 transition-all duration-300 backdrop-blur-sm">View Saving Products</a>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <!-- Navigation Dots -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-30 flex items-center gap-3" x-show="slides.length > 1">
            <template x-for="(slide, i) in slides" :key="'dot-' + i">
                <button @click="goTo(i)"
                        :class="{ 'bg-white w-10': current === i, 'bg-white/40 w-3 hover:bg-white/70': current !== i }"
                        class="h-3 rounded-full transition-all duration-500 cursor-pointer"
                        :aria-label="'Go to slide ' + (i + 1)">
                </button>
            </template>
        </div>

        <!-- Slide counter -->
        <div class="absolute bottom-8 right-8 z-30 text-sm text-white/60 font-mono tracking-wider" x-show="slides.length > 0">
            <span x-text="'0' + (current + 1)"></span>
            <span class="mx-2">/</span>
            <span x-text="'0' + slides.length"></span>
        </div>
    </div>
</section>

<!-- Vision / Mission / Core Values / Customer Care -->
<section class="py-16 bg-white" data-aos="fade-up">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="border border-gray-200 p-6 hover:border-green-500 transition-colors" data-aos="fade-up" data-aos-delay="0">
                <div class="w-12 h-12 bg-green-100 flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">Our Vision</h3>
                <p class="text-gray-600 text-sm leading-relaxed">To provide affordable and sustainable financial services to our members.</p>
                <a href="{{ route('about') }}" class="text-green-600 text-sm font-medium mt-3 inline-block hover:text-green-700">Read More</a>
            </div>
            <div class="border border-gray-200 p-6 hover:border-green-500 transition-colors" data-aos="fade-up" data-aos-delay="100">
                <div class="w-12 h-12 bg-green-100 flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">Our Mission</h3>
                <p class="text-gray-600 text-sm leading-relaxed">To develop a strong spirit of saving among our members.</p>
                <a href="{{ route('about') }}" class="text-green-600 text-sm font-medium mt-3 inline-block hover:text-green-700">Read More</a>
            </div>
            <div class="border border-gray-200 p-6 hover:border-green-500 transition-colors" data-aos="fade-up" data-aos-delay="200">
                <div class="w-12 h-12 bg-green-100 flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">Core Values</h3>
                <p class="text-gray-600 text-sm leading-relaxed">We uphold honesty and ethical conduct in all our operations.</p>
                <a href="{{ route('about') }}" class="text-green-600 text-sm font-medium mt-3 inline-block hover:text-green-700">Read More</a>
            </div>
            <div class="border border-gray-200 p-6 hover:border-green-500 transition-colors" data-aos="fade-up" data-aos-delay="300">
                <div class="w-12 h-12 bg-green-100 flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">Customer Care</h3>
                <p class="text-gray-600 text-sm leading-relaxed">We prioritize the needs and satisfaction of our members.</p>
                <a href="{{ route('about') }}" class="text-green-600 text-sm font-medium mt-3 inline-block hover:text-green-700">Learn More</a>
            </div>
        </div>
    </div>
</section>

<!-- Storytelling / History (charity: water style) -->
<section class="py-24 bg-gradient-to-b from-white to-gray-50 relative overflow-hidden" data-aos="fade-up">
    <!-- Subtle background blobs -->
    <div class="absolute top-10 left-0 w-80 h-80 bg-green-200/20 rounded-full blur-3xl -z-10"></div>
    <div class="absolute bottom-10 right-0 w-96 h-96 bg-emerald-200/20 rounded-full blur-3xl -z-10"></div>

    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <p class="text-xs uppercase tracking-[0.25em] text-emerald-600 font-bold">Our Story</p>
            <h2 class="text-4xl md:text-5xl font-black text-slate-900 mt-3 leading-tight font-sans">Providing Financial Freedom <br class="hidden md:inline">For Over Two Decades</h2>
            <div class="w-20 h-1.5 bg-emerald-600 mx-auto mt-6 rounded-full"></div>
        </div>

        <div class="grid lg:grid-cols-12 gap-10 items-stretch">
            <!-- Story left side: Bold narrative statement -->
            <div class="lg:col-span-5 flex flex-col justify-between py-2" data-aos="fade-right">
                <div>
                    <h3 class="text-2xl md:text-3xl font-bold text-slate-800 leading-snug">
                        {{ $orgName }} was established in {{ $settings_values['org_established_year'] ?? '2003' }} with a single, clear objective: to empower communities to build their own financial futures.
                    </h3>
                    <p class="text-slate-650 mt-6 leading-relaxed">
                        Registered under Registration <strong>Number 6682</strong> by the Registrar of Cooperative Societies, we are a member-owned financial cooperative dedicated to providing affordable and sustainable financial services.
                    </p>
                    <p class="text-slate-650 mt-4 leading-relaxed">
                        With over 20 years of experience, we have grown to serve thousands of members across multiple districts, offering a range of savings and loan products designed to meet diverse financial needs.
                    </p>
                </div>
                <div class="mt-8 pt-8 border-t border-slate-200/60">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full overflow-hidden bg-slate-100 flex-shrink-0">
                            <!-- User initials -->
                            <div class="w-full h-full bg-emerald-100 text-emerald-850 font-extrabold flex items-center justify-center text-sm">KS</div>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-805">{{ $orgName }} Board</p>
                            <p class="text-xs text-slate-500 font-medium">Serving Since 2003</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Story right side: The Interactive Milestones Grid (Glassmorphism Cards) -->
            <div class="lg:col-span-7 grid md:grid-cols-2 gap-6" data-aos="fade-left">
                <!-- Milestone Card 1 -->
                <div class="glass-card p-8 rounded-3xl border border-white flex flex-col justify-between relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-emerald-500/5 rounded-bl-full flex items-center justify-center -z-10 group-hover:bg-emerald-500/10 transition-colors"></div>
                    <div>
                        <span class="text-xs font-semibold text-emerald-600 uppercase tracking-widest bg-emerald-50 px-2.5 py-1 rounded-full border border-emerald-100">Founding</span>
                        <h4 class="text-lg font-bold text-slate-800 mt-4 mb-2">Established 2003</h4>
                        <p class="text-slate-600 text-sm leading-relaxed">Founded by local community members to build a cooperative saving and credit support system.</p>
                    </div>
                    <span class="text-5xl font-black text-slate-150/70 font-mono mt-6 block text-right group-hover:text-emerald-500/10 transition-colors">01</span>
                </div>

                <!-- Milestone Card 2 -->
                <div class="glass-card p-8 rounded-3xl border border-white flex flex-col justify-between relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-emerald-500/5 rounded-bl-full flex items-center justify-center -z-10 group-hover:bg-emerald-500/10 transition-colors"></div>
                    <div>
                        <span class="text-xs font-semibold text-emerald-600 uppercase tracking-widest bg-emerald-50 px-2.5 py-1 rounded-full border border-emerald-100">Official</span>
                        <h4 class="text-lg font-bold text-slate-800 mt-4 mb-2">Registered 6682</h4>
                        <p class="text-slate-600 text-sm leading-relaxed">Fully registered under the Cooperative Societies Statute of 1991 to guarantee formal standards.</p>
                    </div>
                    <span class="text-5xl font-black text-slate-150/70 font-mono mt-6 block text-right group-hover:text-emerald-500/10 transition-colors">02</span>
                </div>

                <!-- Milestone Card 3 -->
                <div class="glass-card p-8 rounded-3xl border border-white flex flex-col justify-between relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-emerald-500/5 rounded-bl-full flex items-center justify-center -z-10 group-hover:bg-emerald-500/10 transition-colors"></div>
                    <div>
                        <span class="text-xs font-semibold text-emerald-600 uppercase tracking-widest bg-emerald-50 px-2.5 py-1 rounded-full border border-emerald-100">Expansion</span>
                        <h4 class="text-lg font-bold text-slate-800 mt-4 mb-2">25+ Districts</h4>
                        <p class="text-slate-600 text-sm leading-relaxed">Expanded branching and services to bring accessible finance closer to rural communities.</p>
                    </div>
                    <span class="text-5xl font-black text-slate-150/70 font-mono mt-6 block text-right group-hover:text-emerald-500/10 transition-colors">03</span>
                </div>

                <!-- Milestone Card 4 -->
                <div class="glass-card p-8 rounded-3xl border border-white flex flex-col justify-between relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-emerald-500/5 rounded-bl-full flex items-center justify-center -z-10 group-hover:bg-emerald-500/10 transition-colors"></div>
                    <div>
                        <span class="text-xs font-semibold text-emerald-600 uppercase tracking-widest bg-emerald-50 px-2.5 py-1 rounded-full border border-emerald-100">Impact</span>
                        <h4 class="text-lg font-bold text-slate-800 mt-4 mb-2">10K+ Members</h4>
                        <p class="text-slate-600 text-sm leading-relaxed">Empowering over ten thousand active savers and loan recipients toward self-reliance.</p>
                    </div>
                    <span class="text-5xl font-black text-slate-150/70 font-mono mt-6 block text-right group-hover:text-emerald-500/10 transition-colors">04</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="py-24 bg-white relative overflow-hidden" data-aos="fade-up">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <p class="text-xs uppercase tracking-[0.25em] text-emerald-600 font-bold">Why Choose Us</p>
        <h2 class="text-3xl md:text-4xl font-extrabold text-slate-950 mt-3 font-sans">We are more than just a SACCO</h2>
        <p class="text-slate-500 mt-3 max-w-2xl mx-auto">We are a trusted partner committed to your financial growth and success.</p>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-16">
            <!-- Card 1 -->
            <div class="glass-card p-8 rounded-3xl border border-slate-100 flex flex-col justify-between select-none" data-aos="fade-up" data-aos-delay="0">
                <div>
                    <div class="w-14 h-14 bg-emerald-50 border border-emerald-100 rounded-2xl flex items-center justify-center mx-auto mb-6 text-emerald-600">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <h3 class="font-bold text-slate-800 mb-2 text-base">We act with Integrity</h3>
                    <p class="text-slate-600 text-xs leading-relaxed">You can rely on us to handle your finances with honesty, and strong ethical standards.</p>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="glass-card p-8 rounded-3xl border border-slate-100 flex flex-col justify-between select-none" data-aos="fade-up" data-aos-delay="100">
                <div>
                    <div class="w-14 h-14 bg-emerald-50 border border-emerald-100 rounded-2xl flex items-center justify-center mx-auto mb-6 text-emerald-600">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </div>
                    <h3 class="font-bold text-slate-800 mb-2 text-base">We practice Transparency</h3>
                    <p class="text-slate-600 text-xs leading-relaxed">Every transaction and decision is open and accountable, giving you confidence.</p>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="glass-card p-8 rounded-3xl border border-slate-100 flex flex-col justify-between select-none" data-aos="fade-up" data-aos-delay="200">
                <div>
                    <div class="w-14 h-14 bg-emerald-50 border border-emerald-100 rounded-2xl flex items-center justify-center mx-auto mb-6 text-emerald-600">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="font-bold text-slate-800 mb-2 text-base">We value Your Time</h3>
                    <p class="text-slate-600 text-xs leading-relaxed">Fast approvals and efficient service. We respect your time.</p>
                </div>
            </div>
            <!-- Card 4 -->
            <div class="glass-card p-8 rounded-3xl border border-slate-100 flex flex-col justify-between select-none" data-aos="fade-up" data-aos-delay="300">
                <div>
                    <div class="w-14 h-14 bg-emerald-50 border border-emerald-100 rounded-2xl flex items-center justify-center mx-auto mb-6 text-emerald-600">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    </div>
                    <h3 class="font-bold text-slate-800 mb-2 text-base">Customer Care</h3>
                    <p class="text-slate-600 text-xs leading-relaxed">We prioritize the needs and satisfaction of our members.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats -->
@php
    $establishedYear = intval($settings_values['org_established_year'] ?? 2003);
    $yearsExp = max(1, date('Y') - $establishedYear);
    $memberCount = \App\Models\Member::count() + 1200; // Legacy base count helper
@endphp
<section class="py-16 bg-theme-primary text-white" data-aos="fade-up">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center pb-2">
            <div>
                <div class="text-4xl md:text-5xl font-bold mb-2" data-counter-target="50" data-counter-suffix="+">0+</div>
                <div class="text-emerald-100">Professional Staff</div>
            </div>
            <div>
                <div class="text-4xl md:text-5xl font-bold mb-2" data-counter-target="25" data-counter-suffix="+">0+</div>
                <div class="text-emerald-100">Districts Served</div>
            </div>
            <div>
                <div class="text-4xl md:text-5xl font-bold mb-2" data-counter-target="{{ $yearsExp }}" data-counter-suffix="+">0+</div>
                <div class="text-emerald-100">Years of Experience</div>
            </div>
            <div>
                <div class="text-4xl md:text-5xl font-bold mb-2" data-counter-target="{{ $memberCount }}" data-counter-suffix="+">0+</div>
                <div class="text-emerald-100">Satisfied Members</div>
            </div>
        </div>
    </div>
</section>

<!-- Interactive Estimator Widget (Save the Children style calculator) -->
<section class="py-24 bg-emerald-950 text-white relative overflow-hidden" data-aos="fade-up">
    <!-- Visual background decoration -->
    <div class="absolute -right-32 -bottom-32 w-96 h-96 rounded-full bg-emerald-800/30 blur-3xl"></div>
    <div class="absolute -left-32 -top-32 w-96 h-96 rounded-full bg-green-800/30 blur-3xl"></div>

    <div class="max-w-5xl mx-auto px-4">
        <div class="text-center mb-16">
            <span class="text-xs font-bold uppercase tracking-[0.25em] text-emerald-400">Interactive Tool</span>
            <h2 class="text-3xl md:text-5xl font-black text-white mt-3 font-sans">Savings & Loan Estimator</h2>
            <p class="text-emerald-100/70 mt-2 max-w-xl mx-auto">Estimate your savings growth or plan your loan repayment options instantly.</p>
        </div>

        <!-- Alpine Calculator Container -->
        <div class="glass-panel-dark rounded-3xl p-8 backdrop-blur-lg border border-white/10 shadow-2xl" x-data="{
            tab: 'savings',
            // Savings state
            mDeposit: 100000,
            saveTerm: 12,
            saveRate: 0.05,
            get projectedSavings() {
                let total = 0;
                let ratePerMonth = this.saveRate / 12;
                for (let i = 0; i < this.saveTerm; i++) {
                    total = (total + parseFloat(this.mDeposit)) * (1 + ratePerMonth);
                }
                return Math.round(total);
            },
            get totalInvested() {
                return this.mDeposit * this.saveTerm;
            },
            get interestGained() {
                return Math.max(0, this.projectedSavings - this.totalInvested);
            },
            // Loan state
            loanAmount: 2000000,
            loanRate: 12,
            loanTerm: 12,
            get monthlyRepayment() {
                let r = (this.loanRate / 100) / 12;
                let n = this.loanTerm;
                if (r === 0) return Math.round(this.loanAmount / n);
                let emi = (this.loanAmount * r * Math.pow(1 + r, n)) / (Math.pow(1 + r, n) - 1);
                return Math.round(emi);
            },
            get totalLoanRepayable() {
                return this.monthlyRepayment * this.loanTerm;
            },
            get totalLoanInterest() {
                return Math.max(0, this.totalLoanRepayable - this.loanAmount);
            }
        }">
            <!-- Tabs -->
            <div class="flex border-b border-white/10 mb-8 p-1.5 bg-black/25 rounded-2xl max-w-md mx-auto">
                <button @click="tab = 'savings'" :class="tab === 'savings' ? 'bg-emerald-600 text-white shadow shadow-emerald-500/20' : 'text-slate-300 hover:text-white'" class="flex-1 py-3 text-center text-sm font-bold rounded-xl transition-all duration-305 cursor-pointer">
                    Savings Growth
                </button>
                <button @click="tab = 'loan'" :class="tab === 'loan' ? 'bg-emerald-600 text-white shadow shadow-emerald-500/20' : 'text-slate-300 hover:text-white'" class="flex-1 py-3 text-center text-sm font-bold rounded-xl transition-all duration-305 cursor-pointer">
                    Loan Repayments
                </button>
            </div>

            <!-- Savings Calculator Tab -->
            <div x-show="tab === 'savings'" x-transition:enter="transition ease-out duration-350" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="grid lg:grid-cols-12 gap-8 items-center">
                <!-- Inputs -->
                <div class="lg:col-span-7 space-y-6">
                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="text-sm font-semibold text-emerald-200">Monthly Deposit</span>
                            <span class="text-sm font-extrabold text-white" x-text="new Intl.NumberFormat().format(mDeposit) + ' UGX'"></span>
                        </div>
                        <input type="range" min="20000" max="2000000" step="10000" x-model="mDeposit" class="w-full h-2 bg-emerald-900 rounded-lg appearance-none cursor-pointer accent-emerald-500">
                        <div class="flex justify-between text-[11px] text-emerald-300/40 mt-1">
                            <span>20,000 UGX</span>
                            <span>2,000,000 UGX</span>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="text-sm font-semibold text-emerald-200">Duration (Months)</span>
                            <span class="text-sm font-extrabold text-white" x-text="saveTerm + ' months'"></span>
                        </div>
                        <input type="range" min="3" max="36" step="1" x-model="saveTerm" class="w-full h-2 bg-emerald-900 rounded-lg appearance-none cursor-pointer accent-emerald-500">
                        <div class="flex justify-between text-[11px] text-emerald-300/40 mt-1">
                            <span>3 months</span>
                            <span>36 months</span>
                        </div>
                    </div>

                    <div>
                        <span class="text-sm font-semibold text-emerald-200 block mb-3">Savings Account Type</span>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="flex items-center gap-3 p-4 bg-black/20 rounded-xl border border-white/5 cursor-pointer hover:bg-black/35 transition-colors">
                                <input type="radio" name="sav_rate" :value="0.03" x-model="saveRate" class="text-emerald-600 focus:ring-emerald-500 bg-emerald-950 border-white/10">
                                <div>
                                    <p class="text-xs font-bold text-white">Normal Savings</p>
                                    <p class="text-[10px] text-emerald-300">3% Annual Interest</p>
                                </div>
                            </label>
                            <label class="flex items-center gap-3 p-4 bg-black/20 rounded-xl border border-white/5 cursor-pointer hover:bg-black/35 transition-colors">
                                <input type="radio" name="sav_rate" :value="0.05" x-model="saveRate" class="text-emerald-600 focus:ring-emerald-500 bg-emerald-950 border-white/10">
                                <div>
                                    <p class="text-xs font-bold text-white">Target Savings</p>
                                    <p class="text-[10px] text-emerald-300">5% Annual Interest</p>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Outputs -->
                <div class="lg:col-span-5 bg-white/5 rounded-2xl p-6 border border-white/10 flex flex-col justify-between min-h-[300px]">
                    <div>
                        <h4 class="text-xs font-bold uppercase tracking-wider text-emerald-300 mb-6">Savings Projection</h4>
                        <div class="space-y-4">
                            <div class="flex justify-between border-b border-white/5 pb-2">
                                <span class="text-xs text-emerald-100/60">Total Principal</span>
                                <span class="text-sm font-medium text-white" x-text="new Intl.NumberFormat().format(mDeposit * saveTerm) + ' UGX'"></span>
                            </div>
                            <div class="flex justify-between border-b border-white/5 pb-2">
                                <span class="text-xs text-emerald-100/60">Est. Interest Earned</span>
                                <span class="text-sm font-medium text-emerald-400 font-mono" x-text="'+ ' + new Intl.NumberFormat().format(interestGained) + ' UGX'"></span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <span class="text-xs text-emerald-300/80 uppercase tracking-wider font-bold">Total Estimated Value</span>
                        <div class="text-3xl font-black text-emerald-400 mt-2 font-sans" x-text="new Intl.NumberFormat().format(projectedSavings) + ' UGX'"></div>
                        <a href="{{ route('application') }}" class="site-btn-primary w-full text-center mt-6 py-3 rounded-xl block text-sm font-bold shadow-lg shadow-emerald-700/25">Start Saving Today</a>
                    </div>
                </div>
            </div>

            <!-- Loan Calculator Tab -->
            <div x-show="tab === 'loan'" x-transition:enter="transition ease-out duration-350" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="grid lg:grid-cols-12 gap-8 items-center" x-cloak>
                <!-- Inputs -->
                <div class="lg:col-span-7 space-y-6">
                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="text-sm font-semibold text-emerald-200">Loan Amount</span>
                            <span class="text-sm font-extrabold text-white" x-text="new Intl.NumberFormat().format(loanAmount) + ' UGX'"></span>
                        </div>
                        <input type="range" min="100000" max="20000000" step="100000" x-model="loanAmount" class="w-full h-2 bg-emerald-900 rounded-lg appearance-none cursor-pointer accent-emerald-500">
                        <div class="flex justify-between text-[11px] text-emerald-300/40 mt-1">
                            <span>100,000 UGX</span>
                            <span>20,000,000 UGX</span>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="text-sm font-semibold text-emerald-200">Repayment Period</span>
                            <span class="text-sm font-extrabold text-white" x-text="loanTerm + ' months'"></span>
                        </div>
                        <input type="range" min="3" max="36" step="1" x-model="loanTerm" class="w-full h-2 bg-emerald-900 rounded-lg appearance-none cursor-pointer accent-emerald-500">
                        <div class="flex justify-between text-[11px] text-emerald-300/40 mt-1">
                            <span>3 months</span>
                            <span>36 months</span>
                        </div>
                    </div>

                    <div>
                        <span class="text-sm font-semibold text-emerald-200 block mb-3">Select Loan Product</span>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="flex items-center gap-3 p-4 bg-black/20 rounded-xl border border-white/5 cursor-pointer hover:bg-black/35 transition-colors">
                                <input type="radio" name="loan_rate" :value="10" x-model="loanRate" class="text-emerald-600 focus:ring-emerald-500 bg-emerald-950 border-white/10" checked>
                                <div>
                                    <p class="text-xs font-bold text-white">Emergency/School</p>
                                    <p class="text-[10px] text-emerald-300">10% Annual Interest</p>
                                </div>
                            </label>
                            <label class="flex items-center gap-3 p-4 bg-black/20 rounded-xl border border-white/5 cursor-pointer hover:bg-black/35 transition-colors">
                                <input type="radio" name="loan_rate" :value="15" x-model="loanRate" class="text-emerald-600 focus:ring-emerald-500 bg-emerald-950 border-white/10">
                                <div>
                                    <p class="text-xs font-bold text-white">Business/Agri</p>
                                    <p class="text-[10px] text-emerald-300">15% Annual Interest</p>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Outputs -->
                <div class="lg:col-span-5 bg-white/5 rounded-2xl p-6 border border-white/10 flex flex-col justify-between min-h-[300px]">
                    <div>
                        <h4 class="text-xs font-bold uppercase tracking-wider text-emerald-300 mb-6">Repayment Breakdown</h4>
                        <div class="space-y-4">
                            <div class="flex justify-between border-b border-white/5 pb-2">
                                <span class="text-xs text-emerald-100/60">Principal Loan</span>
                                <span class="text-sm font-medium text-white" x-text="new Intl.NumberFormat().format(loanAmount) + ' UGX'"></span>
                            </div>
                            <div class="flex justify-between border-b border-white/5 pb-2">
                                <span class="text-xs text-emerald-100/60">Estimated Total Interest</span>
                                <span class="text-sm font-medium text-amber-400 font-mono" x-text="new Intl.NumberFormat().format(totalLoanInterest) + ' UGX'"></span>
                            </div>
                            <div class="flex justify-between border-b border-white/5 pb-2">
                                <span class="text-xs text-emerald-100/60">Total Repayable</span>
                                <span class="text-sm font-medium text-white" x-text="new Intl.NumberFormat().format(totalLoanRepayable) + ' UGX'"></span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <span class="text-xs text-emerald-300/80 uppercase tracking-wider font-bold">Estimated Monthly Payment</span>
                        <div class="text-3xl font-black text-emerald-400 mt-2 font-sans" x-text="new Intl.NumberFormat().format(monthlyRepayment) + ' UGX'"></div>
                        <a href="{{ route('application') }}" class="site-btn-primary w-full text-center mt-6 py-3 rounded-xl block text-sm font-bold shadow-lg shadow-emerald-700/25">Apply for a Loan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Key Saving Products (World Vision sponsored layout grid) -->
<section class="py-24 bg-gray-50 relative overflow-hidden" data-aos="fade-up">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <p class="text-xs uppercase tracking-[0.25em] text-emerald-600 font-bold">Our Products</p>
            <h2 class="text-3xl md:text-4xl font-extrabold text-slate-950 mt-3 font-sans">Key Saving Products</h2>
            <p class="text-slate-500 mt-2 max-w-2xl mx-auto">{{ $orgName }} provides a variety of savings and account services designed to meet the different financial needs of its members, groups, and institutions.</p>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($services as $service)
                <div class="glass-card p-6 rounded-3xl flex flex-col justify-between border border-slate-201/60 hover-scale">
                    <div>
                        <div class="w-12 h-12 bg-emerald-50 rounded-2xl border border-emerald-100 flex items-center justify-center mb-6 text-emerald-600">
                            @if($service->icon)
                                {!! $service->icon !!}
                            @else
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            @endif
                        </div>
                        <h3 class="font-bold text-slate-800 mb-3 text-base">{{ $service->title }}</h3>
                        <p class="text-slate-600 text-xs leading-relaxed">{{ Str::limit($service->description, 100) }}</p>
                    </div>
                    <a href="{{ route('services') }}" class="text-emerald-700 text-xs font-bold mt-6 inline-block hover:text-emerald-800">Learn More →</a>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-slate-500">No services available at the moment. Please check back later.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- M-SACCO Section -->
<section class="py-16 bg-white" data-aos="fade-up">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid md:grid-cols-2 gap-10 items-center">
            <div>
                <p class="text-sm uppercase tracking-widest text-green-600 font-semibold">Mobile Banking</p>
                <h2 class="section-heading mt-3">M-SACCO Service at {{ $orgName }}</h2>
                <p class="text-gray-600 mt-4 leading-relaxed">M-SACCO is a mobile banking service that allows members of {{ $orgName }} to access selected SACCO services using their mobile phones.</p>
                <div class="mt-6 space-y-4">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <div><strong class="text-gray-900">Convenience:</strong> <span class="text-gray-600">Access SACCO services without visiting the office.</span></div>
                    </div>
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <div><strong class="text-gray-900">Time Saving:</strong> <span class="text-gray-600">Transactions can be done quickly from any location.</span></div>
                    </div>
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <div><strong class="text-gray-900">Improved Financial Management:</strong> <span class="text-gray-600">Easily monitor your savings and loan balances.</span></div>
                    </div>
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <div><strong class="text-gray-900">Enhanced Security:</strong> <span class="text-gray-600">Reduced need to carry cash.</span></div>
                    </div>
                </div>
                <a href="{{ route('msacco') }}" class="site-btn-primary mt-6 inline-block">How It Works</a>
            </div>
            <div class="bg-green-50 p-8 text-center">
                <div class="text-6xl mb-4">
                    <svg class="w-32 h-32 mx-auto text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                </div>
                <div class="text-xl font-bold text-gray-900 mb-2">M-SACCO</div>
                <p class="text-gray-600 text-sm">Mobile Banking</p>
            </div>
        </div>
    </div>
</section>

<!-- News & Events -->
<section class="py-16 bg-gray-50" data-aos="fade-up">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <p class="text-sm uppercase tracking-widest text-green-600 font-semibold">Stay Updated</p>
            <h2 class="section-heading mt-3">News and Event</h2>
            <p class="section-subheading mx-auto">Stay Updated with Our Latest News</p>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($latestNews as $news)
                <a href="{{ route('news.show', $news->slug) }}" class="news-card block">
                    <div class="h-48 bg-gray-200 overflow-hidden">
                        @if($news->image)
                            <img src="{{ Storage::url($news->image) }}" alt="{{ $news->title }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-green-100 flex items-center justify-center text-green-600 font-bold">NEWS</div>
                        @endif
                    </div>
                    <div class="p-5">
                        @if($news->category)
                            <span class="text-xs uppercase tracking-wider text-green-600 font-semibold">{{ $news->category }}</span>
                        @endif
                        <h3 class="font-bold text-gray-900 mt-2 mb-2">{{ $news->title }}</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">{{ Str::limit(strip_tags($news->content ?? $news->excerpt ?? ''), 120) }}</p>
                        <div class="flex items-center justify-between mt-4 text-sm">
                            <span class="text-gray-500">{{ $news->published_at?->format('M d, Y') }}</span>
                            <span class="text-green-600 font-medium">Read More</span>
                        </div>
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
<section class="py-16 bg-white" data-aos="fade-up">
    <div class="max-w-3xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="section-heading">Frequently Asked Questions</h2>
            <p class="section-subheading mx-auto">Find answers to common questions about {{ $orgName }} and our services.</p>
        </div>
        <div class="space-y-3">
            @forelse($faqs as $faq)
                <div class="faq-item" x-data="{ open: false }">
                    <button @click="open = !open" class="w-full flex items-center justify-between px-6 py-4 text-left text-gray-900 hover:bg-gray-50 transition-colors">
                        <span class="font-medium">{{ $faq->question }}</span>
                        <svg :class="{'rotate-180': open}" class="w-4 h-4 text-gray-500 transition-transform flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open" class="px-6 pb-4" x-cloak>
                        <p class="text-gray-600 text-sm leading-relaxed">{{ $faq->answer }}</p>
                    </div>
                </div>
            @empty
                <div class="border border-gray-200 px-6 py-4">
                    <p class="text-gray-500">No FAQs available at the moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Partners -->
<section class="py-12 bg-gray-50 overflow-hidden" data-aos="fade-up">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-gray-900">Our Partners</h2>
        </div>
        <div class="flex gap-8 partner-scroll" style="width: max-content;">
            @forelse($partners->merge($partners) as $partner)
                <div class="flex-shrink-0 border border-gray-200 px-8 py-4 bg-white">
                    @if($partner->logo)
                        <img src="{{ Storage::url($partner->logo) }}" alt="{{ $partner->name }}" class="h-10 w-auto">
                    @else
                        <span class="text-gray-600 font-medium">{{ $partner->name }}</span>
                    @endif
                </div>
            @empty
                <div class="flex-shrink-0 border border-gray-200 px-8 py-4 bg-white text-gray-600 font-medium">Stanbic Bank</div>
                <div class="flex-shrink-0 border border-gray-200 px-8 py-4 bg-white text-gray-600 font-medium">Pearl Bank</div>
                <div class="flex-shrink-0 border border-gray-200 px-8 py-4 bg-white text-gray-600 font-medium">Microfinance Support</div>
                <div class="flex-shrink-0 border border-gray-200 px-8 py-4 bg-white text-gray-600 font-medium">UCSU</div>
                <div class="flex-shrink-0 border border-gray-200 px-8 py-4 bg-white text-gray-600 font-medium">UMRA</div>
                <div class="flex-shrink-0 border border-gray-200 px-8 py-4 bg-white text-gray-600 font-medium">Stanbic Bank</div>
                <div class="flex-shrink-0 border border-gray-200 px-8 py-4 bg-white text-gray-600 font-medium">Pearl Bank</div>
                <div class="flex-shrink-0 border border-gray-200 px-8 py-4 bg-white text-gray-600 font-medium">Microfinance Support</div>
                <div class="flex-shrink-0 border border-gray-200 px-8 py-4 bg-white text-gray-600 font-medium">UCSU</div>
                <div class="flex-shrink-0 border border-gray-200 px-8 py-4 bg-white text-gray-600 font-medium">UMRA</div>
            @endforelse
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-16 bg-green-700 text-white text-center">
    <div class="max-w-3xl mx-auto px-4">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Ready to Join {{ $orgName }}?</h2>
        <p class="text-lg text-green-100 mb-8">Start your journey towards financial freedom today.</p>
        <a href="tel:{{ $settings_values['org_phone'] ?? '+256775125122' }}" class="text-green-200 text-xl block mb-8 hover:text-white transition-colors">{{ $settings_values['org_phone'] ?? '+256 0775 125 122' }}</a>
        <a href="{{ route('application') }}" class="inline-block bg-white text-green-800 font-bold px-10 py-3 hover:bg-green-50 transition-colors">Become a Member</a>
    </div>
</section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const counterObservers = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    const end = parseInt(el.getAttribute('data-counter-target'), 10);
                    const suffix = el.getAttribute('data-counter-suffix') || '';
                    const duration = 2000; // 2 seconds animation
                    let startTimestamp = null;
                    const step = (timestamp) => {
                        if (!startTimestamp) startTimestamp = timestamp;
                        const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                        const current = Math.floor(progress * end);
                        el.innerHTML = current.toLocaleString() + suffix;
                        if (progress < 1) {
                            window.requestAnimationFrame(step);
                        } else {
                            el.innerHTML = end.toLocaleString() + suffix;
                        }
                    };
                    window.requestAnimationFrame(step);
                    observer.unobserve(el);
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('[data-counter-target]').forEach(el => counterObservers.observe(el));
    });
</script>
@endpush

@endsection
