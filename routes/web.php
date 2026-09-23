<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminManagementController;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberAuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products/{slug}/shopee', [ProductController::class, 'shopeeRedirect'])->name('products.shopee');

Route::prefix('member')->name('member.')->group(function (): void {
    Route::get('/login', [MemberAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [MemberAuthController::class, 'login'])->name('login.submit');
    Route::get('/register', [MemberAuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [MemberAuthController::class, 'register'])->name('register.submit');
    Route::middleware('auth:member')->group(function (): void {
        Route::get('/dashboard', [MemberAuthController::class, 'dashboard'])->name('dashboard');
        Route::post('/logout', [MemberAuthController::class, 'logout'])->name('logout');
    });
});

Route::prefix('admin')->name('admin.')->group(function (): void {
    Route::get('/', fn (): RedirectResponse => redirect()->route('admin.login'))->name('root');
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    Route::get('/register', [AdminAuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AdminAuthController::class, 'register'])->name('register.submit');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function (): void {
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('products')->name('products.')->group(function (): void {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/', [ProductController::class, 'store'])->name('store');
        Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit');
        Route::put('/{product}', [ProductController::class, 'update'])->name('update');
        Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy');
    });

    Route::patch('/members/{id}/status', [AdminManagementController::class, 'updateMemberStatus'])->name('members.status');
    foreach (['gallery', 'articles', 'members', 'partnerships', 'users'] as $module) {
        Route::get("/{$module}", [AdminManagementController::class, 'index'])->defaults('module', $module)->name("{$module}.index");
        if ($module !== 'members') {
            Route::get("/{$module}/create", [AdminManagementController::class, 'create'])->defaults('module', $module)->name("{$module}.create");
            Route::post("/{$module}", [AdminManagementController::class, 'store'])->defaults('module', $module)->name("{$module}.store");
            Route::get("/{$module}/{id}/edit", [AdminManagementController::class, 'edit'])->defaults('module', $module)->name("{$module}.edit");
            Route::put("/{$module}/{id}", [AdminManagementController::class, 'update'])->defaults('module', $module)->name("{$module}.update");
            Route::delete("/{$module}/{id}", [AdminManagementController::class, 'destroy'])->defaults('module', $module)->name("{$module}.destroy");
        }
    }

    Route::get('/analytics/website', [AnalyticsController::class, 'website'])->name('analytics.website');
    Route::get('/analytics/marketplace', [AnalyticsController::class, 'marketplace'])->name('analytics.marketplace');
    Route::get('/analytics/members', [AnalyticsController::class, 'members'])->name('analytics.members');
    Route::get('/reports', [AnalyticsController::class, 'reports'])->name('reports');
    Route::get('/settings', [AdminManagementController::class, 'settings'])->name('settings');
    Route::post('/settings', [AdminManagementController::class, 'updateSettings'])->name('settings.update');
});
