@extends('layouts.site')

@section('title', 'Our History')
@section('meta_description', 'Learn about the history of Mubende Employees and Community Sacco Ltd since its establishment in 1999.')

@section('content')

<section class="page-header">
    <div class="max-w-7xl mx-auto px-4">
        <div class="breadcrumb mb-3">
            <a href="{{ route('home') }}">{{ $orgName }}</a> / Our History
        </div>
        <h1>Our History</h1>
    </div>
</section>

<section class="py-16 bg-white" data-aos="fade-up">
    <div class="max-w-4xl mx-auto px-4">
        <h2 class="text-2xl font-bold text-theme-primary mb-6">Established in 1999</h2>
        @if($page && $page->content)
            <div class="text-gray-700 leading-relaxed space-y-4">{!! $page->content !!}</div>
        @else
            <div class="text-gray-700 leading-relaxed space-y-4">
                <p>{{ $orgName }} was established in {{ $settings_values['org_established_year'] ?? '1999' }} and registered under Registration <strong>Number {{ $settings_values['org_registration_number'] ?? '6682' }}</strong> by the Registrar of Cooperative Societies in accordance with the Cooperative Societies Statute of 1991. The SACCO was formed by a group of Mubende District employees who aimed at promoting a culture of saving and providing accessible financial services to people within Mubende and the surrounding areas.</p>
                <p>At its inception, the SACCO started with a small membership base and limited capital, mainly mobilized through members' savings and share contributions. Despite the challenges faced in the early years, the commitment and trust of members enabled the SACCO to grow steadily.</p>
                <p>Over the years, {{ $orgName }} has expanded its membership, savings portfolio, loan services and Mobile banking enabling many members to access affordable credit to support their businesses, agriculture, education, trade, asset acquisition and household needs. This growth has significantly contributed to improving the livelihoods and economic wellbeing of members.</p>
            </div>

            <div class="mt-8 grid md:grid-cols-3 gap-6">
                <div class="border border-gray-200 p-6">
                    <h3 class="font-bold text-gray-900">Our Vision</h3>
                    <p class="text-gray-600 text-sm mt-2">A financially sound and sustainable sacco , serving to uplift the social and economical well being of its members.</p>
                </div>
                <div class="border border-gray-200 p-6">
                    <h3 class="font-bold text-gray-900">Our Mission</h3>
                    <p class="text-gray-600 text-sm mt-2">To timely meet the financial needs of members through the provision of safe , secure and cheaper financial services.</p>
                </div>
                <div class="border border-gray-200 p-6">
                    <h3 class="font-bold text-gray-900">Core Values</h3>
                    <p class="text-gray-600 text-sm mt-2">Self reliance, Excellence, Reliability, Involving, Openness, Unity, Smartness.</p>
                </div>
            </div>

            <div class="mt-12">
                <h3 class="text-2xl font-bold text-theme-primary mb-6">Our Community Impact Projects</h3>
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="border border-gray-200 p-4 rounded-xl">
                        <img src="{{ asset('images/uploaded/donation_water.jpg') }}" alt="Donated Handwashing Water Station" class="w-full h-48 object-cover rounded-lg">
                        <h4 class="font-bold text-gray-800 mt-3">Handwashing Water Stations</h4>
                        <p class="text-gray-600 text-xs mt-1">Providing donated handwashing stations to enhance public health and hygiene in our local communities.</p>
                    </div>
                    <div class="border border-gray-200 p-4 rounded-xl">
                        <img src="{{ asset('images/uploaded/garbage_bins.jpg') }}" alt="Donated Garbage Bins" class="w-full h-48 object-cover rounded-lg">
                        <h4 class="font-bold text-gray-800 mt-3">Sanitation & Environment</h4>
                        <p class="text-gray-600 text-xs mt-1">Donating garbage collection bins placed across the district to keep our cities clean and green.</p>
                    </div>
                </div>
                <div class="grid md:grid-cols-2 gap-6 mt-6">
                    <div class="border border-gray-200 p-4 rounded-xl">
                        <img src="{{ asset('images/uploaded/handshake.jpg') }}" alt="Community Partnership" class="w-full h-48 object-cover rounded-lg">
                        <h4 class="font-bold text-gray-800 mt-3">Venue Partnership & Collaborations</h4>
                        <p class="text-gray-600 text-xs mt-1">Working closely with local administrators and community groups to host educational seminars on saving.</p>
                    </div>
                    <div class="border border-gray-200 p-4 rounded-xl flex flex-col justify-center bg-gray-50 dark:bg-slate-800 p-6">
                        <h4 class="font-bold text-theme-primary text-lg">Empowering Mubende Since 1999</h4>
                        <p class="text-gray-700 text-sm mt-2">Mubende Employees and Community Sacco Ltd remains committed to serving all members through smartness, unity, and self-reliance.</p>
                    </div>
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
