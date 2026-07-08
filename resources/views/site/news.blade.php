@extends('layouts.site')

@section('title', 'News & Events')
@section('meta_description', 'Latest news, updates, and events from Kasambya SACCO.')

@section('content')

<section class="page-header">
    <div class="max-w-7xl mx-auto px-4">
        <div class="breadcrumb mb-3">
            <a href="{{ route('home') }}">Kasambya SACCO</a> / News & Events
        </div>
        <h1>News & Events</h1>
        <p class="text-theme-primary-contrast/80 mt-2">Latest news, updates, and events from Kasambya SACCO.</p>
    </div>
</section>

<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <!-- Search & Filter -->
        <div class="mb-8 bg-white border border-gray-200 p-4">
            <form action="{{ route('news') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                <div class="flex-1 relative">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search news articles..." class="site-form-input pl-10">
                </div>
                @if(isset($categories) && $categories->count())
                    <select name="category" class="site-form-input w-full sm:w-48">
                        <option value="">All Categories</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                @endif
                <button type="submit" class="site-btn-primary">Search</button>
                @if(request('search') || request('category'))
                    <a href="{{ route('news') }}" class="site-btn-outline text-center">Clear</a>
                @endif
            </form>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                @if($news->count())
                    <div class="grid sm:grid-cols-2 gap-6">
                        @foreach($news as $item)
                            <a href="{{ route('news.show', $item->slug) }}" class="news-card block">
                                <div class="h-48 bg-gray-200 overflow-hidden">
                                    @if($item->image)
                                        <img src="{{ Storage::url($item->image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-theme-primary-soft flex items-center justify-center text-theme-primary font-bold">NEWS</div>
                                    @endif
                                </div>
                                <div class="p-5">
                                    @if($item->category)
                                        <span class="text-xs uppercase tracking-wider text-theme-primary font-semibold">{{ $item->category }}</span>
                                    @endif
                                    <h3 class="font-bold text-gray-900 mt-2">{{ $item->title }}</h3>
                                    <p class="text-gray-600 text-sm mt-2">{{ Str::limit(strip_tags($item->content ?? $item->excerpt ?? ''), 120) }}</p>
                                    <div class="flex items-center justify-between mt-4 text-sm">
                                        <span class="text-gray-500">{{ $item->published_at?->format('M d, Y') }}</span>
                                        <span class="text-theme-primary font-medium">Read More</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div class="mt-8">
                        {{ $news->links() }}
                    </div>
                @else
                    <div class="text-center py-20">
                        <p class="text-gray-500">No news articles yet. Check back soon!</p>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="space-y-8">
                <!-- Recent Posts -->
                <div class="bg-white border border-gray-200 p-6">
                    <h3 class="font-bold text-gray-900 mb-4">Recent Posts</h3>
                    @if(isset($recentNews) && $recentNews->count())
                        <div class="space-y-4">
                            @foreach($recentNews as $recent)
                                <a href="{{ route('news.show', $recent->slug) }}" class="flex items-start gap-3 group">
                                    <div class="w-16 h-16 bg-theme-primary-soft flex-shrink-0 overflow-hidden">
                                        @if($recent->image)
                                            <img src="{{ Storage::url($recent->image) }}" alt="" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-theme-primary text-xs font-bold">NEWS</div>
                                        @endif
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-900 group-hover:text-theme-primary transition-colors">{{ $recent->title }}</h4>
                                        <span class="text-xs text-gray-500">{{ $recent->published_at?->format('M d, Y') }}</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm text-gray-500">No recent posts.</p>
                    @endif
                </div>

                <!-- M-SACCO Callout -->
                <div class="bg-theme-primary text-theme-primary-contrast p-6">
                    <h3 class="font-bold mb-2">We have M-SACCO Service</h3>
                    <p class="text-theme-primary-contrast/80 text-sm">Allows you to access selected SACCO services using your mobile phones.</p>
                    <a href="tel:{{ $settings_values['org_phone'] ?? '+256775125122' }}" class="text-theme-accent text-sm font-medium mt-3 inline-block hover:text-theme-primary-contrast">Call {{ $settings_values['org_phone'] ?? '0775 125122' }} for Support</a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
