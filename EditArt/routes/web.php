<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage', ['books' => \App\Models\Book::all()]);
})->name('home');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});

Route::resource('users', UserController::class);

Route::resource('books', BookController::class);

Route::resource('authors', AuthorController::class);

Route::resource('reviews', ReviewController::class);

Route::resource('posts', PostController::class);
