@extends('layouts.site')

@section('title', 'Contact')
@section('meta_description', 'Contact Kasambya SACCO for inquiries about membership, savings, loans, and support.')

@section('content')

<section class="relative bg-gradient-to-br from-theme-primary/90 via-theme-primary/70 to-slate-900 overflow-hidden py-20 px-4">
    {{-- Decorative Background Glows --}}
    <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-theme-primary-soft rounded-full blur-3xl"></div>
    <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-theme-accent-soft rounded-full blur-3xl"></div>
    
    <div class="relative max-w-7xl mx-auto text-left">
        <div class="flex items-center space-x-2 text-xs font-semibold text-theme-primary/70 uppercase tracking-widest mb-4">
            <a href="{{ route('home') }}" class="hover:text-theme-accent transition-colors">Kasambya SACCO</a>
            <span>/</span>
            <span class="text-slate-300">Contact Us</span>
        </div>
        <h1 class="text-4xl md:text-5xl font-black text-white tracking-tight leading-none mb-4">
            Get in Touch
        </h1>
        <p class="text-theme-primary-contrast/80 text-base md:text-lg max-w-3xl leading-relaxed">
            We welcome your inquiries, suggestions, and feedback. Feel free to contact our administrative desks.
        </p>
    </div>
</section>

<!-- Map -->
<section class="py-8 bg-slate-50 border-b border-slate-200" data-aos="fade-up">
    <div class="max-w-7xl mx-auto px-4">
        <div class="h-64 md:h-80 bg-slate-200 overflow-hidden border border-slate-200/50 rounded-3xl shadow-sm">
            <iframe src="https://www.openstreetmap.org/export/embed.html?bbox=32.5%2C0.5%2C32.6%2C0.6&amp;layer=mapnik&amp;marker=0.55%2C32.55" width="100%" height="100%" frameborder="0" scrolling="no" style="border:0" allowfullscreen loading="lazy" title="Kasambya SACCO Location Map"></iframe>
        </div>
    </div>
</section>

