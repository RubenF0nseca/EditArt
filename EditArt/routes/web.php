<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Mail\EmailEditArt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage', ['books' => \App\Models\Book::all()]);
})->name('home');

//login
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
//logout
Route::post('/logout', [LoginController::class,'logout'])->name('logout')
    ->middleware('auth');


Route::middleware('role:admin')->group(function (){
    Route::prefix('/admin')->group(function (){
        Route::name('admin.')->group(function (){

            Route::get('/admin/dashboard', function () {
                return view('admin.dashboard');
            })->name('admin.dashboard');

            Route::resource('users', UserController::class);

            Route::resource('books', BookController::class);

            Route::resource('authors', AuthorController::class);

            Route::resource('reviews', ReviewController::class);

            Route::resource('posts', PostController::class);

            Route::resource('comments', CommentController::class);

            Route::resource('genres', GenreController::class)->except('show');

        });
    });
});

Route::middleware('role:cliente')->group(function (){
    Route::prefix('/cliente')->group(function (){
        Route::name('cliente.')->group(function (){
            Route::get('/book', function () {
                return view('client.book');
            })->name('client.book');

            Route::get('/profile', function () {
                return view('client.profile');
            })->name('client.profile');

            Route::get('/wishlist', function () {
                return view('client.wishlist');
            })->name('client.wishlist');

            Route::get('/cart', function () {
                return view('client.cart');
            })->name('client.cart');

            Route::get('/forum', function () {
                return view('client.forum');
            })->name('client.forum');

        });
    });
});


Route::get('/guest/authors', function () {
    return view('guest.authors');
})->name('guest.authors');

Route::get('/guest/books', function () {
    return view('guest.books', ['books' => \App\Models\Book::paginate(12)]);
})->name('guest.books');



Route::get('/registration', function () {
    return view('registration.show');
})->name('registration');


//EMAIL
Route::get('/send-email', function(){
    Mail::to('lucas.ss.patricio@gmail.com')->send(new EmailEditArt("Lucas", "Olá esta é uma mensagem"));

    return "Email enviado com sucesso";
});
