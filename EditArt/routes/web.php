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

//logout
Route::post('/logout', [LoginController::class,'logout'])->name('logout')
    ->middleware('auth');


Route::middleware('role:admin')->group(function (){
    Route::prefix('/admin')->group(function (){
        Route::name('admin.')->group(function (){

            Route::get('/dashboard', function () {
                return view('admin.dashboard');
            })->name('dashboard');

            Route::get('/dashboard',[DashboardController::class,'admin'])->name('dashboard');

            Route::resource('users', UserController::class);

            Route::resource('books', BookController::class);

            Route::resource('authors', AuthorController::class);

            Route::resource('reviews', ReviewController::class);

            Route::resource('posts', PostController::class);

            Route::resource('comments', CommentController::class);

            Route::resource('genres', GenreController::class)->except('show');

            Route::get('/mail-compose', function () {
                return view('mails.mail-compose');
            });
        });
    });
});

Route::middleware('role:cliente|admin')->group(function (){
    Route::prefix('/client')->group(function (){
        Route::name('client.')->group(function (){

            Route::get('/profile', function () {
                return view('client.profile');
            })->name('profile');

            Route::get('/wishlist', function () {
                return view('client.wishlist');
            })->name('wishlist');

            Route::get('/cart', function () {
                return view('client.cart');
            })->name('cart');

            Route::get('/forum', function () {
                return view('client.forum');
            })->name('forum');

        });
    });
});

Route::middleware('guest')->group(function () {
    Route::prefix('')->group(function () {
        Route::name('')->group(function () {
            //registo
            Route::get('/registration', function () {
                return view('registration.show');
            })->name('registration');
            Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
            //login
            Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
            Route::post('/login', [LoginController::class, 'login']);

        });
    });
});


Route::get('/book', function () {
    return view('client.book');
})->name('book');

Route::get('/guest/authors', function () {
    return view('guest.authors');
})->name('guest.authors');

Route::get('/guest/books', function () {
    return view('guest.books', ['books' => \App\Models\Book::paginate(12)]);
})->name('guest.books');


//EMAIL
Route::get('/send-email', function(){
    Mail::to('lucas.ss.patricio@gmail.com')->send(new EmailEditArt("Lucas", "Olá esta é uma mensagem"));

    return "Email enviado com sucesso";
});
