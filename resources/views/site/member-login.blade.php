@extends('layouts.site')

@section('title', 'Member Login')
@section('meta_description', 'Login to your Kasambya SACCO member account to check balances, loans, and transactions.')

@section('content')

<section class="page-header">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1>Member Login</h1>
        <p class="text-theme-primary-contrast mt-2">Access your account to view savings, loans, and transactions.</p>
    </div>
</section>

<section class="py-16 bg-gray-50" data-aos="fade-up">
    <div class="max-w-md mx-auto px-4">
        <div class="bg-white border border-gray-200 p-8">
            <div class="text-center mb-6">
                <svg class="w-16 h-16 text-theme-primary mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                <h2 class="text-xl font-bold text-gray-900 mt-4">Member Portal</h2>
                <p class="text-sm text-gray-600">Sign in with your membership number and date of birth</p>
            </div>

            @if($errors->any())
                <div class="border border-red-200 bg-red-50 p-4 mb-6">
                    <ul class="text-sm text-red-600 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('member.login') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="membership_number" class="site-form-label">Membership Number</label>
                    <input type="text" id="membership_number" name="membership_number" value="{{ old('membership_number') }}" placeholder="Enter your membership number" required class="site-form-input">
                </div>

                <div class="mb-4">
                    <label for="dob" class="site-form-label">Date of Birth</label>
                    <input type="date" id="dob" name="dob" value="{{ old('dob') }}" required class="site-form-input">
                </div>

                <div class="mb-6">
                    <label for="captcha" class="site-form-label">What is {{ $a }} + {{ $b }}?</label>
                    <input type="number" id="captcha" name="captcha" placeholder="Enter the answer" required class="site-form-input">
                </div>

                <button type="submit" class="site-btn-primary w-full text-center">Sign In</button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">Don't have an account?</p>
                <a href="{{ route('application') }}" class="text-theme-primary font-medium text-sm hover:text-theme-primary">Apply for Membership</a>
            </div>
        </div>
    </div>
</section>

@endsection
