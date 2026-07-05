@extends('layouts.app')

@section('content')

<div class="page-header">
    <div class="max-w-7xl mx-auto px-4">
        <h1>M-SACCO Service</h1>
        <p>Mobile banking at your fingertips</p>
    </div>
</div>

<section class="py-12 bg-black border-t border-zinc-900">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <p class="text-gray-500 text-lg leading-relaxed">M-SACCO is Kasambya SACCO's innovative mobile banking platform that brings financial services directly to your mobile phone. With M-SACCO, you can access your account, check balances, make transactions, apply for loans, and manage your savings anytime, anywhere in Uganda. No more long queues or travel to the branch &mdash; banking is now at your fingertips.</p>
    </div>
</section>

<section class="py-20 bg-black border-t border-zinc-900">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="space-y-6">
                <div class="border border-zinc-800 p-6 hover:border-zinc-600 transition-colors flex gap-4">
                    <div class="w-14 h-14 border border-zinc-700 flex items-center justify-center flex-shrink-0">
                        <svg class="w-7 h-7 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    </div>
                    <div>
                        <h4 class="text-white font-semibold">Convenience</h4>
                        <p class="text-gray-500 text-sm leading-relaxed mt-1">Access your Kasambya SACCO account 24 hours a day, 7 days a week from anywhere in Uganda using your mobile phone.</p>
                    </div>
                </div>
                <div class="border border-zinc-800 p-6 hover:border-zinc-600 transition-colors flex gap-4">
                    <div class="w-14 h-14 border border-zinc-700 flex items-center justify-center flex-shrink-0">
                        <svg class="w-7 h-7 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </div>
                    <div>
                        <h4 class="text-white font-semibold">Time Saving</h4>
                        <p class="text-gray-500 text-sm leading-relaxed mt-1">No more waiting in long queues. Perform transactions instantly with just a few taps on your phone.</p>
                    </div>
                </div>
                <div class="border border-zinc-800 p-6 hover:border-zinc-600 transition-colors flex gap-4">
                    <div class="w-14 h-14 border border-zinc-700 flex items-center justify-center flex-shrink-0">
                        <svg class="w-7 h-7 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <div>
                        <h4 class="text-white font-semibold">Improved Financial Management</h4>
                        <p class="text-gray-500 text-sm leading-relaxed mt-1">Track your savings, monitor your loan balances, view transaction history, and manage your finances in real time.</p>
                    </div>
                </div>
                <div class="border border-zinc-800 p-6 hover:border-zinc-600 transition-colors flex gap-4">
                    <div class="w-14 h-14 border border-zinc-700 flex items-center justify-center flex-shrink-0">
                        <svg class="w-7 h-7 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    </div>
                    <div>
                        <h4 class="text-white font-semibold">Enhanced Security</h4>
                        <p class="text-gray-500 text-sm leading-relaxed mt-1">Your transactions and personal data are protected with industry-standard encryption and security protocols.</p>
                    </div>
                </div>
            </div>
            <div class="flex justify-center">
                <div class="border border-zinc-700 rounded-[40px] p-4 bg-zinc-900 w-[280px]">
                    <div class="rounded-[28px] overflow-hidden bg-black">
                        <div class="bg-zinc-800 text-center text-white text-xs font-semibold tracking-wider py-2">M-SACCO</div>
                        <div class="bg-zinc-800 text-center text-white py-4">
                            <div class="font-extrabold text-base">Kasambya SACCO</div>
                            <div class="text-xs text-gray-400">Mobile Banking</div>
                        </div>
                        <div class="p-4 space-y-2">
                            <div class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-semibold text-gray-300 bg-zinc-900"><span class="w-2 h-2 rounded-full bg-zinc-600"></span>Check Balance</div>
                            <div class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-semibold text-gray-300 bg-zinc-900"><span class="w-2 h-2 rounded-full bg-zinc-600"></span>Send Money</div>
                            <div class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-semibold text-gray-300 bg-zinc-900"><span class="w-2 h-2 rounded-full bg-zinc-600"></span>Loan Application</div>
                            <div class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-semibold text-gray-300 bg-zinc-900"><span class="w-2 h-2 rounded-full bg-zinc-600"></span>Savings Deposit</div>
                            <div class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-semibold text-gray-300 bg-zinc-900"><span class="w-2 h-2 rounded-full bg-zinc-600"></span>Mini Statement</div>
                            <div class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-semibold text-gray-300 bg-zinc-900"><span class="w-2 h-2 rounded-full bg-zinc-600"></span>Change PIN</div>
                        </div>
                        <div class="text-center text-xs text-gray-600 py-2 border-t border-zinc-800">Dial *227# to access</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-black border-t border-zinc-900">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-14">
            <h2 class="text-3xl font-bold text-white">How It Works</h2>
            <p class="text-gray-500 mt-3 text-lg">Getting started with M-SACCO is quick and easy. Follow these simple steps.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="border border-zinc-800 p-6 text-center hover:border-zinc-600 transition-colors">
                <div class="w-12 h-12 border border-zinc-700 rounded-full flex items-center justify-center text-white font-extrabold text-lg mx-auto mb-4">1</div>
                <h4 class="text-white font-semibold mb-2">Register for M-SACCO</h4>
                        <p class="text-gray-500 text-sm leading-relaxed">Visit any Kasambya SACCO branch or contact our customer service to register your mobile number.</p>
            </div>
            <div class="border border-zinc-800 p-6 text-center hover:border-zinc-600 transition-colors">
                <div class="w-12 h-12 border border-zinc-700 rounded-full flex items-center justify-center text-white font-extrabold text-lg mx-auto mb-4">2</div>
                <h4 class="text-white font-semibold mb-2">Set Up Your PIN</h4>
                <p class="text-gray-500 text-sm leading-relaxed">You will receive instructions to set up your secure PIN. Your PIN is confidential &mdash; never share it.</p>
            </div>
            <div class="border border-zinc-800 p-6 text-center hover:border-zinc-600 transition-colors">
                <div class="w-12 h-12 border border-zinc-700 rounded-full flex items-center justify-center text-white font-extrabold text-lg mx-auto mb-4">3</div>
                <h4 class="text-white font-semibold mb-2">Dial the USSD Code</h4>
                <p class="text-gray-500 text-sm leading-relaxed">Dial <strong class="text-gray-300">*227#</strong> on your mobile phone to access the M-SACCO menu and follow the prompts.</p>
            </div>
            <div class="border border-zinc-800 p-6 text-center hover:border-zinc-600 transition-colors">
                <div class="w-12 h-12 border border-zinc-700 rounded-full flex items-center justify-center text-white font-extrabold text-lg mx-auto mb-4">4</div>
                <h4 class="text-white font-semibold mb-2">Start Transacting</h4>
                <p class="text-gray-500 text-sm leading-relaxed">Check balances, send money, apply for loans, and manage your account directly from your phone anytime.</p>
            </div>
        </div>
    </div>
</section>

<section class="py-16 border-t border-zinc-900 bg-black">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">Get Started with M-SACCO Today</h2>
        <p class="text-gray-400 text-xl font-semibold mb-1">Call us today: <a href="tel:+2560775125122" class="text-white hover:text-gray-300">+256 0775 125 122</a></p>
        <p class="text-gray-500 mb-8 text-lg">Register for M-SACCO and enjoy the convenience of mobile banking.</p>
        <a href="{{ route('contact') }}" class="btn-primary text-base px-10 py-3">Contact Us</a>
    </div>
</section>

@endsection
