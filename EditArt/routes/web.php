<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Mail\EmailEditArt;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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
            })->name('mail.compose');

            Route::post('/send-email', [EmailController::class, 'sendEmail'])->name('send.email');
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

            Route::get('/forgot', function () {
                return view('client.ForgotPassword');
            })->name('forgot');

            // Esqueceu a password
            Route::get('/forgot-password', [PasswordResetController::class, 'showForgotForm'])
                ->middleware('guest')
                ->name('password.forgot');

            // Envia o link de reset
            Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])
                ->middleware('guest')
                ->name('password.email');

            // Formulário de reset da password
            Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])
                ->middleware('guest')
                ->name('password.reset');

            // Submete o reset de password
            Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])
                ->middleware('guest')
                ->name('password.update');

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

/*Route::get('/recover', function () {
    return view('client.RecoverPassword');
})->name('recover');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::ResetLinkSent
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function (string $token, Request $request) {
    return view('client.RecoverPassword', [
        'token' => $token,
        'email' => $request->query('email'),
    ]);
})->middleware('guest')->name('password.reset');*/

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PasswordReset
        ? redirect()->route('login')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');
