<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\SiteSettingsController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Public\BirthdayController;
use App\Http\Controllers\Public\InquirySubmissionController;
use App\Http\Controllers\Public\SitemapController;
use App\Http\Middleware\EnsureAdminRole;
use App\Http\Middleware\SecurityHeaders;
use Illuminate\Support\Facades\Route;

Route::middleware(SecurityHeaders::class)->group(function (): void {
    // Public birthday experience.
    Route::get('/', [BirthdayController::class, 'welcome'])->name('home');
    Route::get('/welcome', [BirthdayController::class, 'welcome'])->name('birthday.welcome');
    Route::get('/birthday', [BirthdayController::class, 'show'])->name('birthday.show');
    Route::get('/sitemap.xml', SitemapController::class)->name('sitemap');
    Route::post('/inquiries', [InquirySubmissionController::class, 'store'])
        ->middleware('throttle:5,1')
        ->name('inquiries.store');

    // Legacy section links all resolve to the single-page birthday experience.
    Route::get('/{section}', [BirthdayController::class, 'section'])
        ->where('section', 'love-letter|reasons|memories|our-story|wishes|celebration|surprises|our-future|final-message')
        ->name('birthday.section');

    // Authentication endpoints.
    Route::middleware('guest')->group(function (): void {
        Route::get('/admin/login', [AdminLoginController::class, 'create'])->name('login');
        Route::post('/admin/login', [AdminLoginController::class, 'store'])
            ->middleware('throttle:10,1')
            ->name('admin.login.store');
    });

    Route::post('/admin/logout', [AdminLoginController::class, 'destroy'])
        ->middleware('auth')
        ->name('admin.logout');

    // All authenticated admin/editor accounts can manage birthday content and inquiries.
    Route::prefix('admin')
        ->name('admin.')
        ->middleware(['auth', EnsureAdminRole::class])
        ->group(function (): void {
            Route::get('/dashboard', AdminDashboardController::class)->name('dashboard');

            Route::get('/content/{type}', [ContentController::class, 'index'])->name('content.index');
            Route::get('/content/{type}/create', [ContentController::class, 'create'])->name('content.create');
            Route::post('/content/{type}', [ContentController::class, 'store'])->name('content.store');
            Route::get('/content/{type}/{id}/edit', [ContentController::class, 'edit'])->whereNumber('id')->name('content.edit');
            Route::put('/content/{type}/{id}', [ContentController::class, 'update'])->whereNumber('id')->name('content.update');
            Route::delete('/content/{type}/{id}', [ContentController::class, 'destroy'])->whereNumber('id')->name('content.destroy');

            Route::get('/inquiries', [InquiryController::class, 'index'])->name('inquiries.index');
            Route::get('/inquiries/{inquiry}', [InquiryController::class, 'show'])->name('inquiries.show');
            Route::put('/inquiries/{inquiry}', [InquiryController::class, 'update'])->name('inquiries.update');

            // Only administrators can manage users, global settings, or delete inquiries.
            Route::middleware(EnsureAdminRole::class . ':admin')->group(function (): void {
                Route::get('/users', [UserManagementController::class, 'index'])->name('users.index');
                Route::get('/users/create', [UserManagementController::class, 'create'])->name('users.create');
                Route::post('/users', [UserManagementController::class, 'store'])->name('users.store');
                Route::get('/users/{user}/edit', [UserManagementController::class, 'edit'])->name('users.edit');
                Route::put('/users/{user}', [UserManagementController::class, 'update'])->name('users.update');
                Route::delete('/users/{user}', [UserManagementController::class, 'destroy'])->name('users.destroy');
                Route::get('/settings', [SiteSettingsController::class, 'edit'])->name('settings.edit');
                Route::put('/settings', [SiteSettingsController::class, 'update'])->name('settings.update');
                Route::delete('/inquiries/{inquiry}', [InquiryController::class, 'destroy'])->name('inquiries.destroy');
            });
        });
});
