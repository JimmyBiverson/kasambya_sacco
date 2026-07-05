@extends('layouts.site')

@section('title', 'Financial Reports')
@section('meta_description', 'Access financial reports and statements of Kasambya SACCO.')

@section('content')

<section class="page-header">
    <div class="max-w-7xl mx-auto px-4">
        <div class="breadcrumb mb-3">
            <a href="{{ route('home') }}">Kasambya SACCO</a> / Financial Reports
        </div>
        <h1>Financial Reports</h1>
    </div>
</section>

<section class="py-16 bg-white" data-aos="fade-up">
    <div class="max-w-4xl mx-auto px-4">
        @if($page && $page->content)
            <div class="text-gray-700 leading-relaxed space-y-4">{!! $page->content !!}</div>
        @else
            <div class="text-center py-12">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Financial Reports</h3>
                <p class="text-gray-600">Our financial reports are published here for transparency and accountability to our members.</p>
                <p class="text-gray-500 text-sm mt-4">Please check back later for updated reports.</p>
            </div>
        @endif
    </div>
</section>

@endsection
