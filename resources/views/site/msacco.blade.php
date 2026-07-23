@extends('layouts.site')

@section('title', 'M-SACCO Services')
@section('meta_description', 'M-SACCO mobile banking services for Mubende Employees and Community Sacco Ltd - deposit, loan repayment, and balance check from your mobile phone.')

@section('content')

<section class="page-header">
    <div class="max-w-7xl mx-auto px-4">
        <div class="breadcrumb mb-3">
            <a href="{{ route('home') }}">{{ $orgName }}</a> / M-SACCO Services
        </div>
        <h1>M-SACCO Services</h1>
    </div>
</section>

<section class="py-16 bg-white" data-aos="fade-up">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid md:grid-cols-2 gap-10 items-center mb-16">
            <div data-aos="fade-right">
                @if($page && $page->content)
                    <div class="text-gray-700 leading-relaxed space-y-4">{!! $page->content !!}</div>
                @else
                    <p class="text-gray-700 leading-relaxed">{{ $orgName }} now brings you <strong>MECOSA Merchant Payment</strong>, a simple and secure mobile service that lets members carry out SACCO transactions with ease using their mobile phones.</p>
                @endif
            </div>
            <div class="bg-theme-primary-soft p-10 text-center">
                <div class="text-6xl mb-4">
                    <svg class="w-40 h-40 mx-auto text-theme-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900">MECOSA Merchant Payment</h3>
                <p class="text-gray-600">Mobile banking made simple for every member</p>
            </div>
        </div>

        <!-- What You Can Do -->
        <div class="mb-16" data-aos="fade-up">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">What You Can Do with MECOSA Merchant Payment</h2>
            <div class="grid sm:grid-cols-2 gap-4">
                <div class="border border-gray-200 p-5 flex items-start gap-4">
                    <div class="w-10 h-10 bg-theme-primary-soft flex items-center justify-center flex-shrink-0"><svg class="w-5 h-5 text-theme-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></div>
                    <div><h4 class="font-semibold text-gray-900">Deposit/Savings</h4><p class="text-sm text-gray-600">Deposit directly into your SACCO account using mobile money.</p></div>
                </div>
                <div class="border border-gray-200 p-5 flex items-start gap-4">
                    <div class="w-10 h-10 bg-theme-primary-soft flex items-center justify-center flex-shrink-0"><svg class="w-5 h-5 text-theme-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></div>
                    <div><h4 class="font-semibold text-gray-900">Loan Repayment</h4><p class="text-sm text-gray-600">Repay loans from anywhere without traveling to the SACCO office.</p></div>
                </div>
                <div class="border border-gray-200 p-5 flex items-start gap-4">
                    <div class="w-10 h-10 bg-theme-primary-soft flex items-center justify-center flex-shrink-0"><svg class="w-5 h-5 text-theme-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></div>
                    <div><h4 class="font-semibold text-gray-900">Check Balance</h4><p class="text-sm text-gray-600">Check your account balance instantly at any time.</p></div>
                </div>
                <div class="border border-gray-200 p-5 flex items-start gap-4">
                    <div class="w-10 h-10 bg-theme-primary-soft flex items-center justify-center flex-shrink-0"><svg class="w-5 h-5 text-theme-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></div>
                    <div><h4 class="font-semibold text-gray-900">Transfer Funds</h4><p class="text-sm text-gray-600">Transfer between your SACCO account and mobile money.</p></div>
                </div>
            </div>
        </div>

        <!-- Benefits -->
        <div class="mb-16" data-aos="fade-up">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Why You Should Use M-SACCO</h2>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="border border-gray-200 p-5"><h4 class="font-semibold text-gray-900">Saves Transport Costs</h4><p class="text-sm text-gray-600 mt-1">For members traveling from Nabingoola, Kigando, Mubende and other distant areas.</p></div>
                <div class="border border-gray-200 p-5"><h4 class="font-semibold text-gray-900">Saves Time</h4><p class="text-sm text-gray-600 mt-1">No more queuing at the SACCO office.</p></div>
                <div class="border border-gray-200 p-5"><h4 class="font-semibold text-gray-900">Safe and Secure</h4><p class="text-sm text-gray-600 mt-1">Approved by Microfinance Support Centre and mobile network operators.</p></div>
                <div class="border border-gray-200 p-5"><h4 class="font-semibold text-gray-900">Available 24/7</h4><p class="text-sm text-gray-600 mt-1">Even on weekends and public holidays.</p></div>
                <div class="border border-gray-200 p-5"><h4 class="font-semibold text-gray-900">Convenient</h4><p class="text-sm text-gray-600 mt-1">Perfect for busy members like farmers, business people, and civil servants.</p></div>
            </div>
        </div>

        <!-- How to Register -->
        <div class="bg-gray-50 p-8" data-aos="fade-up">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">How to Use MECOSA Merchant Payment</h2>
            <ol class="list-decimal list-inside text-gray-700 space-y-2">
                <li>Visit {{ $orgName }} office with your National ID, registered mobile number (MTN/Airtel), and SACCO account details.</li>
                <li>For MTN, dial <strong>*165*4*4#</strong> and pay using <strong>MECOSALTD</strong> as the merchant name, then reference your name.</li>
                <li>For Airtel, dial <strong>*185*9#</strong> with <strong>ID 4405074</strong> and reference your name.</li>
                <li>The staff will help you activate your service and guide you through the first transaction.</li>
            </ol>
            <a href="{{ route('application') }}" class="site-btn-primary mt-6 inline-block">Become Member Today</a>
        </div>
    </div>
