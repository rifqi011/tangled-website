<?php

use App\Http\Controllers\FoundItemController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LostItemController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::redirect('/home', '/', 301);

// found items page
Route::get('/found-items', [FoundItemController::class, 'index'])->name('found-items.index');

// report page
Route::get('/found', [FoundItemController::class, 'create'])->name('found-items.create');
Route::post('/found/store', [FoundItemController::class, 'store'])->name('found-items.store');

// report lost page
Route::get('/lost', [LostItemController::class, 'create'])->name('lost-items.create');
Route::post('/lost/store', [LostItemController::class, 'store'])->name('lost-items.store');

// Search page
Route::get('/search', [SearchController::class, 'index'])->name('search.index');