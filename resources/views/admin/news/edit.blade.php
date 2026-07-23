@extends('layouts.admin')

@section('title', 'Edit Article')
@section('page_title', 'Edit Article')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
<style>#editor { height: 300px; }</style>
@endpush

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 max-w-3xl">
    <form method="POST" action="{{ route('admin.news.update', $news) }}" enctype="multipart/form-data" class="space-y-5">
        @csrf @method('PUT')

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Title <span class="text-red-500">*</span></label>
            <input type="text" name="title" id="title" value="{{ old('title', $news->title) }}" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                <input type="text" name="slug" id="slug" value="{{ old('slug', $news->slug) }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                <select name="category" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                    <option value="">General</option>
                    <option value="News" {{ old('category', $news->category) === 'News' ? 'selected' : '' }}>News</option>
                    <option value="Event" {{ old('category', $news->category) === 'Event' ? 'selected' : '' }}>Event</option>
                    <option value="Announcement" {{ old('category', $news->category) === 'Announcement' ? 'selected' : '' }}>Announcement</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Excerpt</label>
            <textarea name="excerpt" rows="2" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">{{ old('excerpt', $news->excerpt) }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Content</label>
            <div id="editor">{!! old('content', $news->content) !!}</div>
            <textarea name="content" id="content" class="hidden">{{ old('content', $news->content) }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Featured Image</label>
                @if($news->image)
                    <div class="mb-2"><img src="{{ asset('storage/' . $news->image) }}" class="w-32 h-20 object-cover rounded-lg border"></div>
                @endif
                <input type="file" name="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                <p class="text-xs text-gray-400 mt-1">Leave empty to keep current image.</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Author</label>
                <input type="text" name="author" value="{{ old('author', $news->author) }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Published At</label>
                <input type="date" name="published_at" value="{{ old('published_at', $news->published_at?->format('Y-m-d') ?? now()->format('Y-m-d')) }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
            </div>
            <div>
                <label class="flex items-center space-x-3 mt-6">
                    <input type="checkbox" name="is_published" value="1" {{ old('is_published', $news->is_published) ? 'checked' : '' }} class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500">
                    <span class="text-sm font-medium text-gray-700">Published</span>
                </label>
            </div>
        </div>

        <div class="flex items-center space-x-3 pt-4 border-t border-gray-100">
            <button type="submit" id="submit-btn" class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition-colors">Update Article</button>
            <a href="{{ route('admin.news.index') }}" class="px-5 py-2.5 bg-white border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition-colors">Cancel</a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
<script>
var quill = new Quill('#editor', { theme: 'snow' });
document.getElementById('submit-btn').addEventListener('click', function() {
    document.getElementById('content').value = quill.root.innerHTML;
});
</script>
@endpush
