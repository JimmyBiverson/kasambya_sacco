@extends('layouts.site')

@section('title', 'Careers')
@section('meta_description', 'Join the Mubende Employees and Community Sacco Ltd team. Explore career opportunities and job openings.')

@section('content')

<section class="page-header">
    <div class="max-w-7xl mx-auto px-4">
        <div class="breadcrumb mb-3">
            <a href="{{ route('home') }}">{{ $orgName }}</a> / Careers
        </div>
        <h1>Careers</h1>
    </div>
</section>

<section class="py-16 bg-white" data-aos="fade-up">
    <div class="max-w-4xl mx-auto px-4">
        @if($page && $page->content)
            <div class="text-gray-700 leading-relaxed space-y-4">{!! $page->content !!}</div>
        @else
            <div class="text-center py-12">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                <h3 class="text-xl font-bold text-gray-900 mb-2">No Open Positions</h3>
                <p class="text-gray-600">There are currently no open positions at {{ $orgName }}. Please check back later for updates.</p>
                <p class="text-gray-500 text-sm mt-4">You can also send your CV to {{ $settings_values['org_email'] ?? 'mubendehq@gmail.com' }} for future opportunities.</p>
            </div>
        @endif
    </div>
</section>

@endsection
