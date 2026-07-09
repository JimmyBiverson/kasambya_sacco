<?php

namespace App\Providers;

use App\Models\Application;
use App\Models\Branch;
use App\Models\Contact;
use App\Models\Faq;
use App\Models\Loan;
use App\Models\LoanProduct;
use App\Models\LoginHistory;
use App\Models\Member;
use App\Models\NewsEvent;
use App\Models\Page;
use App\Models\Partner;
use App\Models\SavingsAccount;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Slide;
use App\Models\TeamMember;
use App\Models\User;
use App\Observers\AuditObserver;
use App\Services\SettingService;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        try {
            $settingService = app(SettingService::class);
            $timeout = $settingService->get('session_timeout', 1800);
            config(['session.lifetime' => (int) ($timeout / 60)]);
        } catch (\Exception $e) {
            Log::error('Failed to load session timeout setting', ['error' => $e->getMessage()]);
        }

        // Register AuditObserver on auditable models
        $auditableModels = [
            Member::class, Loan::class, SavingsAccount::class, User::class,
            Branch::class, LoanProduct::class, Setting::class, Slide::class,
            Page::class, NewsEvent::class, Faq::class, Partner::class,
            Service::class, TeamMember::class, Application::class, Contact::class,
        ];
        foreach ($auditableModels as $model) {
            $model::observe(AuditObserver::class);
        }

        // Record login events in login_histories
        $this->app['events']->listen(Login::class, function (Login $event) {
            try {
                LoginHistory::create([
                    'user_id' => $event->user->id,
                    'ip_address' => request()->ip(),
                    'user_agent' => request()->userAgent(),
                    'success' => true,
                ]);
            } catch (\Exception $e) {
                Log::error('Failed to record login history', ['error' => $e->getMessage()]);
            }
        });

        View::composer('layouts.admin', function ($view) {
            try {
                $adminNotifications = Cache::remember('admin.notifications', 30, function () {
                    return [
                        'pending_applications' => Application::where('status', 'pending')->count(),
                        'unread_contacts' => Contact::where('is_read', false)->count(),
                        'pending_members' => Member::where('status', 'pending')->count(),
                    ];
                });
            } catch (\Exception $e) {
                Log::error('Failed to load admin notifications', ['error' => $e->getMessage()]);
                $adminNotifications = [
                    'pending_applications' => 0,
                    'unread_contacts' => 0,
                    'pending_members' => 0,
                ];
            }

            $view->with('adminNotifications', $adminNotifications);
        });

        // Share site settings globally with ALL views (layouts + child views)
        View::composer('*', function ($view) {
            static $shared = false;
            if ($shared) return;
            $shared = true;

            try {
                $settings = Cache::remember('site.settings', 300, function () {
                    return Setting::all()->keyBy('key');
                });
            } catch (\Exception $e) {
                Log::error('Failed to load site settings for view', ['error' => $e->getMessage()]);
                $settings = collect();
            }

            $settings_values = $settings->mapWithKeys(fn ($s, $k) => [$k => $s->value])->toArray();

            View::share('settings',              $settings);
            View::share('settings_values',       $settings_values);
            View::share('orgName',               $settings_values['org_name']    ?? 'Kasambya SACCO');
            View::share('theme_primary_value',   $settings_values['theme_primary']   ?? '#10b981');
            View::share('theme_secondary_value', $settings_values['theme_secondary']  ?? '#06b6d4');
            View::share('theme_accent_value',    $settings_values['theme_accent']     ?? '#facc15');
        });
    }
}
