<?php

namespace App\Providers;

use App\Models\Setting;
use App\Services\SettingService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Override session lifetime from Setting if available
        try {
            $settingService = app(SettingService::class);
            $timeout = $settingService->get('session_timeout', 1800);
            config(['session.lifetime' => (int) ($timeout / 60)]);
        } catch (\Exception $e) {
            // Default session lifetime from config/session.php
        }

        // Share settings with all public views
        try {
            $allSettings = Setting::all()->keyBy('key');
            View::share('settings', $allSettings);
        } catch (\Exception $e) {
            View::share('settings', collect());
        }

        // Share admin notification totals with the admin layout
        View::composer('layouts.admin', function ($view) {
            try {
                $adminNotifications = [
                    'pending_applications' => \App\Models\Application::where('status', 'pending')->count(),
                    'unread_contacts' => \App\Models\Contact::where('is_read', false)->count(),
                    'pending_members' => \App\Models\Member::where('status', 'pending')->count(),
                ];
            } catch (\Exception $e) {
                $adminNotifications = [
                    'pending_applications' => 0,
                    'unread_contacts' => 0,
                    'pending_members' => 0,
                ];
            }

            $view->with('adminNotifications', $adminNotifications);
        });
    }
}
