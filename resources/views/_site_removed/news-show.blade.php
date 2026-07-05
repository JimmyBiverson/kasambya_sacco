@extends('layouts.app')

@section('content')

<div class="page-header">
    <div class="max-w-7xl mx-auto px-4">
        <h1>{{ $newsItem->title ?? ucwords(str_replace('-', ' ', $slug)) }}</h1>
    </div>
</div>

<div class="border-b border-zinc-900 bg-black">
    <div class="max-w-7xl mx-auto px-4 py-3 flex items-center gap-2 text-sm text-gray-500">
        <a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition-colors">Home</a>
        <span class="text-zinc-700">/</span>
        <a href="{{ route('news') }}" class="text-gray-400 hover:text-white transition-colors">News & Events</a>
        <span class="text-zinc-700">/</span>
        <span class="text-white font-semibold">{{ $newsItem->title ?? ucwords(str_replace('-', ' ', $slug)) }}</span>
    </div>
</div>

<section class="py-16 bg-black">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <div class="lg:col-span-2">
                <div class="border border-zinc-800 h-80 flex items-center justify-center text-gray-600 bg-zinc-900/50 mb-8">
                    <span>Article Image</span>
                </div>

                <div class="flex flex-wrap gap-6 mb-6 pb-6 border-b border-zinc-800 text-sm text-gray-500">
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        Published: {{ $newsItem && $newsItem->published_at ? $newsItem->published_at->format('F j, Y') : '' }}
                    </span>
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        Author: {{ $newsItem->author ?? 'Kasambya SACCO' }}
                    </span>
                    @if($newsItem && $newsItem->category)<span class="border border-zinc-700 text-gray-400 text-xs px-3 py-1 uppercase tracking-wider">{{ $newsItem->category }}</span>@endif
                </div>

                <div class="text-gray-400 leading-relaxed text-base space-y-5">
                    {!! $newsItem ? nl2br(e($newsItem->content)) : '<p>Article not found.</p>' !!}
                </div>

                <div class="flex flex-wrap items-center gap-3 mt-8 pt-6 border-t border-zinc-800">
                    <span class="text-sm text-gray-400 font-semibold">Share this article:</span>
                    <a href="#" class="border border-zinc-700 px-4 py-2 text-sm text-gray-500 hover:border-white hover:text-white transition-colors inline-flex items-center gap-2">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg> Facebook
                    </a>
                    <a href="#" class="border border-zinc-700 px-4 py-2 text-sm text-gray-500 hover:border-white hover:text-white transition-colors inline-flex items-center gap-2">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg> Twitter
                    </a>
                    <a href="#" class="border border-zinc-700 px-4 py-2 text-sm text-gray-500 hover:border-white hover:text-white transition-colors inline-flex items-center gap-2">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg> WhatsApp
                    </a>
                </div>

                <a href="{{ route('news') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-white transition-colors mt-8">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                    Back to News & Events
                </a>
            </div>

            <aside class="space-y-6">
                <div class="border border-zinc-800 p-6">
                    <h3 class="text-white font-semibold text-base mb-4 pb-3 border-b border-zinc-800">Recent News</h3>
                    @php
                        $recentNews = \App\Models\NewsEvent::where('is_published', true)
                            ->where('id', '!=', optional($newsItem)->id)
                            ->orderByDesc('published_at')
                            ->limit(5)
                            ->get();
                    @endphp
                    @forelse($recentNews as $recent)
                    <div class="py-3 border-b border-zinc-900 last:border-0">
                        <a href="{{ route('news.show', $recent->slug) }}" class="text-gray-400 hover:text-white transition-colors text-sm font-semibold block leading-relaxed">{{ $recent->title }}</a>
                        <div class="text-xs text-gray-600 mt-1">{{ $recent->published_at ? $recent->published_at->format('F j, Y') : $recent->created_at->format('F j, Y') }}</div>
                    </div>
                    @empty
                    <p class="text-gray-600 text-sm">No recent news.</p>
                    @endforelse
                </div>

                <div class="border border-zinc-800 p-6">
                    <h3 class="text-white font-semibold text-base mb-4 pb-3 border-b border-zinc-800">About Kasambya SACCO</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Kasambya SACCO was established in 1999 and registered under Registration Number 6682 by the Registrar of Cooperative Societies. We provide affordable and sustainable financial services to our members across Uganda.</p>
                </div>

                @if($newsItem && $newsItem->category)
                <div class="border border-zinc-800 p-6">
                    <h3 class="text-white font-semibold text-base mb-4 pb-3 border-b border-zinc-800">Category</h3>
                    <span class="border border-zinc-700 text-gray-400 text-xs px-3 py-1 uppercase tracking-wider">{{ $newsItem->category }}</span>
                </div>
                @endif
            </aside>
        </div>
    </div>
</section>

@endsection
