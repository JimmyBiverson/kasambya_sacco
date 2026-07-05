@extends('layouts.admin')

@section('title', 'New Slide')
@section('page_title', 'New Slide')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 max-w-2xl">
    <form method="POST" action="{{ route('admin.slides.store') }}" enctype="multipart/form-data" class="space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Title <span class="text-red-500">*</span></label>
            <input type="text" name="title" value="{{ old('title') }}" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
            @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Subtitle</label>
            <textarea name="subtitle" rows="2" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">{{ old('subtitle') }}</textarea>
            @error('subtitle') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">CTA Text</label>
                <input type="text" name="cta_text" value="{{ old('cta_text') }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                @error('cta_text') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">CTA URL</label>
                <input type="text" name="cta_url" value="{{ old('cta_url') }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                @error('cta_url') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Background Image</label>
            <input type="file" name="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
            <p class="text-xs text-gray-400 mt-1">Recommended: 1360x600px. Max 2MB (jpeg, png, webp)</p>
            @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
            </div>
            <div>
                <label class="flex items-center space-x-3 mt-6">
                    <input type="checkbox" name="is_published" value="1" {{ old('is_published', true) ? 'checked' : '' }} class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500">
                    <span class="text-sm font-medium text-gray-700">Published</span>
                </label>
            </div>
        </div>

        <div class="flex items-center space-x-3 pt-4 border-t border-gray-100">
            <button type="submit" class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition-colors">Create Slide</button>
            <a href="{{ route('admin.slides.index') }}" class="px-5 py-2.5 bg-white border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition-colors">Cancel</a>
        </div>
    </form>
</div>
@endsection
