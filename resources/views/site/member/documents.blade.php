@extends('layouts.member')

@section('title', 'My Documents')
@section('page_title', 'My Documents')

@section('content')

<section class="bg-gradient-to-br from-emerald-900 to-emerald-950 text-white relative overflow-hidden">
    <div class="absolute -right-24 -top-24 w-96 h-96 bg-emerald-800/15 rounded-full blur-3xl"></div>
    <div class="absolute -left-20 -bottom-20 w-96 h-96 bg-green-900/10 rounded-full blur-3xl"></div>
    <div class="px-4 lg:px-8 py-8 relative z-10">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-black tracking-tight text-white">My Documents</h1>
                <p class="text-emerald-100/70 text-sm mt-1">Upload and manage your documents for verification</p>
            </div>
        </div>
    </div>
</section>

<section class="py-8 bg-slate-50 dark:bg-slate-900">
    <div class="px-4 lg:px-8 max-w-5xl">
        @if(session('success'))
            <div class="mb-6 bg-emerald-50 dark:bg-emerald-950 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-300 rounded-xl px-4 py-3 text-sm flex items-center gap-2">
                <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-slate-800 rounded-2xl lg:rounded-3xl border border-slate-200 dark:border-slate-700/60 p-6 shadow-sm sticky top-24">
                    <h3 class="font-bold text-slate-900 dark:text-white mb-4 text-sm uppercase tracking-wider">Upload Document</h3>
                    <form action="{{ route('member.documents.upload') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf

                        <div>
                            <label for="type" class="site-form-label text-xs">Document Type <span class="text-red-500">*</span></label>
                            <select id="type" name="type" required class="site-form-input text-sm">
                                <option value="">Select type</option>
                                <option value="NationalID">National ID</option>
                                <option value="Passport">Passport</option>
                                <option value="EmploymentLetter">Employment Letter</option>
                                <option value="Other">Other</option>
                            </select>
                            @error('type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="expiry_date" class="site-form-label text-xs">Expiry Date</label>
                            <input type="date" id="expiry_date" name="expiry_date" value="{{ old('expiry_date') }}" class="site-form-input text-sm">
                            @error('expiry_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="file" class="site-form-label text-xs">File <span class="text-red-500">*</span></label>
                            <div class="mt-1 flex justify-center px-4 py-6 border-2 border-dashed border-slate-300 rounded-xl hover:border-emerald-400 transition-colors cursor-pointer bg-slate-50 dark:bg-slate-900/50" onclick="document.getElementById('file').click()">
                                <div class="text-center">
                                    <svg class="w-8 h-8 text-slate-600 dark:text-slate-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                                    <p class="mt-2 text-xs text-slate-600 dark:text-slate-400"><span class="text-emerald-600 dark:text-emerald-400 font-medium">Click to upload</span> or drag and drop</p>
                                    <p class="text-[10px] text-slate-600 dark:text-slate-400 mt-1">JPEG, PNG, PDF, DOC up to 5MB</p>
                                </div>
                            </div>
                            <input type="file" id="file" name="file" class="hidden" accept=".jpeg,.jpg,.png,.pdf,.doc,.docx" required>
                            <div id="file-name" class="text-xs text-emerald-600 dark:text-emerald-400 mt-1 hidden"></div>
                            @error('file') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <button type="submit" class="site-btn-primary w-full text-center py-2.5 rounded-xl text-sm font-bold">
                            Upload Document
                        </button>
                    </form>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-slate-800 rounded-2xl lg:rounded-3xl border border-slate-200 dark:border-slate-700/60 p-6 shadow-sm">
                    <h3 class="font-bold text-slate-900 dark:text-white mb-5 text-sm uppercase tracking-wider">Uploaded Documents ({{ $documents->count() }})</h3>

                    @if($documents->count())
                        <div class="space-y-3">
                            @foreach($documents as $doc)
                                <div class="flex items-center justify-between p-4 border border-slate-100 dark:border-slate-700 rounded-xl hover:border-slate-200 dark:border-slate-700 transition-all">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-xl flex items-center justify-center
                                            {{ $doc->type === 'NationalID' ? 'bg-blue-50 dark:bg-blue-950 text-blue-600 dark:text-blue-400' : '' }}
                                            {{ $doc->type === 'Passport' ? 'bg-purple-50 dark:bg-purple-950 text-purple-600 dark:text-purple-400' : '' }}
                                            {{ $doc->type === 'EmploymentLetter' ? 'bg-amber-50 dark:bg-amber-950 text-amber-600 dark:text-amber-400' : '' }}
                                            {{ $doc->type === 'Other' ? 'bg-slate-50 dark:bg-slate-900 text-slate-600 dark:text-slate-400' : '' }}">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-slate-800 dark:text-slate-200">{{ str_replace('_', ' ', preg_replace('/([a-z])([A-Z])/', '$1 $2', $doc->type)) }}</p>
                                            <p class="text-xs text-slate-600 dark:text-slate-400 mt-0.5">
                                                Uploaded {{ $doc->created_at->format('d M Y') }}
                                                @if($doc->expiry_date)
                                                    &middot; Expires {{ $doc->expiry_date->format('d M Y') }}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <span class="inline-flex items-center space-x-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold
                                            {{ $doc->status === 'approved' ? 'bg-emerald-50 dark:bg-emerald-950 border border-emerald-200 dark:border-emerald-800 text-emerald-700 dark:text-emerald-400' : '' }}
                                            {{ $doc->status === 'pending' ? 'bg-amber-50 dark:bg-amber-950 border border-amber-200 dark:border-amber-800 text-amber-700 dark:text-amber-400' : '' }}
                                            {{ $doc->status === 'rejected' ? 'bg-red-50 dark:bg-red-950 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-400' : '' }}">
                                            <span class="w-1.5 h-1.5 rounded-full
                                                {{ $doc->status === 'approved' ? 'bg-emerald-50 dark:bg-emerald-950' : '' }}
                                                {{ $doc->status === 'pending' ? 'bg-amber-50 dark:bg-amber-950' : '' }}
                                                {{ $doc->status === 'rejected' ? 'bg-red-50 dark:bg-red-950' : '' }}">
                                            </span>
                                            {{ ucfirst($doc->status) }}
                                        </span>
                                        @if($doc->status === 'rejected' && $doc->rejection_reason)
                                            <div class="relative" x-data="{ showReason: false }">
                                                <button @click="showReason = !showReason" class="text-red-400 hover:text-red-600 p-1" title="View rejection reason">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                </button>
                                                <div x-show="showReason" @click.outside="showReason = false" class="absolute right-0 top-8 w-64 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl shadow-lg p-3 text-xs text-slate-600 dark:text-slate-400 z-10" x-cloak>
                                                    <p class="font-medium text-red-600 dark:text-red-400 mb-1">Rejection Reason:</p>
                                                    <p>{{ $doc->rejection_reason }}</p>
                                                </div>
                                            </div>
                                        @endif
                                        <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" class="text-slate-600 dark:text-slate-400 hover:text-blue-600 dark:text-blue-400 transition-colors p-1" title="View">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="w-16 h-16 bg-slate-100 dark:bg-slate-700 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-slate-600 dark:text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            <p class="text-slate-600 dark:text-slate-400 font-medium">No documents uploaded yet.</p>
                            <p class="text-slate-600 dark:text-slate-400 text-sm mt-1">Use the form to upload your identification documents.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    document.getElementById('file')?.addEventListener('change', function(e) {
        const name = document.getElementById('file-name');
        if (this.files.length > 0) {
            name.textContent = 'Selected: ' + this.files[0].name;
            name.classList.remove('hidden');
        } else {
            name.classList.add('hidden');
        }
    });
</script>
@endpush

@endsection
