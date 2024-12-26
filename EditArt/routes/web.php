<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage', ['books' => \App\Models\Book::all()]);
})->name('home');

//login
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
//logout
Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::get('/guest/authors', function () {
    return view('guest.authors');
})->name('guest.authors');

Route::get('/guest/books', function () {
    return view('guest.books', ['books' => \App\Models\Book::paginate(12)]);
})->name('guest.books');

Route::get('/client/book', function () {
    return view('client.book');
})->name('client.book');

Route::get('/client/profile', function () {
    return view('client.profile');
})->name('client.profile');

Route::get('/client/wishlist', function () {
    return view('client.wishlist');
})->name('client.wishlist');

Route::get('/client/cart', function () {
    return view('client.cart');
})->name('client.cart');

Route::get('/client/forum', function () {
    return view('client.forum');
})->name('client.forum');

Route::get('/registration', function () {
    return view('registration.show');
})->name('registration');

Route::resource('users', UserController::class);

Route::resource('books', BookController::class);

Route::resource('authors', AuthorController::class);

Route::resource('reviews', ReviewController::class);

Route::resource('posts', PostController::class);

Route::resource('comments', CommentController::class);

Route::resource('genres', GenreController::class)->except('show');