<section class="py-16 bg-slate-50/50" data-aos="fade-up">
    <div class="max-w-7xl mx-auto px-4 grid gap-12 lg:grid-cols-2">
        <!-- Contact Form -->
        <div class="glass-card rounded-[2rem] border border-slate-200/60 p-8 md:p-10 shadow-lg" data-aos="fade-right">
            @if(session('success'))
                    <div class="border border-theme-primary-light bg-theme-primary-soft rounded-2xl p-4 mb-6 text-theme-primary text-sm flex items-center gap-2">
                    <svg class="w-5 h-5 text-theme-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="name" class="block text-xs font-bold text-slate-700 uppercase tracking-widest mb-2">Name <span class="text-red-500">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Your full name" required class="w-full bg-slate-100/50 focus:bg-white border border-slate-200 focus:border-theme-primary focus:ring-2 focus:ring-theme-primary/20 text-slate-800 text-sm rounded-2xl px-5 py-3.5 transition-all outline-none">
                    @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-widest mb-2">Email <span class="text-red-500">*</span></label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Your email address" required class="w-full bg-slate-100/50 focus:bg-white border border-slate-200 focus:border-theme-primary focus:ring-2 focus:ring-theme-primary/20 text-slate-800 text-sm rounded-2xl px-5 py-3.5 transition-all outline-none">
                    @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="phone" class="block text-xs font-bold text-slate-700 uppercase tracking-widest mb-2">Phone <span class="text-red-500">*</span></label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Your phone number" required class="w-full bg-slate-100/50 focus:bg-white border border-slate-200 focus:border-theme-primary focus:ring-2 focus:ring-theme-primary/20 text-slate-800 text-sm rounded-2xl px-5 py-3.5 transition-all outline-none">
                    @error('phone') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="subject" class="block text-xs font-bold text-slate-700 uppercase tracking-widest mb-2">Subject</label>
                    <input type="text" id="subject" name="subject" value="{{ old('subject') }}" placeholder="Subject of your message" class="w-full bg-slate-100/50 focus:bg-white border border-slate-200 focus:border-theme-primary focus:ring-2 focus:ring-theme-primary/20 text-slate-800 text-sm rounded-2xl px-5 py-3.5 transition-all outline-none">
                    @error('subject') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="message" class="block text-xs font-bold text-slate-700 uppercase tracking-widest mb-2">Message <span class="text-red-500">*</span></label>
                    <textarea id="message" name="message" placeholder="Write your message here..." required class="w-full bg-slate-100/50 focus:bg-white border border-slate-200 focus:border-theme-primary focus:ring-2 focus:ring-theme-primary/20 text-slate-800 text-sm rounded-2xl px-5 py-3.5 transition-all outline-none min-h-[160px]">{{ old('message') }}</textarea>
                    @error('message') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="w-full text-center bg-theme-primary text-theme-primary-contrast font-extrabold uppercase tracking-widest px-8 py-4.5 rounded-2xl transition duration-300 shadow-md text-[11px]">Send Message</button>
            </form>
        </div>

        <!-- Contact Info + FAQ -->
        <div class="space-y-6" data-aos="fade-left">
            <div class="glass-card rounded-3xl border border-slate-200/60 p-6 flex items-start gap-4">
                <div class="w-12 h-12 bg-theme-primary-soft border border-theme-primary-light flex items-center justify-center text-theme-primary rounded-xl flex-shrink-0 animate-pulse-slow">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <div>
                    <h3 class="font-bold text-slate-900 leading-snug">Office Location</h3>
                    <p class="mt-1.5 text-slate-500 text-sm leading-relaxed">{{ $settings_values['org_address'] ?? 'Kasambya Town Council, Masengere Road, Kasambya, Uganda' }}</p>
                </div>
            </div>

            <div class="glass-card rounded-3xl border border-slate-200/60 p-6 flex items-start gap-4">
                <div class="w-12 h-12 bg-theme-accent-soft border border-theme-accent-light flex items-center justify-center text-theme-accent rounded-xl flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                </div>
                <div>
                    <h3 class="font-bold text-slate-900 leading-snug">Office Lines</h3>
                    <p class="mt-1.5 text-slate-500 text-sm leading-relaxed font-mono">{{ $settings_values['org_phone'] ?? "+256 775 125 122<br>+256 779 892 660" }}</p>
                </div>
            </div>

            <div class="glass-card rounded-3xl border border-slate-200/60 p-6 flex items-start gap-4">
                <div class="w-12 h-12 bg-theme-secondary-soft border border-theme-secondary-light flex items-center justify-center text-theme-secondary rounded-xl flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <h3 class="font-bold text-slate-900 leading-snug">Official Emails</h3>
                    <p class="mt-1.5 text-slate-500 text-sm leading-relaxed font-mono">
                        {{ $settings_values['org_email'] ?? 'kasambyasacco@gmail.com' }}
                    </p>
                </div>
            </div>

            <!-- FAQ Accordion -->
            <div class="glass-card rounded-3xl border border-slate-200/60 p-6 shadow-sm">
                <h3 class="font-black text-slate-900 text-base mb-4 tracking-tight">Frequently Asked Questions</h3>
                <div class="space-y-3">
                    @forelse($faqs as $faq)
                        <div class="border border-slate-100 rounded-2xl overflow-hidden bg-slate-50/20" x-data="{ open: false }">
                            <button @click="open = !open" class="w-full flex items-center justify-between px-4 py-3.5 text-left text-sm text-slate-800 hover:bg-slate-50 transition-colors">
                                <span class="font-bold pr-4">{{ $faq->question }}</span>
                                <svg :class="{'rotate-180': open}" class="w-3.5 h-3.5 text-slate-400 transition-transform flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            <div x-show="open" class="px-4 pb-4 border-t border-slate-50 pt-2" x-cloak>
                                <p class="text-slate-500 text-sm leading-relaxed">{{ $faq->answer }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-slate-400 text-sm">No FAQs available.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-20 bg-white text-center">
    <div class="max-w-3xl mx-auto px-4">
        <h2 class="text-3xl font-black text-slate-900 tracking-tight">Still have questions?</h2>
        <p class="mt-4 text-slate-500 text-sm md:text-base leading-relaxed">Reach out and we'll help you get started with the right membership and savings plan.</p>
        <a href="{{ route('application') }}" class="inline-block bg-theme-primary text-theme-primary-contrast font-extrabold uppercase tracking-widest px-8 py-4.5 rounded-2xl transition duration-300 shadow-md text-[11px] mt-8">Apply Now</a>
    </div>
</section>

@endsection
