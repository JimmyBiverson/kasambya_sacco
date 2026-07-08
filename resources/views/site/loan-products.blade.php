@extends('layouts.site')

@section('title', 'Loan Products')
@section('meta_description', 'Explore Kasambya SACCO loan products including Agriculture, Housing, School Fees, Transport and more.')

@section('content')

<section class="page-header">
    <div class="max-w-7xl mx-auto px-4">
        <div class="breadcrumb mb-3">
            <a href="{{ route('home') }}">Kasambya SACCO</a> / Loan Products
        </div>
        <h1>Loan Products</h1>
        <p class="text-theme-primary-contrast/80 mt-2 max-w-2xl">Kasambya SACCO offers a variety of loan products to support members in business, development, and meeting personal financial needs.</p>
    </div>
</section>

<section class="py-16 bg-gray-50" data-aos="fade-up">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($loanProducts as $product)
                <div class="bg-white border border-gray-200 p-8 hover:shadow-md transition-shadow hover:border-theme-primary">
                    <div class="w-14 h-14 bg-theme-primary-soft flex items-center justify-center mb-4">
                        <svg class="w-7 h-7 text-theme-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">{{ $product->name }}</h3>
                    @if($product->description)
                        <p class="text-gray-600 leading-relaxed text-sm">{{ $product->description }}</p>
                    @endif
                    <div class="mt-4 space-y-1 text-sm text-gray-500">
                        @if($product->interest_rate)
                            <div class="flex justify-between"><span>Interest Rate:</span> <span class="font-medium text-gray-900">{{ $product->interest_rate }}%</span></div>
                        @endif
                        @if($product->min_amount && $product->max_amount)
                            <div class="flex justify-between"><span>Amount Range:</span> <span class="font-medium text-gray-900">UGX {{ number_format($product->min_amount) }} - {{ number_format($product->max_amount) }}</span></div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-10">
                    <p class="text-gray-500">No loan products available at the moment. Please check back later.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-16 bg-theme-primary text-theme-primary-contrast text-center">
    <div class="max-w-3xl mx-auto px-4">
        <h2 class="text-3xl font-bold mb-4">See Our Loan Products</h2>
        <p class="text-theme-primary-contrast/80 mb-8">Contact us today to learn more about our loan products and how to apply.</p>
        <a href="{{ route('application') }}" class="inline-block bg-theme-primary-contrast text-theme-primary font-bold px-10 py-3 hover:bg-theme-primary-soft transition-colors">Apply Now</a>
    </div>
</section>

@endsection
