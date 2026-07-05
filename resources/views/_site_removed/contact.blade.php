@extends('layouts.app')

@section('title', 'Contact')
@section('meta_description', 'Contact Kasambya SACCO for inquiries about membership, savings, loans, and support.')

@section('content')

<section class="relative overflow-hidden bg-gradient-to-r from-emerald-700 to-emerald-500 text-white">
    <div class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_top,_rgba(255,255,255,0.2),_transparent_55%)]"></div>
    <div class="relative max-w-7xl mx-auto px-4 py-24 grid lg:grid-cols-2 gap-12 items-center">
        <div class="space-y-6">
            <p class="text-sm uppercase tracking-[0.32em] text-emerald-200">Contact Kasambya SACCO</p>
            <h1 class="text-5xl md:text-6xl font-extrabold">We’re here to help members every step of the way.</h1>
            <p class="max-w-2xl text-lg text-emerald-100 leading-relaxed">Reach out for membership support, loan inquiries, or any questions about our savings products and services.</p>
            <div class="space-y-3 sm:space-y-0 sm:flex sm:items-center sm:gap-4">
                <a href="tel:+2560775125122" class="btn-primary">Call Us</a>
                <a href="mailto:{{ $settings->get('org_email')->value ?? 'info@kasambyasacco.com' }}" class="inline-flex items-center justify-center border border-white/20 text-white hover:border-white hover:bg-white/10 rounded-full px-6 py-3 transition">Email Us</a>
            </div>
        </div>
        <div class="grid gap-5 sm:grid-cols-2">
            <div class="rounded-[2rem] overflow-hidden shadow-2xl bg-white">
                <img src="{{ asset('images/contact-1.jpg') }}" alt="Contact support" class="w-full h-full object-cover">
            </div>
            <div class="rounded-[2rem] overflow-hidden shadow-2xl bg-white">
                <img src="{{ asset('images/contact-2.jpg') }}" alt="Kasambya SACCO branch" class="w-full h-full object-cover">
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 grid gap-12 lg:grid-cols-2">
        <div class="rounded-[2rem] bg-white p-10 shadow-sm border border-slate-200">
            @if(session('success'))
                <div class="rounded-3xl border border-emerald-100 bg-emerald-50 p-6 mb-6 text-emerald-700">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Your full name" required class="form-input bg-slate-100 text-slate-900">
                    @error('name') <small class="text-red-500 text-sm">{{ $message }}</small> @enderror
                </div>

                <div>
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Your email address" required class="form-input bg-slate-100 text-slate-900">
                    @error('email') <small class="text-red-500 text-sm">{{ $message }}</small> @enderror
                </div>

                <div>
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Your phone number" required class="form-input bg-slate-100 text-slate-900">
                    @error('phone') <small class="text-red-500 text-sm">{{ $message }}</small> @enderror
                </div>

                <div>
                    <label for="subject" class="form-label">Subject</label>
                    <input type="text" id="subject" name="subject" value="{{ old('subject') }}" placeholder="Subject of your message" required class="form-input bg-slate-100 text-slate-900">
                    @error('subject') <small class="text-red-500 text-sm">{{ $message }}</small> @enderror
                </div>

                <div>
                    <label for="message" class="form-label">Message</label>
                    <textarea id="message" name="message" placeholder="Write your message here..." required class="form-input min-h-[160px] bg-slate-100 text-slate-900">{{ old('message') }}</textarea>
                    @error('message') <small class="text-red-500 text-sm">{{ $message }}</small> @enderror
                </div>

                <button type="submit" class="btn-primary w-full text-center">Send Message</button>
            </form>
        </div>

        <div class="space-y-6">
            <div class="rounded-[2rem] bg-white p-8 shadow-sm border border-slate-200">
                <h3 class="text-xl font-semibold text-slate-900">Office Location</h3>
                <p class="mt-3 text-slate-600">Kasambya Town, Uganda</p>
            </div>
            <div class="rounded-[2rem] bg-white p-8 shadow-sm border border-slate-200">
                <h3 class="text-xl font-semibold text-slate-900">Phone</h3>
                <p class="mt-3 text-slate-600">0775 125 122 / 0779 892 660</p>
            </div>
            <div class="rounded-[2rem] bg-white p-8 shadow-sm border border-slate-200">
                <h3 class="text-xl font-semibold text-slate-900">Email</h3>
                <p class="mt-3 text-slate-600">{{ $settings->get('org_email')->value ?? 'info@kasambyasacco.com' }}</p>
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-slate-900">Still have questions?</h2>
        <p class="mt-4 text-lg text-slate-600">Reach out and we’ll help you get started with the right membership and savings plan.</p>
        <a href="{{ route('application') }}" class="btn-primary mt-8 inline-block">Apply Now</a>
    </div>
</section>

@endsection
