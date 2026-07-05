@extends('layouts.member')

@section('title', 'M-SACCO Mobile')
@section('page_title', 'M-SACCO Mobile')

@section('content')

<section class="bg-gradient-to-br from-emerald-900 to-emerald-950 text-white relative overflow-hidden">
    <div class="absolute -right-24 -top-24 w-96 h-96 bg-emerald-800/15 rounded-full blur-3xl"></div>
    <div class="absolute -left-20 -bottom-20 w-96 h-96 bg-green-900/10 rounded-full blur-3xl"></div>
    <div class="px-4 lg:px-8 py-8 relative z-10">
        <div>
            <h1 class="text-2xl md:text-3xl font-black tracking-tight text-white">M-SACCO Mobile Banking</h1>
            <p class="text-emerald-100/70 text-sm mt-1">Access SACCO services from your mobile phone</p>
        </div>
    </div>
</section>

<section class="py-8 bg-slate-50 dark:bg-slate-900">
    <div class="px-4 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">

            <div class="bg-white dark:bg-slate-800 rounded-2xl lg:rounded-3xl border border-slate-200 dark:border-slate-700/60 p-6 lg:p-8 shadow-sm">
                <h2 class="text-xl lg:text-2xl font-bold text-slate-900 dark:text-white mb-4">What You Can Do</h2>
                <div class="space-y-4">
                    <div class="flex items-start gap-3 lg:gap-4 p-3 lg:p-4 bg-emerald-50 dark:bg-emerald-950 rounded-xl border border-emerald-100 dark:border-emerald-800">
                        <div class="w-9 h-9 lg:w-10 lg:h-10 bg-emerald-100 dark:bg-emerald-900 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 lg:w-5 lg:h-5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-slate-900 dark:text-white text-sm lg:text-base">Deposit / Savings</h4>
                            <p class="text-xs lg:text-sm text-slate-600 dark:text-slate-400">Deposit directly into your SACCO account using mobile money.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 lg:gap-4 p-3 lg:p-4 bg-blue-50 dark:bg-blue-950 rounded-xl border border-blue-100 dark:border-blue-800">
                        <div class="w-9 h-9 lg:w-10 lg:h-10 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 lg:w-5 lg:h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-slate-900 dark:text-white text-sm lg:text-base">Loan Repayment</h4>
                            <p class="text-xs lg:text-sm text-slate-600 dark:text-slate-400">Repay loans from anywhere without traveling to the office.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 lg:gap-4 p-3 lg:p-4 bg-purple-50 dark:bg-purple-950 rounded-xl border border-purple-100 dark:border-purple-800">
                        <div class="w-9 h-9 lg:w-10 lg:h-10 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 lg:w-5 lg:h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-slate-900 dark:text-white text-sm lg:text-base">Check Balance</h4>
                            <p class="text-xs lg:text-sm text-slate-600 dark:text-slate-400">Check your account balance instantly at any time.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 lg:gap-4 p-3 lg:p-4 bg-amber-50 dark:bg-amber-950 rounded-xl border border-amber-100 dark:border-amber-800">
                        <div class="w-9 h-9 lg:w-10 lg:h-10 bg-amber-100 dark:bg-amber-900 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 lg:w-5 lg:h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-slate-900 dark:text-white text-sm lg:text-base">Transfer Funds</h4>
                            <p class="text-xs lg:text-sm text-slate-600 dark:text-slate-400">Between your SACCO account and mobile money.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-800 rounded-2xl lg:rounded-3xl border border-slate-200 dark:border-slate-700/60 p-6 lg:p-8 shadow-sm">
                <h2 class="text-xl lg:text-2xl font-bold text-slate-900 dark:text-white mb-4">Benefits</h2>
                <div class="space-y-3">
                    <div class="p-3 lg:p-4 bg-slate-50 dark:bg-slate-900 rounded-xl border border-slate-100 dark:border-slate-700">
                        <h4 class="font-semibold text-slate-900 dark:text-white text-sm lg:text-base">Saves Transport Costs</h4>
                        <p class="text-xs lg:text-sm text-slate-600 dark:text-slate-400 mt-1">For members traveling from Nabingoola, Kigando, Mubende and other distant areas.</p>
                    </div>
                    <div class="p-3 lg:p-4 bg-slate-50 dark:bg-slate-900 rounded-xl border border-slate-100 dark:border-slate-700">
                        <h4 class="font-semibold text-slate-900 dark:text-white text-sm lg:text-base">Saves Time</h4>
                        <p class="text-xs lg:text-sm text-slate-600 dark:text-slate-400 mt-1">No more queuing at the SACCO office.</p>
                    </div>
                    <div class="p-3 lg:p-4 bg-slate-50 dark:bg-slate-900 rounded-xl border border-slate-100 dark:border-slate-700">
                        <h4 class="font-semibold text-slate-900 dark:text-white text-sm lg:text-base">Safe and Secure</h4>
                        <p class="text-xs lg:text-sm text-slate-600 dark:text-slate-400 mt-1">Approved by Microfinance Support Centre and mobile network operators.</p>
                    </div>
                    <div class="p-3 lg:p-4 bg-slate-50 dark:bg-slate-900 rounded-xl border border-slate-100 dark:border-slate-700">
                        <h4 class="font-semibold text-slate-900 dark:text-white text-sm lg:text-base">Available 24/7</h4>
                        <p class="text-xs lg:text-sm text-slate-600 dark:text-slate-400 mt-1">Even on weekends and public holidays.</p>
                    </div>
                    <div class="p-3 lg:p-4 bg-slate-50 dark:bg-slate-900 rounded-xl border border-slate-100 dark:border-slate-700">
                        <h4 class="font-semibold text-slate-900 dark:text-white text-sm lg:text-base">Convenient</h4>
                        <p class="text-xs lg:text-sm text-slate-600 dark:text-slate-400 mt-1">Perfect for farmers, business people, and civil servants.</p>
                    </div>
                </div>

                <div class="mt-6 bg-emerald-50 dark:bg-emerald-950 rounded-xl border border-emerald-200 dark:border-emerald-800 p-4">
                    <h3 class="font-bold text-emerald-800 dark:text-emerald-300 text-sm">How to Register</h3>
                    <ol class="mt-2 space-y-1 text-xs text-emerald-700 dark:text-emerald-400 list-decimal list-inside">
                        <li>Visit Kasambya SACCO office with your National ID and registered mobile number (MTN/Airtel).</li>
                        <li>The staff will help you activate your M-SACCO mobile banking service within minutes.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection