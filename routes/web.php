<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/complete-profile', function () {
    return view('auth.complete-profile');
})->name('complete-profile');

// Normal Admin Route
Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

// Super Admin Route
Route::prefix('superadmin')->group(function () {
    Route::get('/', function () {
        return view('admin.super.manage-admins');
    })->name('superadmin.dashboard');
});
