@extends('layouts.site')

@section('title', $newsItem?->title ?? 'News')
@section('meta_description', Str::limit(strip_tags($newsItem?->content ?? ''), 160))

@section('content')

<section class="page-header">
    <div class="max-w-7xl mx-auto px-4">
        <div class="breadcrumb mb-3">
            <a href="{{ route('home') }}">{{ $orgName }}</a> / <a href="{{ route('news') }}">News &amp; Events</a> / {{ $newsItem?->title ?? 'Article' }}
        </div>
        <h1 class="text-2xl md:text-4xl">{{ $newsItem?->title ?? 'Article' }}</h1>
    </div>
</section>

<section class="py-16 bg-gray-50" data-aos="fade-up">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2" data-aos="fade-right">
                @if($newsItem)
                    <article class="bg-white border border-gray-200 overflow-hidden">
                        @if($newsItem->image)
                            <img src="{{ Storage::url($newsItem->image) }}" alt="{{ $newsItem->title }}" class="w-full">
                        @endif
                        <div class="p-8">
                            <div class="flex items-center gap-4 text-sm text-gray-500 mb-6">
                                @if($newsItem->category)
                                    <span class="text-xs uppercase tracking-wider text-theme-primary font-semibold">{{ $newsItem->category }}</span>
                                @endif
                                <span>{{ $newsItem->published_at?->format('F d, Y') }}</span>
                                @if($newsItem->author)
                                    <span>{{ $newsItem->author }}</span>
                                @endif
                            </div>
                            <div class="text-gray-700 leading-relaxed space-y-4">
                                {!! $newsItem->content !!}
                            </div>
                        </div>
                    </article>
                @else
                    <div class="text-center py-20">
                        <p class="text-gray-500">Article not found.</p>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="space-y-8">
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

                <div class="bg-theme-primary text-theme-primary-contrast p-6">
                    <h3 class="font-bold mb-2">We have M-SACCO Service</h3>
                    <p class="text-sm text-theme-primary-contrast/80">Allows you to access selected SACCO services using your mobile phones.</p>
                    <a href="tel:{{ $settings_values['org_phone'] ?? '+256775125122' }}" class="text-theme-accent text-sm font-medium mt-3 inline-block hover:text-theme-primary-contrast">Call {{ $settings_values['org_phone'] ?? '0775 125122' }} for Support</a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
