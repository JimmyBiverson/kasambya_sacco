@extends('layouts.site')

@section('title', 'Application')
@section('meta_description', 'Apply for membership at Mubende Employees and Community Sacco Ltd. Fill out the application form to become a member.')

@section('content')

<section class="page-header">
    <div class="max-w-7xl mx-auto px-4">
        <div class="breadcrumb mb-3">
            <a href="{{ route('home') }}">{{ $orgName }}</a> / Application
        </div>
        <h1>Application</h1>
    </div>
</section>

<section class="py-16 bg-gray-50" data-aos="fade-up">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid lg:grid-cols-5 gap-12">
            <!-- Form -->
            <div class="lg:col-span-3" data-aos="fade-right">
                @if(session('success'))
                    <div class="bg-white border border-theme-primary-light bg-theme-primary-soft p-4 mb-6 flex items-center gap-3 text-theme-primary">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                <div class="bg-white border border-gray-200 p-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Fill in the form</h3>
                    <form action="{{ route('application.submit') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="full_name" class="site-form-label">Full Name <span class="text-red-500">*</span></label>
                            <input type="text" id="full_name" name="full_name" value="{{ old('full_name') }}" placeholder="Your full name" required class="site-form-input">
                            @error('full_name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="mb-4">
                                <label for="email" class="site-form-label">Email <span class="text-red-500">*</span></label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Your email address" required class="site-form-input">
                                @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="mb-4">
                                <label for="phone" class="site-form-label">Phone <span class="text-red-500">*</span></label>
                                <input type="text" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Your phone number" required class="site-form-input">
                                @error('phone') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="address" class="site-form-label">Address</label>
                            <textarea id="address" name="address" placeholder="Your physical address" class="site-form-input min-h-[80px]">{{ old('address') }}</textarea>
                            @error('address') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="mb-4">
                                <label for="date_of_birth" class="site-form-label">Date of Birth</label>
                                <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" class="site-form-input">
                                @error('date_of_birth') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="mb-4">
                                <label for="occupation" class="site-form-label">Occupation</label>
                                <input type="text" id="occupation" name="occupation" value="{{ old('occupation') }}" placeholder="Your occupation" class="site-form-input">
                                @error('occupation') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="employer" class="site-form-label">Employer</label>
                            <input type="text" id="employer" name="employer" value="{{ old('employer') }}" placeholder="Your employer name" class="site-form-input">
                            @error('employer') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="account_type" class="site-form-label">Account Type</label>
                            <select id="account_type" name="account_type" class="site-form-input">
                                <option value="">Select an account type</option>
                                <option value="Share Savings" {{ old('account_type') == 'Share Savings' ? 'selected' : '' }}>Share Savings</option>
                                <option value="Free Savings" {{ old('account_type') == 'Free Savings' ? 'selected' : '' }}>Free Savings</option>
                                <option value="Group Savings" {{ old('account_type') == 'Group Savings' ? 'selected' : '' }}>Group Savings</option>
                                <option value="Fixed Savings" {{ old('account_type') == 'Fixed Savings' ? 'selected' : '' }}>Fixed Savings</option>
                                <option value="Young Dreamers" {{ old('account_type') == 'Young Dreamers' ? 'selected' : '' }}>Young Dreamers</option>
                                <option value="Individual Account" {{ old('account_type') == 'Individual Account' ? 'selected' : '' }}>Individual Account</option>
                                <option value="Joint Account" {{ old('account_type') == 'Joint Account' ? 'selected' : '' }}>Joint Account</option>
                                <option value="Group Account" {{ old('account_type') == 'Group Account' ? 'selected' : '' }}>Group Account</option>
                                <option value="Institutional Account" {{ old('account_type') == 'Institutional Account' ? 'selected' : '' }}>Institutional Account</option>
                                <option value="Associate Account" {{ old('account_type') == 'Associate Account' ? 'selected' : '' }}>Associate Account (UGX 20,000)</option>
                            </select>
                            @error('account_type') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Next of Kin Section -->
                        <div class="border-t border-gray-200 pt-6 mt-6 mb-4">
                            <h4 class="font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-theme-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                Next of Kin Details <span class="text-red-500">*</span>
                            </h4>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="mb-4">
                                    <label for="next_of_kin_name" class="site-form-label">Next of Kin Name <span class="text-red-500">*</span></label>
                                    <input type="text" id="next_of_kin_name" name="next_of_kin_name" value="{{ old('next_of_kin_name') }}" placeholder="Full name of next of kin" required class="site-form-input">
                                    @error('next_of_kin_name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="next_of_kin_contact" class="site-form-label">Next of Kin Contact <span class="text-red-500">*</span></label>
                                    <input type="text" id="next_of_kin_contact" name="next_of_kin_contact" value="{{ old('next_of_kin_contact') }}" placeholder="Phone number of next of kin" required class="site-form-input">
                                    @error('next_of_kin_contact') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="next_of_kin_relationship" class="site-form-label">Relationship <span class="text-red-500">*</span></label>
                                <select id="next_of_kin_relationship" name="next_of_kin_relationship" required class="site-form-input">
                                    <option value="">Select relationship</option>
                                    <option value="Son" {{ old('next_of_kin_relationship') == 'Son' ? 'selected' : '' }}>Son</option>
                                    <option value="Daughter" {{ old('next_of_kin_relationship') == 'Daughter' ? 'selected' : '' }}>Daughter</option>
                                    <option value="Wife" {{ old('next_of_kin_relationship') == 'Wife' ? 'selected' : '' }}>Wife</option>
                                    <option value="Husband" {{ old('next_of_kin_relationship') == 'Husband' ? 'selected' : '' }}>Husband</option>
                                    <option value="Brother" {{ old('next_of_kin_relationship') == 'Brother' ? 'selected' : '' }}>Brother</option>
                                    <option value="Father" {{ old('next_of_kin_relationship') == 'Father' ? 'selected' : '' }}>Father</option>
                                    <option value="Mother" {{ old('next_of_kin_relationship') == 'Mother' ? 'selected' : '' }}>Mother</option>
                                    <option value="Uncle" {{ old('next_of_kin_relationship') == 'Uncle' ? 'selected' : '' }}>Uncle</option>
                                    <option value="Auntie" {{ old('next_of_kin_relationship') == 'Auntie' ? 'selected' : '' }}>Auntie</option>
                                    <option value="Others" {{ old('next_of_kin_relationship') == 'Others' ? 'selected' : '' }}>Others</option>
                                </select>
                                @error('next_of_kin_relationship') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="message" class="site-form-label">Additional Message</label>
                            <textarea id="message" name="message" placeholder="Any additional information or message" class="site-form-input min-h-[80px]">{{ old('message') }}</textarea>
                            @error('message') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <button type="submit" class="site-btn-primary w-full text-center">Submit Application</button>
                    </form>
                </div>
            </div>

            <!-- Requirements Sidebar -->
            <div class="lg:col-span-2" data-aos="fade-left">
                <h3 class="text-xl font-bold text-gray-900 mb-6 border-b border-gray-200 pb-3">Membership Requirements</h3>

                <div class="border border-gray-200 p-6 mb-4">
                    <h4 class="font-semibold text-gray-900 mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-theme-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Free Savings Account
                    </h4>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-baseline gap-2"><span class="text-gray-400">-</span> UGX 30,000 opening deposit</li>
                        <li class="flex items-baseline gap-2"><span class="text-gray-400">-</span> Passport photo and national ID</li>
                        <li class="flex items-baseline gap-2"><span class="text-gray-400">-</span> LC1 recommendation letter</li>
                        <li class="flex items-baseline gap-2"><span class="text-gray-400">-</span> Perfect for everyday savings</li>
                    </ul>
                </div>

                <div class="border border-gray-200 p-6 mb-4">
                    <h4 class="font-semibold text-gray-900 mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-theme-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        Young Dreamers Account
                    </h4>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-baseline gap-2"><span class="text-gray-400">-</span> UGX 20,000 opening deposit</li>
                        <li class="flex items-baseline gap-2"><span class="text-gray-400">-</span> Passport photos for the child</li>
                        <li class="flex items-baseline gap-2"><span class="text-gray-400">-</span> Parent or guardian must accompany the applicant</li>
                        <li class="flex items-baseline gap-2"><span class="text-gray-400">-</span> Built for young members planning ahead</li>
                    </ul>
                </div>

                <div class="border border-gray-200 p-6 mb-4">
                    <h4 class="font-semibold text-gray-900 mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-theme-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0H5m14 0l-2-2m-10 2l2-2"/></svg>
                        Institutional Membership
                    </h4>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-baseline gap-2"><span class="text-gray-400">-</span> UGX 50,000 opening deposit</li>
                        <li class="flex items-baseline gap-2"><span class="text-gray-400">-</span> Copy of registration certificate</li>
                        <li class="flex items-baseline gap-2"><span class="text-gray-400">-</span> Minutes for account opening</li>
                        <li class="flex items-baseline gap-2"><span class="text-gray-400">-</span> List of members and executive</li>
                        <li class="flex items-baseline gap-2"><span class="text-gray-400">-</span> Passport photos and ID copies for chairperson, secretary and treasurer</li>
                    </ul>
                </div>

                <div class="border border-gray-200 p-6 mb-4">
                    <h4 class="font-semibold text-gray-900 mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-theme-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        Associate Membership
                    </h4>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-baseline gap-2"><span class="text-gray-400">-</span> UGX 20,000 minimum deposit</li>
                        <li class="flex items-baseline gap-2"><span class="text-gray-400">-</span> National ID copy</li>
                        <li class="flex items-baseline gap-2"><span class="text-gray-400">-</span> Passport photos</li>
                        <li class="flex items-baseline gap-2"><span class="text-gray-400">-</span> LC1 recommendation letter</li>
                    </ul>
                </div>

                <!-- MECOSA Merchant Pay Info -->
                <div class="border border-gray-200 p-6">
                    <h4 class="font-semibold text-gray-900 mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-theme-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                        MECOSA Merchant Pay Services
                    </h4>
                    <p class="text-sm text-gray-600">Make convenient payments via MTN Mobile Money and Airtel Money through our merchant payment platform.</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
