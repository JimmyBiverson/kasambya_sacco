@extends('layouts.site')

@section('title', 'Our Services')
@section('meta_description', 'Discover Mubende Employees and Community Sacco Ltd services including savings accounts, loans, and member support.')

@section('content')

<section class="relative bg-gradient-to-br from-theme-primary/90 via-theme-primary/70 to-slate-900 overflow-hidden py-20 px-4">
    {{-- Decorative Background Glows --}}
    <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-theme-primary-soft rounded-full blur-3xl"></div>
    <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-theme-accent-soft rounded-full blur-3xl"></div>
    
    <div class="relative max-w-7xl mx-auto text-left">
        <div class="flex items-center space-x-2 text-xs font-semibold text-theme-primary/70 uppercase tracking-widest mb-4">
            <a href="{{ route('home') }}" class="hover:text-theme-accent transition-colors">{{ $orgName }}</a>
            <span>/</span>
            <span class="text-slate-300">Services</span>
        </div>
        <h1 class="text-4xl md:text-5xl font-black text-white tracking-tight leading-none mb-4">
            Our Financial Products
        </h1>
        <p class="text-theme-primary-contrast/80 text-base md:text-lg max-w-3xl leading-relaxed">
            Explore our range of structured savings products, flexible loan options, and digital M-SACCO services designed to guarantee your financial independence.
        </p>
    </div>
</section>

<section class="py-20 bg-slate-50/50" data-aos="fade-up">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <span class="text-[11px] font-extrabold uppercase tracking-widest text-theme-primary bg-theme-primary-soft px-3 py-1 rounded-full border border-theme-primary-light">Product Lineup</span>
            <h2 class="text-3xl font-black text-slate-900 tracking-tight mt-4 font-sans">Flexible Savings Products</h2>
            <p class="text-slate-500 mt-2 max-w-2xl mx-auto">{{ $orgName }} provides a variety of savings and account services designed to meet the different financial needs of its members, groups, and institutions.</p>
        </div>
        
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($services as $service)
                <div class="glass-card rounded-3xl border border-slate-200/60 p-8 shadow-sm flex flex-col justify-between hover-scale group">
                    <div>
                        <div class="flex items-center justify-between mb-6">
                            <div class="w-12 h-12 bg-theme-primary-soft border border-theme-primary-light flex items-center justify-center text-theme-primary rounded-xl group-hover:bg-theme-primary group-hover:text-theme-primary-contrast transition-all duration-300">
                                @if($service->icon)
                                    {!! $service->icon !!}
                                @else
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                @endif
                            </div>
                            <span class="text-xs font-black text-slate-300 group-hover:text-theme-primary transition-colors uppercase tracking-widest font-mono">Service #{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 group-hover:text-theme-primary transition-colors mb-3 leading-snug">{{ $service->title }}</h3>
                        <p class="text-slate-600 text-sm leading-relaxed">{{ $service->description }}</p>
                    </div>
                </div>
            @empty
                <div class="col-span-full glass-card rounded-3xl border border-slate-200/60 p-12 text-center">
                    <p class="text-slate-500 text-sm">No savings services available at the moment. Please check back later.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Support CTA -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="relative bg-gradient-to-r from-theme-primary/80 to-theme-primary/95 rounded-[2rem] p-10 md:p-12 overflow-hidden shadow-xl">
            {{-- Decorative pattern overlay --}}
            <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
            
            <div class="relative grid md:grid-cols-2 gap-10 items-center">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-widest text-theme-primary bg-theme-primary/30 px-3 py-1 rounded-full">Support Center</span>
                    <h2 class="text-3xl md:text-4xl font-black text-white tracking-tight mt-4 leading-tight">Need assistance choosing the right plan?</h2>
                    <p class="text-theme-primary-contrast/80 mt-4 text-sm md:text-base leading-relaxed">Our support advisors are ready to walk you through our savings policies, interest metrics and dynamic loan configurations.</p>
                </div>
                <div class="flex flex-col sm:flex-row gap-4 justify-end">
                    <a href="tel:{{ $settings_values['org_phone'] ?? '+256775125122' }}" class="flex items-center justify-center gap-2 bg-white text-theme-primary hover:bg-theme-primary-soft transition px-6 py-4 rounded-2xl font-bold shadow-md text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <span>Call {{ $settings_values['org_phone'] ?? '+256 775 125' }}</span>
                    </a>
                    <a href="mailto:{{ $settings_values['org_email'] ?? 'mubendehq@gmail.com' }}" class="flex items-center justify-center gap-2 bg-theme-primary text-theme-primary-contrast hover:bg-theme-primary/90 transition px-6 py-4 rounded-2xl font-bold border border-theme-primary/30 text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <span>Send Support Mail</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
