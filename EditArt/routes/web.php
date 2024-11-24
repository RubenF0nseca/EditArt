<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage');
})->name('home');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});

Route::resource('users', UserController::class);
Route::resource('books', BookController::class);
