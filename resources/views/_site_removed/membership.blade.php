@extends('layouts.app')

@section('content')

<div class="page-header">
    <div class="max-w-7xl mx-auto px-4">
        <h1>Membership</h1>
        <p>Join Kasambya SACCO today</p>
    </div>
</div>

<section class="py-20 bg-black border-t border-zinc-900">
    <div class="max-w-7xl mx-auto px-4">
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="text-3xl font-bold text-white mb-6">Become a Member</h2>
            <p class="text-gray-500 text-lg leading-relaxed mb-8">Joining Kasambya SACCO is your gateway to affordable financial services, savings growth, and community empowerment. As a member, you gain access to competitive loan products, flexible savings accounts, and a supportive financial community.</p>
            <a href="{{ route('application') }}" class="btn-primary text-base px-10 py-3">Apply Now</a>
        </div>
    </div>
</section>

<section class="py-20 bg-black border-t border-zinc-900">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-14">
            <h2 class="text-3xl font-bold text-white">Membership Requirements</h2>
            <p class="text-gray-500 mt-3 text-lg">What you need to become a member</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="border border-zinc-800 p-6 text-center hover:border-zinc-600 transition-colors">
                <div class="text-3xl mb-4">📋</div>
                <h3 class="text-white font-semibold text-lg mb-3">Application Form</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Complete a membership application form available at our offices or online.</p>
            </div>
            <div class="border border-zinc-800 p-6 text-center hover:border-zinc-600 transition-colors">
                <div class="text-3xl mb-4">🪪</div>
                <h3 class="text-white font-semibold text-lg mb-3">Valid ID</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Provide a valid national ID, passport, or other government-issued identification.</p>
            </div>
            <div class="border border-zinc-800 p-6 text-center hover:border-zinc-600 transition-colors">
                <div class="text-3xl mb-4">💰</div>
                <h3 class="text-white font-semibold text-lg mb-3">Registration Fee</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Pay the required membership registration fee and minimum share capital deposit.</p>
            </div>
        </div>
    </div>
</section>

<section class="py-16 border-t border-zinc-900 bg-black">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <p class="text-gray-500 text-lg">Ready to become a member? <a href="{{ route('application') }}" class="text-gray-300 hover:text-white underline">Apply now</a> or visit our offices.</p>
    </div>
</section>

@endsection
