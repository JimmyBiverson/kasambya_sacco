@extends('layouts.admin')

@section('title', 'Settings')
@section('page_title', 'Site Settings')

@section('content')
<form id="settings-form" method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="space-y-6">
    @csrf
    <div class="bg-white dark:bg-slate-800 shadow-sm rounded-2xl border border-slate-100 dark:border-slate-700 p-6">
        <h2 class="text-lg font-semibold text-slate-900 dark:text-slate-100 mb-3">General</h2>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 items-start">
                <div class="lg:col-span-2 space-y-3">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-200">Organization Name</label>
                    <input type="text" name="org_name" value="{{ old('org_name', $settings_values['org_name'] ?? '') }}" class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 px-4 py-2" />

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-200">Phone</label>
                            <input type="text" name="org_phone" value="{{ old('org_phone', $settings_values['org_phone'] ?? '') }}" class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 px-4 py-2" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-200">Email</label>
                            <input type="email" name="org_email" value="{{ old('org_email', $settings_values['org_email'] ?? '') }}" class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 px-4 py-2" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-200">Established Year</label>
                            <input type="number" name="org_established_year" value="{{ old('org_established_year', $settings_values['org_established_year'] ?? '') }}" class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 px-4 py-2" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-200">Registration Number</label>
                            <input type="text" name="org_registration_number" value="{{ old('org_registration_number', $settings_values['org_registration_number'] ?? '') }}" class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 px-4 py-2" />
                        </div>
                    </div>

                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-200">Address</label>
                    <input type="text" name="org_address" value="{{ old('org_address', $settings_values['org_address'] ?? '') }}" class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 px-4 py-2" />

                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-200">Operating Hours</label>
                    <input type="text" name="operating_hours" value="{{ old('operating_hours', $settings_values['operating_hours'] ?? '') }}" class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 px-4 py-2" />
                </div>

                <div class="flex flex-col items-center gap-3">
                    <div class="w-28 h-28 rounded-lg bg-slate-50 dark:bg-slate-700 border border-slate-200 dark:border-slate-600 flex items-center justify-center overflow-hidden">
                        @if(!empty($settings_values['org_logo']))
                            <img src="{{ Storage::url($settings_values['org_logo']) }}" class="w-full h-full object-contain" alt="logo">
                        @else
                            <div class="text-slate-400">Logo</div>
                        @endif
                    </div>
                    <input type="file" name="org_logo" accept="image/*" class="text-sm text-slate-600 dark:text-slate-300" />
                    <div class="mt-2 w-full text-xs text-slate-500 dark:text-slate-300">Recommended: PNG or WebP. Ideal size: 180x180 (for social preview), and a 32x32 favicon.</div>
                    <div class="mt-4 w-full">
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-200">Favicon / Site Icon</label>
                        <div class="flex items-center gap-3 mt-2">
                            <div class="w-12 h-12 rounded bg-slate-50 dark:bg-slate-700 border border-slate-200 dark:border-slate-600 flex items-center justify-center overflow-hidden">
                                @if(!empty($settings_values['org_favicon']))
                                    <img src="{{ Storage::url($settings_values['org_favicon']) }}" class="w-full h-full object-contain" alt="favicon">
                                @elseif(!empty($settings_values['org_logo']) )
                                    <img src="{{ Storage::url($settings_values['org_logo']) }}" class="w-full h-full object-contain" alt="favicon">
                                @else
                                    <div class="text-slate-400">Icon</div>
                                @endif
                            </div>
                            <input type="file" name="org_favicon" accept="image/*,.ico" class="text-sm text-slate-600 dark:text-slate-300" />
                        </div>
                    </div>
                </div>
            </div>

    </div>

    <div class="bg-white dark:bg-slate-800 shadow-sm rounded-2xl border border-slate-100 dark:border-slate-700 p-6">
        <h2 class="text-lg font-semibold text-slate-900 dark:text-slate-100 mb-3">Appearance</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-200">Primary Color</label>
                <div class="flex items-center gap-3 mt-2">
                    <input id="theme_primary" type="color" name="theme_primary" value="{{ old('theme_primary', $theme_primary_value ?? '#10b981') }}" class="w-12 h-10 p-0 border rounded" />
                    <input id="theme_primary_text" type="text" readonly value="{{ old('theme_primary', $theme_primary_value ?? '#10b981') }}" class="flex-1 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-700 px-4 py-2 text-slate-900 dark:text-slate-100" />
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-200">Secondary Color</label>
                <div class="flex items-center gap-3 mt-2">
                    <input id="theme_secondary" type="color" name="theme_secondary" value="{{ old('theme_secondary', $theme_secondary_value ?? '#06b6d4') }}" class="w-12 h-10 p-0 border rounded" />
                    <input id="theme_secondary_text" type="text" readonly value="{{ old('theme_secondary', $theme_secondary_value ?? '#06b6d4') }}" class="flex-1 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-700 px-4 py-2 text-slate-900 dark:text-slate-100" />
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-200">Accent Color</label>
                <div class="flex items-center gap-3 mt-2">
                    <input id="theme_accent" type="color" name="theme_accent" value="{{ old('theme_accent', $theme_accent_value ?? '#facc15') }}" class="w-12 h-10 p-0 border rounded" />
                    <input id="theme_accent_text" type="text" readonly value="{{ old('theme_accent', $theme_accent_value ?? '#facc15') }}" class="flex-1 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-700 px-4 py-2 text-slate-900 dark:text-slate-100" />
                </div>
            </div>

            <div class="md:col-span-3">
                <p class="text-sm text-slate-500 dark:text-slate-300">Preview buttons below reflect the chosen colors. Toggle Dark mode using the icon in the top bar to see live changes.</p>
                <div class="mt-4 flex flex-wrap items-center gap-3">
                    <button class="px-4 py-2 rounded text-white" style="background:var(--theme-primary)">Primary</button>
                    <button class="px-4 py-2 rounded text-white" style="background:var(--theme-secondary)">Secondary</button>
                    <button class="px-4 py-2 rounded text-slate-900" style="background:var(--theme-accent)">Accent</button>
                    <button class="px-4 py-2 rounded border" style="border-color:var(--theme-primary); color:var(--theme-primary)">Outline</button>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-800 shadow-sm rounded-2xl border border-slate-100 dark:border-slate-700 p-6">
        <h2 class="text-lg font-semibold text-slate-900 dark:text-slate-100 mb-3">SEO & Content</h2>
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-200">Meta Description</label>
                <textarea name="meta_description" rows="3" class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 px-4 py-2">{{ old('meta_description', $settings_values['meta_description'] ?? '') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-200">Meta Keywords</label>
                <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $settings_values['meta_keywords'] ?? '') }}" class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 px-4 py-2" />
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-200">Homepage Hero Copy</label>
                <textarea name="hero_copy" rows="3" class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 px-4 py-2">{{ old('hero_copy', $settings_values['hero_copy'] ?? '') }}</textarea>
            </div>

            <div class="flex items-center justify-end">
                <button type="submit" class="px-5 py-2.5 bg-emerald-600 text-white hover:opacity-90 rounded-full">Save All Settings</button>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){
    const primary = document.getElementById('theme_primary');
    const primaryText = document.getElementById('theme_primary_text');
    const secondary = document.getElementById('theme_secondary');
    const secondaryText = document.getElementById('theme_secondary_text');
    const accent = document.getElementById('theme_accent');
    const accentText = document.getElementById('theme_accent_text');

    function updatePreview(){
        const p = primary && primary.value ? primary.value : '{{ $theme_primary_value ?? '#10b981' }}';
        const s = secondary && secondary.value ? secondary.value : '{{ $theme_secondary_value ?? '#06b6d4' }}';
        const a = accent && accent.value ? accent.value : '{{ $theme_accent_value ?? '#facc15' }}';
        document.documentElement.style.setProperty('--theme-primary', p);
        document.documentElement.style.setProperty('--theme-secondary', s);
        document.documentElement.style.setProperty('--theme-accent', a);
        if(primaryText) primaryText.value = p;
        if(secondaryText) secondaryText.value = s;
        if(accentText) accentText.value = a;
    }

    if(primary) primary.addEventListener('input', updatePreview);
    if(secondary) secondary.addEventListener('input', updatePreview);
    if(accent) accent.addEventListener('input', updatePreview);

    updatePreview();
});
</script>
@endpush

@endsection