<?php

use App\Http\Controllers\FoundItemController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::redirect('/home', '/', 301);

// report page
Route::get('/found', [FoundItemController::class, 'create'])->name('found-items.create');