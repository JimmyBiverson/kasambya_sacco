@extends('layouts.site')

@section('title', 'About Us')
@section('meta_description', 'Learn more about Mubende Employees and Community Sacco Ltd - our vision, mission, core values, and management team.')

@section('content')

<!-- Page Header -->
<section class="page-header">
    <div class="max-w-7xl mx-auto px-4">
        <div class="breadcrumb mb-3">
            <a href="{{ route('home') }}">{{ $orgName }}</a> / About Us
        </div>
        <h1>About Us</h1>
    </div>
</section>

<!-- Content -->
<section class="py-16 bg-white" data-aos="fade-up">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid md:grid-cols-2 gap-10 items-start">
            <div data-aos="fade-right">
                <img src="{{ asset('images/uploaded/member_active.jpg') }}" alt="About Mubende Employees and Community Sacco Ltd" class="w-full">
            </div>
            <div>
                @if($page && $page->content)
                    <div class="text-gray-700 leading-relaxed space-y-4">{!! $page->content !!}</div>
                @else
                    <p class="text-gray-700 leading-relaxed">Mubende Employees and Community Sacco Ltd is a cooperative financial institution providing financial services to people in the Mubende region and beyond.</p>
                    <p class="text-gray-700 leading-relaxed mt-4">Established as MECOSA in 1999 and proudly registered as <strong>RCS 6323</strong>, we now serve greater Mubende districts (Kassanda, Mityana, Mubende, Kakumiro, Kiboga, and Kyegegwa) with over 5,000 members both in public service and the community, offering a secure way to save, buy shares, and access loans for business, farming, livestock, and education.</p>
                @endif
                <a href="{{ route('history') }}" class="site-btn-primary mt-6 inline-block">Read our History</a>
            </div>
        </div>
    </div>
</section>

<!-- Vision / Mission / Core Values -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid sm:grid-cols-3 gap-6">
            <div class="bg-white border border-gray-200 p-8 text-center">
                <div class="w-14 h-14 bg-theme-primary-soft flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-theme-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </div>
                <h3 class="font-bold text-gray-900 mb-3">Our Vision</h3>
                <p class="text-gray-600 text-sm leading-relaxed">A financially sound and sustainable sacco , serving to uplift the social and economical well being of its members.</p>
            </div>
            <div class="bg-white border border-gray-200 p-8 text-center">
                <div class="w-14 h-14 bg-theme-primary-soft flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-theme-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <h3 class="font-bold text-gray-900 mb-3">Our Mission</h3>
                <p class="text-gray-600 text-sm leading-relaxed">To timely meet the financial needs of members through the provision of safe , secure and cheaper financial services.</p>
            </div>
            <div class="bg-white border border-gray-200 p-8 text-center">
                <div class="w-14 h-14 bg-theme-primary-soft flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-theme-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <h3 class="font-bold text-gray-900 mb-3">Core Values</h3>
                <p class="text-gray-600 text-sm leading-relaxed">Self reliance, Excellence, Reliability, Involving, Openness, Unity, Smartness.</p>
            </div>
        </div>
    </div>
</section>

<!-- Stats -->
@php
    $establishedYear = intval($settings_values['org_established_year'] ?? 1999);
    $yearsExp = max(1, date('Y') - $establishedYear);
@endphp
<section class="py-16 bg-theme-primary text-theme-primary-contrast">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div><div class="text-4xl md:text-5xl font-bold mb-2">50+</div><div class="text-theme-primary-contrast/80">Professional Staff</div></div>
            <div><div class="text-4xl md:text-5xl font-bold mb-2">6</div><div class="text-theme-primary-contrast/80">Districts Served</div></div>
            <div><div class="text-4xl md:text-5xl font-bold mb-2">{{ $yearsExp }}+</div><div class="text-theme-primary-contrast/80">Years of Experience</div></div>
            <div><div class="text-4xl md:text-5xl font-bold mb-2">5K+</div><div class="text-theme-primary-contrast/80">Satisfied Members</div></div>
        </div>
    </div>
</section>

<!-- Management Team -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <p class="text-sm uppercase tracking-widest text-theme-primary font-semibold">Our Team</p>
            <h2 class="section-heading mt-3">Management Staff</h2>
            <p class="section-subheading mx-auto">The Management Staff are responsible for the daily administration and service delivery of the SACCO.</p>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($teamMembers as $member)
                <div class="border border-gray-200 p-6 text-center hover:shadow-md transition-shadow">
                    <div class="w-24 h-24 rounded-full bg-theme-primary-soft mx-auto mb-4 overflow-hidden">
                        @if($member->photo)
                            <img src="{{ asset('storage/'.$member->photo) }}" alt="{{ $member->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-2xl font-bold text-theme-primary">{{ strtoupper(substr($member->name, 0, 1)) }}</div>
                        @endif
                    </div>
                    <h3 class="font-bold text-gray-900">{{ $member->name }}</h3>
                    <p class="text-theme-primary text-sm font-medium">{{ $member->position }}</p>
                    @if($member->bio)
                        <p class="text-gray-600 text-sm mt-2">{{ $member->bio }}</p>
                    @endif
                </div>
            @empty
                <div class="col-span-full text-center py-10">
                    <p class="text-gray-500">No team members available at the moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-16 bg-gray-50 text-center">
    <div class="max-w-3xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Join us today and start your journey to financial growth.</h2>
        <a href="{{ route('contact') }}" class="site-btn-primary mt-4 inline-block">Let's get in touch</a>
    </div>
</section>

@endsection
