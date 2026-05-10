<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SiteController::class, 'home'])->name('home');
Route::get('/about', [SiteController::class, 'about'])->name('about');
Route::get('/history', [SiteController::class, 'history'])->name('history');
Route::get('/message-from-manager', [SiteController::class, 'managerMessage'])->name('manager-message');
Route::get('/services', [SiteController::class, 'services'])->name('services');
Route::get('/loan-products', [SiteController::class, 'loanProducts'])->name('loan-products');
Route::get('/msacco', [SiteController::class, 'msacco'])->name('msacco');
Route::get('/news', [SiteController::class, 'news'])->name('news');
Route::get('/news/{slug}', [SiteController::class, 'newsShow'])->name('news.show');
Route::get('/careers', [SiteController::class, 'careers'])->name('careers');
Route::get('/contact', [SiteController::class, 'contact'])->name('contact');
Route::post('/contact', [SiteController::class, 'contactSubmit'])->name('contact.submit');
Route::get('/apply', [SiteController::class, 'application'])->name('application');
Route::post('/apply', [SiteController::class, 'applicationSubmit'])->name('application.submit');
Route::get('/reports', [SiteController::class, 'reports'])->name('reports');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
