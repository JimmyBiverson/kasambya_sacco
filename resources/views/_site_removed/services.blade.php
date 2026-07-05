@extends('layouts.app')

@section('title', 'Our Services')
@section('meta_description', 'Discover Kasambya SACCO services including savings accounts, loans, and member support.')

@section('content')

<section class="relative overflow-hidden bg-emerald-700 text-white">
    <div class="absolute inset-0 opacity-15 bg-[radial-gradient(circle_at_top_right,_rgba(255,255,255,0.24),_transparent_55%)]"></div>
    <div class="relative max-w-7xl mx-auto px-4 py-24 grid lg:grid-cols-2 gap-10 items-center">
        <div class="space-y-6">
            <p class="text-sm uppercase tracking-[0.32em] text-emerald-200">Our Services</p>
            <h1 class="text-5xl md:text-6xl font-extrabold">Services that support your financial journey.</h1>
            <p class="max-w-2xl text-lg text-emerald-100 leading-relaxed">Explore our range of savings products, loan options, and membership services designed to help members save, borrow and plan for the future.</p>
            <a href="{{ route('application') }}" class="btn-primary">Become a Member</a>
        </div>
        <div class="grid gap-5 sm:grid-cols-2">
            <div class="rounded-[2rem] overflow-hidden shadow-2xl bg-white">
                <img src="{{ asset('images/service-1.jpg') }}" alt="Savings service" class="w-full h-full object-cover">
            </div>
            <div class="rounded-[2rem] overflow-hidden shadow-2xl bg-white">
                <img src="{{ asset('images/service-2.jpg') }}" alt="Loan service" class="w-full h-full object-cover">
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-14">
            <p class="text-sm uppercase tracking-[0.32em] text-emerald-600">Product lineup</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold text-slate-900">Flexible savings and loan products</h2>
        </div>
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @forelse($services as $service)
                <div class="rounded-3xl bg-white p-8 shadow-sm border border-slate-200 hover:shadow-md transition-shadow">
                    <div class="text-emerald-600 text-4xl font-bold mb-4">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
                    <h3 class="text-xl font-semibold text-slate-900 mb-3">{{ $service->title }}</h3>
                    <p class="text-slate-600 leading-relaxed">{{ $service->description }}</p>
                </div>
            @empty
                <div class="col-span-full text-center py-10">
                    <p class="text-slate-500">No services available at the moment. Please check back later.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="rounded-[2rem] bg-gradient-to-r from-emerald-600 to-emerald-500 p-12 text-white shadow-2xl">
            <div class="grid gap-8 md:grid-cols-2 items-center">
                <div>
                    <p class="text-sm uppercase tracking-[0.32em] text-emerald-100">Need help choosing?</p>
                    <h2 class="mt-4 text-3xl font-bold">Call our support team today</h2>
                    <p class="mt-4 text-slate-100 leading-relaxed">Our member support team is ready to guide you through the right savings and loan options for your needs.</p>
                </div>
                <div class="space-y-4">
                    <a href="tel:+2560775125122" class="block rounded-full bg-white/15 px-6 py-4 text-lg font-semibold text-white hover:bg-white/25 transition">+256 0775 125 122</a>
                    <a href="mailto:{{ $settings->get('org_email')->value ?? 'info@kasambyasacco.com' }}" class="block rounded-full bg-white/15 px-6 py-4 text-lg font-semibold text-white hover:bg-white/25 transition">Email Us</a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
