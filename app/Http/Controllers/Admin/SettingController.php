<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function index(): View
    {
        $settings = Setting::all()->keyBy('key');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'org_name'                => 'nullable|string|max:255',
            'org_phone'               => 'nullable|string|max:50',
            'org_email'               => 'nullable|email|max:255',
            'operating_hours'         => 'nullable|string|max:500',
            'org_address'             => 'nullable|string|max:500',
            'org_established_year'    => 'nullable|integer|min:1800|max:2100',
            'org_registration_number' => 'nullable|string|max:100',
            // Use 'file' instead of 'image' so .ico and .svg don't get blocked by image MIME detection
            'org_logo'                => 'nullable|file|mimes:jpeg,png,jpg,webp|max:2048',
            'org_favicon'             => 'nullable|file|mimes:ico,png,jpg,jpeg,svg,webp|max:1024',
            'meta_description'        => 'nullable|string|max:500',
            'meta_keywords'           => 'nullable|string|max:500',
            'hero_copy'               => 'nullable|string|max:500',
            'theme_primary'           => 'nullable|string|max:20',
            'theme_secondary'         => 'nullable|string|max:20',
            'theme_accent'            => 'nullable|string|max:20',
        ]);

        // Heal stale logo/favicon paths: if the DB has a path but the file is gone, clear it
        foreach (['org_logo', 'org_favicon'] as $imgKey) {
            $storedPath = Setting::get($imgKey);
            if ($storedPath && ! Storage::disk('public')->exists($storedPath)) {
                Setting::where('key', $imgKey)->update(['value' => null]);
            }
        }

        foreach ($validated as $key => $value) {
            if ($key === 'org_logo') {
                if ($request->hasFile('org_logo')) {
                    try {
                        Storage::disk('public')->makeDirectory('settings');
                        $oldLogo = Setting::get('org_logo');
                        if ($oldLogo) {
                            Storage::disk('public')->delete($oldLogo);
                        }
                        $value = $request->file('org_logo')->store('settings', 'public');
                    } catch (\Throwable $e) {
                        return redirect()->route('admin.settings.index')->with('error', 'Failed to upload logo. Please check file permissions and try again.');
                    }
                } else {
                    continue;
                }
            }

            if ($key === 'org_favicon') {
                if ($request->hasFile('org_favicon')) {
                    try {
                        Storage::disk('public')->makeDirectory('settings');
                        $oldFav = Setting::get('org_favicon');
                        if ($oldFav) {
                            Storage::disk('public')->delete($oldFav);
                        }
                        $value = $request->file('org_favicon')->store('settings', 'public');
                    } catch (\Throwable $e) {
                        return redirect()->route('admin.settings.index')->with('error', 'Failed to upload favicon. Please check file permissions and try again.');
                    }
                } else {
                    continue;
                }
            }

            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value, 'group' => 'general', 'type' => 'text']
            );
        }

        Cache::forget('site.settings');

        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully.');
    }
}
