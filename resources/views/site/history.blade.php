@extends('layouts.site')

@section('title', 'Our History')
@section('meta_description', 'Learn about the history of Kasambya SACCO since its establishment in 2003.')

@section('content')

<section class="page-header">
    <div class="max-w-7xl mx-auto px-4">
        <div class="breadcrumb mb-3">
            <a href="{{ route('home') }}">Kasambya SACCO</a> / Our History
        </div>
        <h1>Our History</h1>
    </div>
</section>

<section class="py-16 bg-white" data-aos="fade-up">
    <div class="max-w-4xl mx-auto px-4">
        <h2 class="text-2xl font-bold text-theme-primary mb-6">Established in 2003</h2>
        @if($page && $page->content)
            <div class="text-gray-700 leading-relaxed space-y-4">{!! $page->content !!}</div>
        @else
            <div class="text-gray-700 leading-relaxed space-y-4">
                <p>Kasambya SACCO was established in 2003 and registered under Registration <strong>Number 6682</strong> by the Registrar of Cooperative Societies in accordance with the Cooperative Societies Statute of 1991. The SACCO was formed by a group of community members who aimed at promoting a culture of saving and providing accessible financial services to people within Kasambya and the surrounding areas.</p>
                <p>At its inception, the SACCO started with a small membership base and limited capital, mainly mobilized through members' savings and share contributions. Despite the challenges faced in the early years, the commitment and trust of members enabled the SACCO to grow steadily.</p>
                <p>Over the years, Kasambya SACCO has expanded its membership, savings portfolio, loan services and Mobile banking enabling many members to access affordable credit to support their businesses, agriculture, education, trade, asset acquisition and household needs. This growth has significantly contributed to improving the livelihoods and economic wellbeing of members.</p>
            </div>

            <div class="mt-8 grid md:grid-cols-3 gap-6">
                <div class="border border-gray-200 p-6">
                    <h3 class="font-bold text-gray-900">Our Vision</h3>
                    <p class="text-gray-600 text-sm mt-2">To provide affordable and sustainable financial services to our members.</p>
                </div>
                <div class="border border-gray-200 p-6">
                    <h3 class="font-bold text-gray-900">Our Mission</h3>
                    <p class="text-gray-600 text-sm mt-2">To develop a strong spirit of saving among our members in order to increase the capital base and improve members' welfare.</p>
                </div>
                <div class="border border-gray-200 p-6">
                    <h3 class="font-bold text-gray-900">Core Values</h3>
                    <p class="text-gray-600 text-sm mt-2">Integrity, Transparency, Teamwork, Time Consciousness, Customer Care, Learning.</p>
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Team -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="section-heading">The Amazing Team</h2>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($teamMembers as $member)
                <div class="bg-white border border-gray-200 p-6 text-center hover:shadow-md transition-shadow">
                    <div class="w-20 h-20 rounded-full bg-theme-primary-soft mx-auto mb-4 overflow-hidden">
                        @if($member->photo)
                            <img src="{{ Storage::url($member->photo) }}" alt="{{ $member->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-xl font-bold text-theme-primary">{{ strtoupper(substr($member->name, 0, 1)) }}</div>
                        @endif
                    </div>
                    <h3 class="font-bold text-gray-900">{{ $member->position }}</h3>
                    <p class="text-theme-primary text-sm font-medium">{{ $member->name }}</p>
                    @if($member->bio)
                        <p class="text-gray-600 text-sm mt-2">{{ $member->bio }}</p>
                    @endif
                </div>
            @empty
                <div class="col-span-full text-center py-10">
                    <p class="text-gray-500">No team members listed yet.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

@endsection
