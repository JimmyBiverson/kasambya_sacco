@extends('layouts.admin')

@section('title', 'New FAQ')
@section('page_title', 'New FAQ')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 max-w-2xl">
    <form method="POST" action="{{ route('admin.faqs.store') }}" class="space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Question <span class="text-red-500">*</span></label>
            <input type="text" name="question" value="{{ old('question') }}" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
            @error('question') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Answer <span class="text-red-500">*</span></label>
            <textarea name="answer" rows="5" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">{{ old('answer') }}</textarea>
            @error('answer') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                <input type="text" name="category" value="{{ old('category') }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm" placeholder="e.g. Membership, Loans, Savings">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
            </div>
        </div>

        <div>
            <label class="flex items-center space-x-3">
                <input type="checkbox" name="is_published" value="1" {{ old('is_published', true) ? 'checked' : '' }} class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500">
                <span class="text-sm font-medium text-gray-700">Published</span>
            </label>
        </div>

        <div class="flex items-center space-x-3 pt-4 border-t border-gray-100">
            <button type="submit" class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition-colors">Create FAQ</button>
            <a href="{{ route('admin.faqs.index') }}" class="px-5 py-2.5 bg-white border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition-colors">Cancel</a>
        </div>
    </form>
</div>
@endsection
