<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AdController as AdminAdController;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboardController;
use App\Http\Controllers\Customer\AdController as CustomerAdController;
use App\Models\Ad;
use App\Http\Controllers\Front\AdController as FrontAdController;

// FRONT OGLASI (gost, customer, svi)
Route::get('/', [FrontAdController::class, 'index'])
    ->name('front.ads.index');

Route::get('/kategorija/{category}', [FrontAdController::class, 'category'])
    ->name('front.ads.category');

Route::get('/oglas/{ad}', [FrontAdController::class, 'show'])
    ->name('front.ads.show');
/**
 * CUSTOMER DASHBOARD
 */
Route::get('/dashboard', [CustomerDashboardController::class, 'index'])
    ->middleware(['auth', 'verified', 'prevent-back-history'])
    ->name('dashboard');

/**
 * Breeze profil rute
 */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/**
 * ADMIN ROUTES
 */
Route::middleware(['auth', 'verified', 'admin', 'prevent-back-history'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('customers', CustomerController::class)
            ->parameters(['customers' => 'customer']);

        Route::resource('categories', CategoryController::class);

        Route::resource('ads', AdminAdController::class);
    });

/**
 * CUSTOMER ROUTES
 */
Route::middleware(['auth', 'verified', 'prevent-back-history'])->group(function () {
    Route::resource('my-ads', CustomerAdController::class)
        ->names('customer.ads')
        ->parameters(['my-ads' => 'my_ad'])
        ->except(['show']);
});

require __DIR__.'/auth.php';
