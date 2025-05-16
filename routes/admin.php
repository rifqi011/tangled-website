<?php

use App\Http\Controllers\Admin\LostItemFoundController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SuperAdminController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Admin\VerifyController;
use App\Http\Controllers\Admin\ReportVerificationController;
use App\Http\Controllers\Admin\RetrievalController;

// Dashboard page with auth
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Reports verification
    Route::get('/dashboard/verify', [VerifyController::class, 'index'])->name('verify');
    Route::get('/dashboard/verify/{type}/{slug}', [VerifyController::class, 'show'])->name('verify.show');

    // Report verification and decline routes
    Route::post('/reports/{type}/{slug}/verify', [ReportVerificationController::class, 'verify'])->name('reports.verify');
    Route::post('/reports/{type}/{slug}/decline', [ReportVerificationController::class, 'decline'])->name('reports.decline');

    Route::get('/dashboard/reports', [ReportsController::class, 'index'])->name('reports');

    // Reports show
    Route::get('/reports/{type}/{slug}', [ReportsController::class, 'show'])->name('reports.show');

    // Lost item found confirmation
    Route::get('/lost-item-found', [LostItemFoundController::class, 'index'])->name('lost-item-found');
    Route::get('/lost-item-found/{slug}', [LostItemFoundController::class, 'show'])->name('lost-item-found.show');
    Route::post('/lost-item-found/{slug}/found', [LostItemFoundController::class, 'found'])->name('lost-item-found.found');

    // Retrieval management
    Route::get('/retrievals', [RetrievalController::class, 'index'])->name('retrievals');
    Route::get('/retrievals/{slug}', [RetrievalController::class, 'show'])->name('retrievals.show');

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

        // Report management
        Route::get('/reports/{type}/{slug}/edit', [ReportsController::class, 'edit'])->name('reports.edit');
        Route::put('/reports/{type}/{slug}', [ReportsController::class, 'update'])->name('reports.update');
        Route::delete('/reports/{type}/{slug}', [ReportsController::class, 'destroy'])->name('reports.destroy');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
