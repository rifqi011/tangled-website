<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\FoundItemController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\LostItemController;
use App\Http\Controllers\User\SearchController;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::redirect('/home', '/', 301);

// found items page
Route::get('/found-items', [FoundItemController::class, 'index'])->name('found-items.index');
Route::get('/found-items/{slug}', [FoundItemController::class, 'show'])->name('found-items.show');

// report page
Route::get('/found', [FoundItemController::class, 'create'])->name('found-items.create');
Route::post('/found/store', [FoundItemController::class, 'store'])->name('found-items.store');

// lost items page
Route::get('lost-items', [LostItemController::class, 'index'])->name('lost-items.index');
Route::get('/lost-items/{slug}', [LostItemController::class, 'show'])->name('lost-items.show');

// report lost page
Route::get('/lost', [LostItemController::class, 'create'])->name('lost-items.create');
Route::post('/lost/store', [LostItemController::class, 'store'])->name('lost-items.store');

// Search page
Route::get('/search', [SearchController::class, 'index'])->name('search.index');

// Dashboard page with auth
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
