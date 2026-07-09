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
                    <p class="text-gray-700 leading-relaxed">{{ $orgName }} would like to inform all members about the availability of <strong>M-SACCO Mobile Banking Services</strong>, a convenient digital platform that allows you to carry out SACCO transactions easily and securely using your mobile phone.</p>
                @endif
            </div>
            <div class="bg-theme-primary-soft p-10 text-center">
                <div class="text-6xl mb-4">
                    <svg class="w-40 h-40 mx-auto text-theme-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900">M-SACCO</h3>
                <p class="text-gray-600">Mobile Banking at Your Fingertips</p>
            </div>
        </div>

        <!-- What You Can Do -->
        <div class="mb-16" data-aos="fade-up">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">What You Can Do with M-SACCO</h2>
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
            <h2 class="text-2xl font-bold text-gray-900 mb-4">How to Register for M-SACCO</h2>
            <ol class="list-decimal list-inside text-gray-700 space-y-2">
                <li>Visit {{ $orgName }} office with your National ID, registered mobile number (MTN/Airtel), and SACCO account details.</li>
                <li>The staff will help you activate your M-SACCO mobile banking service within minutes.</li>
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
                <h4 class="font-semibold text-gray-900 mb-3">Voluntary Savings Account</h4>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex items-baseline gap-2"><span class="text-theme-primary">-</span> UGX 60,000 for account opening</li>
                    <li class="flex items-baseline gap-2"><span class="text-theme-primary">-</span> Three passport size photographs</li>
                    <li class="flex items-baseline gap-2"><span class="text-theme-primary">-</span> Photocopy of National ID</li>
                    <li class="flex items-baseline gap-2"><span class="text-theme-primary">-</span> LC1 Chairperson's letter</li>
                </ul>
            </div>
            <div class="bg-white border border-gray-200 p-6">
                <h4 class="font-semibold text-gray-900 mb-3">Minor Account</h4>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex items-baseline gap-2"><span class="text-theme-primary">-</span> UGX 20,000 for account opening</li>
                    <li class="flex items-baseline gap-2"><span class="text-theme-primary">-</span> Passport size photographs</li>
                    <li class="flex items-baseline gap-2"><span class="text-theme-primary">-</span> For children below 18 years</li>
                    <li class="flex items-baseline gap-2"><span class="text-theme-primary">-</span> Managed by parent or guardian</li>
                </ul>
            </div>
            <div class="bg-white border border-gray-200 p-6">
                <h4 class="font-semibold text-gray-900 mb-3">Associate Account</h4>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex items-baseline gap-2"><span class="text-theme-primary">-</span> UGX 30,000 for account opening</li>
                    <li class="flex items-baseline gap-2"><span class="text-theme-primary">-</span> Photocopy of National ID</li>
                    <li class="flex items-baseline gap-2"><span class="text-theme-primary">-</span> Passport size photographs</li>
                    <li class="flex items-baseline gap-2"><span class="text-theme-primary">-</span> LC1 Chairperson's letter</li>
                </ul>
            </div>
        </div>
    </div>
</section>

@endsection
