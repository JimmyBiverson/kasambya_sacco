<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
            'org_name' => 'nullable|string|max:255',
            'org_phone' => 'nullable|string|max:50',
            'org_email' => 'nullable|email|max:255',
            'operating_hours' => 'nullable|string|max:500',
            'org_address' => 'nullable|string|max:500',
            'org_logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'org_favicon' => 'nullable|image|mimes:ico,png,jpg,jpeg,svg,webp|max:1024',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'hero_copy' => 'nullable|string|max:500',
            'theme_primary' => 'nullable|string|max:20',
            'theme_secondary' => 'nullable|string|max:20',
        ]);

        foreach ($validated as $key => $value) {
            if ($key === 'org_logo' && $request->hasFile('org_logo')) {
                $oldLogo = Setting::get('org_logo');
                if ($oldLogo) {
                    Storage::disk('public')->delete($oldLogo);
                }
                $value = $request->file('org_logo')->store('settings', 'public');
            }

            if ($key === 'org_favicon' && $request->hasFile('org_favicon')) {
                $oldFav = Setting::get('org_favicon');
                if ($oldFav) {
                    Storage::disk('public')->delete($oldFav);
                }
                $value = $request->file('org_favicon')->store('settings', 'public');
            }

            if (($key === 'org_logo' && !$request->hasFile('org_logo')) || ($key === 'org_favicon' && !$request->hasFile('org_favicon'))) {
                continue;
            }

            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value, 'group' => 'general', 'type' => 'text']
            );
        }

        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully.');
    }
}
