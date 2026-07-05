@extends('layouts.app')

@section('content')

<div class="page-header">
    <div class="max-w-7xl mx-auto px-4">
        <h1>Message from the Manager</h1>
        <p>A word from our SACCO Manager</p>
    </div>
</div>

<div class="border-b border-zinc-900 bg-black">
    <div class="max-w-7xl mx-auto px-4 py-3 flex items-center gap-2 text-sm text-gray-500">
        <a href="{{ url('/') }}" class="text-gray-400 hover:text-white transition-colors">Home</a>
        <span class="text-zinc-700">/</span>
        <span>Kasambya SACCO</span>
        <span class="text-zinc-700">/</span>
        <span class="text-white font-semibold">Message from the Manager</span>
    </div>
</div>

<section class="py-16 bg-black">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-[auto_1fr] gap-12 items-start">
            <div class="w-64 flex-shrink-0 mx-auto lg:mx-0">
                <div class="w-64 h-64 rounded-full border-4 border-zinc-700 flex flex-col items-center justify-center text-gray-400 bg-zinc-900/50 mx-auto">
                    <div class="text-5xl font-extrabold text-gray-500">BB</div>
                    <div class="text-sm text-gray-600 mt-2">SACCO Manager</div>
                </div>
                <h3 class="text-white font-bold text-center mt-6">Byamukama Bernard</h3>
                <div class="text-gray-500 text-sm text-center font-semibold">SACCO Manager</div>
            </div>
            <div>
                <h2 class="text-3xl font-bold text-white mb-2">Welcome to <span class="text-gray-300">Kasambya SACCO</span></h2>
                <p class="text-gray-500 italic mb-8">A message of commitment, growth, and transparency</p>

                <div class="space-y-5 text-gray-400 leading-relaxed text-base">
                    <p>Dear Esteemed Members and Prospective Members,</p>

                    <p>It is with great pleasure and a deep sense of responsibility that I welcome you to Kasambya SACCO. Since our establishment in 1999, we have remained steadfast in our commitment to providing accessible, affordable, and reliable financial services to our members. Our journey has been one of growth, resilience, and unwavering dedication to the communities we serve.</p>

                    <p>At Kasambya SACCO, our members are at the heart of everything we do. We believe that financial inclusion is a powerful tool for transformation, and we are committed to ensuring that every member has access to the resources they need to achieve their financial goals. Whether you are saving for the future, seeking affordable credit for a business venture, or planning for your children's education, we are here to support you every step of the way.</p>

                    <p><strong class="text-gray-300">Transparency and accountability</strong> are the cornerstones of our operations. We believe that our members have the right to know how their funds are being managed, which is why we maintain open communication channels and provide regular financial reports. Our Board of Directors and management team are committed to upholding the highest standards of governance and ethical conduct.</p>

                    <p>We have also embraced technology to enhance our service delivery. Through our M-SACCO mobile banking platform, members can now access their accounts, make inquiries, and transact from the comfort of their homes. This is part of our commitment to innovation and improving the member experience.</p>

                    <p>As we look to the future, we are excited about the opportunities ahead. We will continue to expand our product offerings, strengthen our financial position, and find new ways to add value to our members. Your trust is our greatest asset, and we will work tirelessly to deserve it every single day.</p>

                    <p>I invite you to explore our website to learn more about our products and services. If you are not yet a member, I encourage you to join us and experience the Kasambya SACCO difference. Together, we can build a brighter financial future.</p>

                    <p>Thank you for your continued support and trust in Kasambya SACCO.</p>

                    <div class="pt-6 mt-6 border-t border-zinc-800">
                        <div class="text-white font-bold text-lg">Byamukama Bernard</div>
                        <div class="text-gray-500 text-sm font-semibold">SACCO Manager, Kasambya SACCO</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-20 border-t border-zinc-900 bg-black">
    <div class="max-w-4xl mx-auto px-4">
        <div class="text-center mb-14">
            <h2 class="text-3xl font-bold text-white">Our Commitment to You</h2>
            <p class="text-gray-500 mt-3 text-lg">The principles that guide our leadership and service</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="border border-zinc-800 p-6 text-center hover:border-zinc-600 transition-colors">
                <div class="w-14 h-14 border border-zinc-700 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                <h4 class="text-white font-semibold mb-2">Transparency</h4>
                <p class="text-gray-500 text-sm leading-relaxed">Open and honest communication about our operations, finances, and decisions affecting members.</p>
            </div>
            <div class="border border-zinc-800 p-6 text-center hover:border-zinc-600 transition-colors">
                <div class="w-14 h-14 border border-zinc-700 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                <h4 class="text-white font-semibold mb-2">Integrity</h4>
                <p class="text-gray-500 text-sm leading-relaxed">Upholding the highest ethical standards in all our dealings with members and stakeholders.</p>
            </div>
            <div class="border border-zinc-800 p-6 text-center hover:border-zinc-600 transition-colors">
                <div class="w-14 h-14 border border-zinc-700 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <h4 class="text-white font-semibold mb-2">Member Focus</h4>
                <p class="text-gray-500 text-sm leading-relaxed">Putting our members first in every decision, product, and service we offer.</p>
            </div>
            <div class="border border-zinc-800 p-6 text-center hover:border-zinc-600 transition-colors">
                <div class="w-14 h-14 border border-zinc-700 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                </div>
                <h4 class="text-white font-semibold mb-2">Excellence</h4>
                <p class="text-gray-500 text-sm leading-relaxed">Striving for the highest quality in service delivery and operational efficiency.</p>
            </div>
        </div>
    </div>
</section>

<section class="py-16 border-t border-zinc-900 bg-black">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h3 class="text-2xl font-bold text-white mb-3">Have Questions or Need Assistance?</h3>
        <p class="text-gray-500 text-lg mb-8">We are here to help you with all your financial needs.</p>
        <a href="{{ route('contact') }}" class="btn-primary text-base px-10 py-3">Contact Us Today</a>
    </div>
</section>

@endsection
