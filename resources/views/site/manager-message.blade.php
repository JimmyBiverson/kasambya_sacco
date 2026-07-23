@extends('layouts.site')

@section('title', 'Message from the Manager')
@section('meta_description', 'A message from the manager of Mubende Employees and Community Sacco Ltd.')

@section('content')

<section class="page-header">
    <div class="max-w-7xl mx-auto px-4">
        <div class="breadcrumb mb-3">
            <a href="{{ route('home') }}">{{ $orgName }}</a> / Message from the Manager
        </div>
        <h1>Message from the Manager</h1>
    </div>
</section>

<section class="py-16 bg-white" data-aos="fade-up">
    <div class="max-w-4xl mx-auto px-4">
        <div class="grid md:grid-cols-3 gap-10">
            <div class="md:col-span-1" data-aos="fade-right">
            <div class="md:col-span-1">
                <div class="bg-theme-primary-soft rounded-lg overflow-hidden">
                    <img src="{{ asset('images/about-leadership.jpg') }}" alt="Manager" class="w-full">
                </div>
            </div>
            <div class="md:col-span-2">
                @if($page && $page->content)
                    <div class="text-gray-700 leading-relaxed space-y-4">{!! $page->content !!}</div>
                @else
                    <div class="text-gray-700 leading-relaxed space-y-4">
                        <p class="text-lg font-medium text-gray-900">Welcome to {{ $orgName }},</p>
                        <p>On behalf of the entire team, I am pleased to welcome you to {{ $orgName }}. Our commitment to providing affordable and sustainable financial services remains unwavering as we continue to grow and serve our members.</p>
                        <p>We have made significant strides in expanding our services, including the introduction of M-SACCO mobile banking, which allows our members to access SACCO services conveniently from their mobile phones. This is part of our commitment to leverage technology for better service delivery.</p>
                        <p>Our dedicated team of professionals works tirelessly to ensure that every member receives the highest quality of service. We invite both existing and potential members to take advantage of our diverse range of savings and loan products designed to meet your financial needs.</p>
                        <p>Thank you for choosing {{ $orgName }} as your trusted financial partner.</p>
                        <p class="font-semibold text-gray-900 mt-6">Management</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection
