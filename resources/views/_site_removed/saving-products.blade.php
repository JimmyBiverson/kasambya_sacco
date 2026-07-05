@extends('layouts.app')

@section('content')

<div class="page-header">
    <div class="max-w-7xl mx-auto px-4">
        <h1>Saving Products</h1>
        <p>Explore our range of saving products</p>
    </div>
</div>

<section class="py-20 bg-black border-t border-zinc-900">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="border border-zinc-800 p-6 hover:border-zinc-600 transition-colors">
                <div class="text-3xl mb-4">🏦</div>
                <h3 class="text-white font-semibold text-lg mb-3">Regular Savings Account</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Build your savings with our standard savings account. Deposit any amount at any time and earn competitive interest on your savings.</p>
            </div>
            <div class="border border-zinc-800 p-6 hover:border-zinc-600 transition-colors">
                <div class="text-3xl mb-4">⭐</div>
                <h3 class="text-white font-semibold text-lg mb-3">Fixed Deposit Account</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Lock in your savings for a fixed period and earn higher interest rates. Choose from 6, 12, or 24-month deposit terms.</p>
            </div>
            <div class="border border-zinc-800 p-6 hover:border-zinc-600 transition-colors">
                <div class="text-3xl mb-4">👶</div>
                <h3 class="text-white font-semibold text-lg mb-3">Children's Savings Account</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Start saving for your child's future today. A dedicated account designed to help parents save for their children's education and other needs.</p>
            </div>
            <div class="border border-zinc-800 p-6 hover:border-zinc-600 transition-colors">
                <div class="text-3xl mb-4">🌿</div>
                <h3 class="text-white font-semibold text-lg mb-3">Group Savings Account</h3>
                <p class="text-gray-500 text-sm leading-relaxed">For community groups, VSLA groups, and associations. Pool your savings together and access group loan facilities with favorable terms.</p>
            </div>
            <div class="border border-zinc-800 p-6 hover:border-zinc-600 transition-colors">
                <div class="text-3xl mb-4">🎯</div>
                <h3 class="text-white font-semibold text-lg mb-3">Target Savings Plan</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Set a savings goal and work towards it with discipline. Perfect for saving towards specific goals like school fees, land purchase, or business capital.</p>
            </div>
            <div class="border border-zinc-800 p-6 hover:border-zinc-600 transition-colors">
                <div class="text-3xl mb-4">💎</div>
                <h3 class="text-white font-semibold text-lg mb-3">Voluntary Savings</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Flexible voluntary savings account where you can deposit and withdraw as needed. Minimum balance required to keep the account active.</p>
            </div>
        </div>
    </div>
</section>

<section class="py-16 border-t border-zinc-900 bg-black">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">Start Saving Today</h2>
        <p class="text-gray-500 text-lg mb-8">Visit our <a href="{{ route('services') }}" class="text-gray-300 hover:text-white underline">Services</a> page to learn more about our saving products or contact us to get started.</p>
        <a href="{{ route('application') }}" class="btn-primary text-base px-10 py-3">Become a Member</a>
    </div>
</section>

@endsection
