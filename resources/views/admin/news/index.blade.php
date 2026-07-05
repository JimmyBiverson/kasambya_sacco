@extends('layouts.admin')

@section('title', 'News & Events')
@section('page_title', 'News & Events')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
    <div class="flex items-center justify-between mb-5">
        <div>
            <h3 class="text-base font-semibold text-gray-900">All Articles</h3>
            <p class="text-xs text-gray-500 mt-0.5">Manage news and events displayed on the website</p>
        </div>
        <a href="{{ route('admin.news.create') }}" class="inline-flex items-center space-x-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span>New Article</span>
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left border-b border-gray-100">
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Image</th>
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Title</th>
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Category</th>
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Author</th>
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Published</th>
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Status</th>
                    <th class="pb-3 px-4 font-semibold text-gray-500 text-[11px] uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($news as $article)
                    <tr class="border-b border-gray-50 hover:bg-gray-50/80 transition-colors">
                        <td class="py-3 px-4">
                            @if($article->image)
                                <img src="{{ asset('storage/' . $article->image) }}" class="w-16 h-10 object-cover rounded-lg" alt="{{ $article->title }}">
                            @else
                                <span class="text-gray-400 text-xs">—</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 font-medium text-gray-900 max-w-xs truncate">{{ $article->title }}</td>
                        <td class="py-3 px-4"><span class="px-2 py-0.5 rounded-full text-[11px] font-medium bg-gray-100 text-gray-600">{{ $article->category ?? 'General' }}</span></td>
                        <td class="py-3 px-4 text-gray-500">{{ $article->author ?? '—' }}</td>
                        <td class="py-3 px-4 text-gray-500">{{ $article->published_at ? $article->published_at->format('d M Y') : '—' }}</td>
                        <td class="py-3 px-4">
                            <span class="inline-flex items-center space-x-1.5 px-2.5 py-1 rounded-full text-[11px] font-medium {{ $article->is_published ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-gray-100 text-gray-500 border border-gray-200' }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $article->is_published ? 'bg-emerald-500' : 'bg-gray-400' }}"></span>
                                {{ $article->is_published ? 'Published' : 'Draft' }}
                            </span>
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('admin.news.edit', $article) }}" class="text-gray-400 hover:text-emerald-600 transition-colors p-1.5 rounded-lg hover:bg-emerald-50" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <form method="POST" action="{{ route('admin.news.destroy', $article) }}" onsubmit="return confirm('Delete this article?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-gray-400 hover:text-red-600 transition-colors p-1.5 rounded-lg hover:bg-red-50" title="Delete">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-10 text-center text-gray-400">
                            <svg class="w-10 h-10 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                            <p>No articles yet. <a href="{{ route('admin.news.create') }}" class="text-emerald-600 font-medium hover:underline">Create one</a>.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5">
        {{ $news->links() }}
    </div>
</div>
@endsection