</section>

<!-- Requirements -->
<section class="py-16 bg-gray-50" data-aos="fade-up">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">Membership Requirements</h2>
        <div class="grid md:grid-cols-3 gap-6">
            <div class="bg-white border border-gray-200 p-6">
                <h4 class="font-semibold text-gray-900 mb-3">Free Savings Account</h4>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex items-baseline gap-2"><span class="text-theme-primary">-</span> UGX 30,000 for account opening</li>
                    <li class="flex items-baseline gap-2"><span class="text-theme-primary">-</span> Passport size photograph and National ID copy</li>
                    <li class="flex items-baseline gap-2"><span class="text-theme-primary">-</span> LC1 recommendation letter</li>
                    <li class="flex items-baseline gap-2"><span class="text-theme-primary">-</span> Ideal for steady, everyday savings</li>
                </ul>
            </div>
            <div class="bg-white border border-gray-200 p-6">
                <h4 class="font-semibold text-gray-900 mb-3">Young Dreamers Account</h4>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex items-baseline gap-2"><span class="text-theme-primary">-</span> UGX 20,000 for account opening</li>
                    <li class="flex items-baseline gap-2"><span class="text-theme-primary">-</span> Passport size photographs</li>
                    <li class="flex items-baseline gap-2"><span class="text-theme-primary">-</span> For children below 18 years</li>
                    <li class="flex items-baseline gap-2"><span class="text-theme-primary">-</span> Managed by parent or guardian</li>
                </ul>
            </div>
            <div class="bg-white border border-gray-200 p-6">
                <h4 class="font-semibold text-gray-900 mb-3">Institutional Membership</h4>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex items-baseline gap-2"><span class="text-theme-primary">-</span> UGX 50,000 for account opening</li>
                    <li class="flex items-baseline gap-2"><span class="text-theme-primary">-</span> Copy of registration certificate</li>
                    <li class="flex items-baseline gap-2"><span class="text-theme-primary">-</span> Minutes for account opening</li>
                    <li class="flex items-baseline gap-2"><span class="text-theme-primary">-</span> List of members and executive</li>
                    <li class="flex items-baseline gap-2"><span class="text-theme-primary">-</span> Passport photos and ID copies for chairperson, secretary and treasurer</li>
                </ul>
            </div>
        </div>
    </div>
</section>

@endsection
