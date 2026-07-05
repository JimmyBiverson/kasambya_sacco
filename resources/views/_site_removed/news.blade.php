@extends('layouts.app')

@section('content')

<div class="page-header">
    <div class="max-w-7xl mx-auto px-4">
        <h1>News & Events</h1>
        <p>Stay Updated with Our Latest News</p>
    </div>
</div>

<section class="py-16 bg-black border-t border-zinc-900">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <p class="text-gray-500 text-lg max-w-2xl mx-auto leading-relaxed">Stay informed with the latest updates, events, and announcements from Kasambya SACCO. We are committed to keeping our members engaged and empowered through timely information.</p>
    </div>
</section>

<section class="py-20 bg-black border-t border-zinc-900">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($news as $article)
            <a href="{{ route('news.show', $article->slug) }}" class="border border-zinc-800 hover:border-zinc-600 transition-colors block">
                <div class="h-48 border-b border-zinc-800 flex items-center justify-center text-gray-600 bg-zinc-900/50">
                    @if($article->category)<span class="text-xs text-gray-500 uppercase tracking-wider border border-zinc-700 px-3 py-1">{{ $article->category }}</span>@endif
                </div>
                <div class="p-6">
                    <div class="text-xs text-gray-600 mb-2">{{ $article->published_at ? $article->published_at->format('F j, Y') : $article->created_at->format('F j, Y') }}</div>
                    <h3 class="text-white font-semibold text-base mb-3">{{ $article->title }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-4">{{ $article->excerpt ?: Str::limit(strip_tags($article->content), 150) }}</p>
                    <div class="flex items-center gap-2 pt-3 border-t border-zinc-800">
                        <div class="w-8 h-8 rounded-full border border-zinc-700 flex items-center justify-center text-xs text-gray-500">{{ $article->author ? substr($article->author, 0, 2) : 'MS' }}</div>
                        <span class="text-sm text-gray-400">{{ $article->author ?: 'Kasambya SACCO' }}</span>
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-full text-center py-10">
                <p class="text-gray-500">No news articles found.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

@if(method_exists($news, 'links'))
<div class="py-12 bg-black border-t border-zinc-900">
    <div class="max-w-7xl mx-auto px-4">
        {{ $news->links() }}
    </div>
</div>
@endif

@endsection
