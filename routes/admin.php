<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SlideController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\NewsEventController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ApplicationController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\LoanProductController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\LoanController;
use App\Http\Controllers\Admin\SavingsAccountController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ActivityLogController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {

    // Guest routes
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login']);
    });

    // Authenticated admin routes
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/notifications/counts', [DashboardController::class, 'notificationCounts'])->name('notifications.counts');

        // Content Management
        Route::resource('slides', SlideController::class)->except(['show']);
        Route::resource('services', ServiceController::class)->except(['show']);
        Route::resource('pages', PageController::class)->except(['show']);
        Route::resource('news', NewsEventController::class)->except(['show']);
        Route::resource('team-members', TeamMemberController::class)->except(['show']);
        Route::resource('partners', PartnerController::class)->except(['show']);
        Route::resource('faqs', FaqController::class)->except(['show']);

        Route::get('contacts', [ContactController::class, 'index'])->name('contacts.index');
        Route::patch('contacts/{contact}/toggle-read', [ContactController::class, 'toggleRead'])->name('contacts.toggle-read');
        Route::delete('contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');

        Route::get('applications', [ApplicationController::class, 'index'])->name('applications.index');
        Route::patch('applications/{application}/status', [ApplicationController::class, 'updateStatus'])->name('applications.update-status');
        Route::delete('applications/{application}', [ApplicationController::class, 'destroy'])->name('applications.destroy');

        // Business CRUD
        Route::resource('branches', BranchController::class)->except(['show']);
        Route::resource('loan-products', LoanProductController::class)->except(['show']);
        Route::post('members/{member}/impersonate', [MemberController::class, 'impersonate'])->name('members.impersonate');
        Route::resource('members', MemberController::class);
        Route::resource('loans', LoanController::class)->only(['index', 'show', 'destroy']);
        Route::resource('savings', SavingsAccountController::class)->only(['index', 'show']);
        Route::patch('savings/{savings}/approve', [SavingsAccountController::class, 'approve'])->name('savings.approve');
        Route::patch('savings/{savings}/reject', [SavingsAccountController::class, 'reject'])->name('savings.reject');

        // System
        Route::resource('users', UserController::class)->except(['show']);
        Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
        Route::get('activity-log', [ActivityLogController::class, 'index'])->name('activity-log.index');
    });

    // Redirect /admin to /admin/dashboard
    Route::get('/', function () {
        if (auth()->check()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('admin.login');
    })->name('home');
});
