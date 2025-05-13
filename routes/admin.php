<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SuperAdminController;
use App\Http\Controllers\Admin\ReportsController;

// Dashboard page with auth
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/dashboard/reports', [ReportsController::class, 'index'])->name('reports');

    // Reports management
    Route::get('/reports/{type}/{slug}', [ReportsController::class, 'show'])->name('reports.show');
    Route::get('/reports/{type}/{slug}/edit', [ReportsController::class, 'edit'])->name('reports.edit');
    Route::put('/reports/{type}/{slug}', [ReportsController::class, 'update'])->name('reports.update');
    Route::delete('/reports/{type}/{slug}', [ReportsController::class, 'destroy'])->name('reports.destroy');

    Route::middleware('superadmin')->group(function () {
        // Master data management routes
        Route::get('/masterdata', [SuperAdminController::class, 'index'])->name('masterdata.index');

        // Admin management
        Route::get('/masterdata/admin/create', [SuperAdminController::class, 'createAdmin'])->name('masterdata.admin.create');
        Route::post('/masterdata/admin', [SuperAdminController::class, 'storeAdmin'])->name('masterdata.admin.store');
        Route::get('/masterdata/admin/{admin}/edit', [SuperAdminController::class, 'editAdmin'])->name('masterdata.admin.edit');
        Route::put('/masterdata/admin/{admin}', [SuperAdminController::class, 'updateAdmin'])->name('masterdata.admin.update');
        Route::delete('/masterdata/admin/{admin}', [SuperAdminController::class, 'destroyAdmin'])->name('masterdata.admin.destroy');

        // Category management
        Route::post('/masterdata/category', [SuperAdminController::class, 'storeCategory'])->name('masterdata.category.store');
        Route::put('/masterdata/category/{category}', [SuperAdminController::class, 'updateCategory'])->name('masterdata.category.update');
        Route::delete('/masterdata/category/{category}', [SuperAdminController::class, 'destroyCategory'])->name('masterdata.category.destroy');

        // Class management
        Route::post('/masterdata/class', [SuperAdminController::class, 'storeClass'])->name('masterdata.class.store');
        Route::put('/masterdata/class/{class}', [SuperAdminController::class, 'updateClass'])->name('masterdata.class.update');
        Route::delete('/masterdata/class/{class}', [SuperAdminController::class, 'destroyClass'])->name('masterdata.class.destroy');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
