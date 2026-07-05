@extends('layouts.member')

@section('title', 'Support')
@section('page_title', 'Support')

@section('content')

<section class="bg-gradient-to-br from-emerald-900 to-emerald-950 text-white relative overflow-hidden">
    <div class="absolute -right-24 -top-24 w-96 h-96 bg-emerald-800/15 rounded-full blur-3xl"></div>
    <div class="absolute -left-20 -bottom-20 w-96 h-96 bg-green-900/10 rounded-full blur-3xl"></div>
    <div class="px-4 lg:px-8 py-8 relative z-10">
        <div>
            <h1 class="text-2xl md:text-3xl font-black tracking-tight text-white">Member Support</h1>
            <p class="text-emerald-100/70 text-sm mt-1">We're here to help you</p>
        </div>
    </div>
</section>

<section class="py-8 bg-slate-50 dark:bg-slate-900">
    <div class="px-4 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">

            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white dark:bg-slate-800 rounded-2xl lg:rounded-3xl border border-slate-200 dark:border-slate-700/60 p-6 lg:p-8 shadow-sm">
                    <h2 class="text-lg lg:text-xl font-bold text-slate-900 dark:text-white mb-6">Frequently Asked Questions</h2>
                    @if($faqs->count())
                        <div class="space-y-3">
                            @foreach($faqs as $faq)
                                <div class="border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden" x-data="{ open: false }">
                                    <button @click="open = !open" class="w-full flex items-center justify-between px-4 py-3 lg:px-5 lg:py-4 text-left text-sm text-slate-900 dark:text-white hover:bg-slate-50 dark:bg-slate-900 transition-colors cursor-pointer">
                                        <span class="font-medium pr-4">{{ $faq->question }}</span>
                                        <svg :class="{'rotate-180': open}" class="w-4 h-4 text-slate-600 dark:text-slate-400 transition-transform flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                    </button>
                                    <div x-show="open" class="px-4 lg:px-5 pb-3 lg:pb-4" x-cloak>
                                        <p class="text-slate-600 dark:text-slate-400 text-xs lg:text-sm leading-relaxed">{{ $faq->answer }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-slate-600 dark:text-slate-400 text-sm">No FAQs available at the moment.</p>
                    @endif
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white dark:bg-slate-800 rounded-2xl lg:rounded-3xl border border-slate-200 dark:border-slate-700/60 p-6 shadow-sm">
                    <h3 class="font-bold text-slate-900 dark:text-white mb-4 text-sm uppercase tracking-wider">Contact Info</h3>
                    <div class="space-y-4 text-sm">
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 bg-emerald-50 dark:bg-emerald-950 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div>
                                <p class="font-medium text-slate-800 dark:text-slate-200">Office Location</p>
                                <p class="text-slate-600 dark:text-slate-400 text-xs mt-0.5">Kasambya Town Council, Masengere Road, Kasambya, Uganda</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 bg-emerald-50 dark:bg-emerald-950 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <div>
                                <p class="font-medium text-slate-800 dark:text-slate-200">Phone</p>
                                <p class="text-slate-600 dark:text-slate-400 text-xs mt-0.5">+256 0775 125 122 / 0779 892 660</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 bg-emerald-50 dark:bg-emerald-950 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <p class="font-medium text-slate-800 dark:text-slate-200">Email</p>
                                <p class="text-slate-600 dark:text-slate-400 text-xs mt-0.5">kasambyasacco@gmail.com</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 bg-emerald-50 dark:bg-emerald-950 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <p class="font-medium text-slate-800 dark:text-slate-200">Working Hours</p>
                                <p class="text-slate-600 dark:text-slate-400 text-xs mt-0.5">Mon - Fri: 8:45 AM - 5:00 PM<br>Sat: 8:45 AM - 3:00 PM</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-emerald-800 to-emerald-950 text-white p-6 rounded-2xl lg:rounded-3xl relative overflow-hidden shadow-md">
                    <div class="absolute -right-12 -top-12 w-32 h-32 bg-white dark:bg-slate-800/10 rounded-full blur-2xl"></div>
                    <h3 class="font-bold text-base relative z-10">Need Quick Help?</h3>
                    <p class="text-xs text-emerald-100/75 mt-2 relative z-10">Call our support line for immediate assistance.</p>
                    <a href="tel:+256775125122" class="mt-4 inline-block bg-white dark:bg-slate-800/15 hover:bg-white dark:bg-slate-800/25 text-white font-semibold px-5 py-2.5 rounded-xl text-sm transition-all relative z-10">Call +256 775 125122</a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection