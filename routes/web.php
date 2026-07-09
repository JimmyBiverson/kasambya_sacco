<?php

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

// Framework redirect for unauthenticated users (auth middleware defaults to route('login'))
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

// Public frontend routes
Route::get('/', [SiteController::class, 'home'])->name('home');
Route::get('/our-history', [SiteController::class, 'history'])->name('history');
Route::get('/about-mubende-sacco', [SiteController::class, 'about'])->name('about');
Route::get('/message-from-the-manager', [SiteController::class, 'managerMessage'])->name('manager-message');
Route::get('/reports', [SiteController::class, 'reports'])->name('reports');
Route::get('/our-services', [SiteController::class, 'services'])->name('services');
Route::get('/loan-products', [SiteController::class, 'loanProducts'])->name('loan-products');
Route::get('/msacco-services-at-mubende-sacco', [SiteController::class, 'msacco'])->name('msacco');
Route::get('/news-and-events', [SiteController::class, 'news'])->name('news');
Route::get('/news-and-events/{slug}', [SiteController::class, 'newsShow'])->name('news.show');
Route::get('/careers', [SiteController::class, 'careers'])->name('careers');
Route::get('/contact-us', [SiteController::class, 'contact'])->name('contact');
Route::post('/contact-us', [SiteController::class, 'contactSubmit'])->name('contact.submit');
Route::get('/application', [SiteController::class, 'application'])->name('application');
Route::post('/application', [SiteController::class, 'applicationSubmit'])->name('application.submit');
Route::get('/member-login', [SiteController::class, 'showMemberLogin'])->name('member.login');
Route::post('/member-login', [SiteController::class, 'memberLogin']);
// Logout has to come before the group to avoid matching /member/logout against /member/{any}
Route::post('/member/logout', [SiteController::class, 'memberLogout'])->name('member.logout');

// Member portal routes
use App\Http\Controllers\MemberController;
Route::prefix('member')->name('member.')->group(function () {
    Route::get('/dashboard', [MemberController::class, 'dashboard'])->name('dashboard');
    Route::get('/savings', [MemberController::class, 'savings'])->name('savings');
    Route::get('/open-savings', [MemberController::class, 'openSavings'])->name('open-savings');
    Route::post('/savings', [MemberController::class, 'storeSavings'])->name('savings.store');
    Route::get('/loans', [MemberController::class, 'loans'])->name('loans');
    Route::get('/transactions', [MemberController::class, 'transactions'])->name('transactions');
    Route::get('/apply-loan', [MemberController::class, 'applyLoan'])->name('apply-loan');
    Route::post('/loans', [MemberController::class, 'storeLoanApplication'])->name('loans.store');
    Route::get('/msacco', [MemberController::class, 'msacco'])->name('msacco');
    Route::get('/support', [MemberController::class, 'support'])->name('support');
    Route::get('/profile', [MemberController::class, 'profile'])->name('profile');
    Route::put('/profile', [MemberController::class, 'updateProfile'])->name('profile.update');
    Route::get('/documents', [MemberController::class, 'documents'])->name('documents');
    Route::post('/documents', [MemberController::class, 'uploadDocument'])->name('documents.upload');
});

require __DIR__.'/admin.php';
