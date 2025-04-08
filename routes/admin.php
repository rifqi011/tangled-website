<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin', function () {
    return view('admin.dashboard');
});
Route::get('/admin/dashboard', function () {
    return redirect('/admin', 301);
});

Route::get('/admin/settings', function () {
    return view('admin.dashboard');
});

Route::get('/login', function () {
    return view('admin.auth.login');
});