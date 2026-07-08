@extends('layouts.admin')

@section('title', 'Edit Loan Product')
@section('page_title', 'Edit Loan Product')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 max-w-3xl">
    <form method="POST" action="{{ route('admin.loan-products.update', $loanProduct) }}" class="space-y-5">
        @csrf @method('PUT')

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name', $loanProduct->name) }}" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Code <span class="text-red-500">*</span></label>
                <input type="text" name="code" value="{{ old('code', $loanProduct->code) }}" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                @error('code') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea name="description" rows="3" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">{{ old('description', $loanProduct->description) }}</textarea>
            @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Min Amount (UGX)</label>
                <input type="number" name="min_amount" value="{{ old('min_amount', $loanProduct->min_amount ?? 0) }}" min="0" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                @error('min_amount') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Max Amount (UGX)</label>
                <input type="number" name="max_amount" value="{{ old('max_amount', $loanProduct->max_amount ?? 0) }}" min="0" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                @error('max_amount') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Interest Rate (%)</label>
                <input type="number" name="interest_rate" value="{{ old('interest_rate', $loanProduct->interest_rate) }}" step="0.01" min="0" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                @error('interest_rate') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Interest Method</label>
                <select name="interest_method" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                    <option value="flat" {{ old('interest_method', $loanProduct->interest_method) === 'flat' ? 'selected' : '' }}>Flat Rate</option>
                    <option value="declining" {{ old('interest_method', $loanProduct->interest_method) === 'declining' ? 'selected' : '' }}>Declining Balance</option>
                </select>
                @error('interest_method') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Min Term (months)</label>
                <input type="number" name="min_term" value="{{ old('min_term', $loanProduct->min_term ?? 1) }}" min="1" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                @error('min_term') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Max Term (months)</label>
                <input type="number" name="max_term" value="{{ old('max_term', $loanProduct->max_term ?? 12) }}" min="1" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                @error('max_term') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Grace Period</label>
                <input type="number" name="grace_period" value="{{ old('grace_period', $loanProduct->grace_period ?? 0) }}" min="0" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                @error('grace_period') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Penalty Rate (%)</label>
                <input type="number" name="penalty_rate" value="{{ old('penalty_rate', $loanProduct->penalty_rate ?? 0) }}" step="0.01" min="0" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                @error('penalty_rate') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Processing Fee</label>
                <input type="number" name="processing_fee" value="{{ old('processing_fee', $loanProduct->processing_fee ?? 0) }}" min="0" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                @error('processing_fee') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Insurance Fee</label>
                <input type="number" name="insurance_fee" value="{{ old('insurance_fee', $loanProduct->insurance_fee ?? 0) }}" min="0" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                @error('insurance_fee') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                <input type="text" name="category" value="{{ old('category', $loanProduct->category) }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                @error('category') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="flex items-center space-x-3 mt-6">
                    <input type="checkbox" name="collateral_required" value="1" {{ old('collateral_required', $loanProduct->collateral_required) ? 'checked' : '' }} class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500">
                    <span class="text-sm font-medium text-gray-700">Collateral Required</span>
                </label>
                @error('collateral_required') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label class="flex items-center space-x-3">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $loanProduct->is_active) ? 'checked' : '' }} class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500">
                <span class="text-sm font-medium text-gray-700">Active</span>
            </label>
            @error('is_active') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center space-x-3 pt-4 border-t border-gray-100">
            <button type="submit" class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition-colors">Update Product</button>
            <a href="{{ route('admin.loan-products.index') }}" class="px-5 py-2.5 bg-white border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition-colors">Cancel</a>
        </div>
    </form>
</div>
@endsection
