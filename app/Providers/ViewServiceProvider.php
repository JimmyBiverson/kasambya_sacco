<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        try {
            $settings = Cache::remember('site.settings', 300, fn () =>
                Setting::all()->keyBy('key')
            );
        } catch (\Exception $e) {
            $settings = collect();
        }

        // Compute safe theme values to avoid undefined key notices in views
        try {
            $themePrimary = $settings->has('theme_primary') && $settings->get('theme_primary') ? $settings->get('theme_primary')->value : '#10b981';
        } catch (\Throwable $e) {
            $themePrimary = '#10b981';
        }

        try {
            $themeSecondary = $settings->has('theme_secondary') && $settings->get('theme_secondary') ? $settings->get('theme_secondary')->value : '#06b6d4';
        } catch (\Throwable $e) {
            $themeSecondary = '#06b6d4';
        }

        try {
            $themeAccent = $settings->has('theme_accent') && $settings->get('theme_accent') ? $settings->get('theme_accent')->value : '#facc15';
        } catch (\Throwable $e) {
            $themeAccent = '#facc15';
        }

        // Provide a simple associative array of key => value to templates
        try {
            $settings_values = $settings->mapWithKeys(function ($item, $key) {
                return [$key => $item->value ?? null];
            })->toArray();
        } catch (\Throwable $e) {
            $settings_values = [];
        }

        View::share('settings', $settings);
        View::share('settings_values', $settings_values);
        View::share('theme_primary_value', $themePrimary);
        View::share('theme_secondary_value', $themeSecondary);
        View::share('theme_accent_value', $themeAccent);
    }
}
