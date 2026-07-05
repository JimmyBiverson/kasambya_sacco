@extends('layouts.admin')

@section('title', 'Edit Partner')
@section('page_title', 'Edit Partner')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 max-w-2xl">
    <form method="POST" action="{{ route('admin.partners.update', $partner) }}" enctype="multipart/form-data" class="space-y-5">
        @csrf @method('PUT')

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Name <span class="text-red-500">*</span></label>
            <input type="text" name="name" value="{{ old('name', $partner->name) }}" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Logo</label>
            @if($partner->logo)
                <div class="mb-2"><img src="{{ asset('storage/' . $partner->logo) }}" class="w-24 h-12 object-contain rounded-lg border"></div>
            @endif
            <input type="file" name="logo" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
            <p class="text-xs text-gray-400 mt-1">Leave empty to keep current logo.</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Website URL</label>
            <input type="text" name="url" value="{{ old('url', $partner->url) }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Sort Order</label>
            <input type="number" name="sort_order" value="{{ old('sort_order', $partner->sort_order ?? 0) }}" min="0" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
        </div>

        <div class="flex items-center space-x-3 pt-4 border-t border-gray-100">
            <button type="submit" class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition-colors">Update Partner</button>
            <a href="{{ route('admin.partners.index') }}" class="px-5 py-2.5 bg-white border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition-colors">Cancel</a>
        </div>
    </form>
</div>
@endsection
