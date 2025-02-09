<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\Forum\ForumController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\Client\OrderHistoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Store\CartController;
use App\Http\Controllers\Store\PayPalController;
use App\Http\Controllers\Store\SalesController;
use App\Http\Controllers\Store\WishlistController;
use App\Http\Controllers\UserController;
use App\Mail\EmailEditArt;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\LanguageController;

Route::get('/', function () {
    return view('homepage', ['books' => \App\Models\Book::all()]);
})->name('home');

Route::get('/lang/{locale}',function (String $locale){
    if(in_array($locale,['pt','en'])){
        //Definir o idioma
        session()->put('locale',$locale);
    }else
        session()->put('locale','pt');

    return redirect()->back();

})->name('lang.switch');

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

            Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
            Route::get('/forum/{post}', [ForumController::class, 'show'])->name('forum.show');
            Route::post('/forum/topic', [ForumController::class, 'store'])->name('forum.topic.store');
            Route::post('/forum/{post}/comment', [ForumController::class, 'storeComment'])->name('forum.comment.store');

            Route::get('/profile', function () {
                return view('client.profile');
            })->name('profile');

            Route::post('/books/{book}', [SalesController::class, 'createBookReview'])->name('reviews.store');
            Route::put('/books/{book}/review/{review}', [SalesController::class, 'updateBookReview'])->name('review.update');
            Route::delete('/books/{book}/review/{review}', [SalesController::class, 'deleteBookReview'])->name('review.delete');

            Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile');

            Route::get('/order-history/{id}', [OrderHistoryController::class, 'show'])->name('order.history');

            Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
            Route::post('/wishlist/add/{bookId}', [WishlistController::class, 'add'])->name('wishlist.add');
            Route::delete('/wishlist/remove/{bookId}', [WishlistController::class, 'remove'])->name('wishlist.remove');
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


Route::get('/guest/authors', function () {
    return view('guest.authors');
})->name('guest.authors');

Route::get('/publisher', function () {
    return view('publisher.publisher');
})->name('publisher');

Route::get('/guest/books', [SalesController::class, 'index'])->name('guest.books');
Route::get('/books/{book}', [SalesController::class, 'showBook'])->name('book');

Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart');
Route::get('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/update', [CartController::class, 'updateQuantity'])->name('cart.update');
//Route::get('/confirmation', function () {return view('cart.confirmation');})->name('confirmation');
Route::get('/cart/order', [CartController::class, 'orderConfirmation'])->name('cart.order');
// Endpoint para completar o pagamento
Route::post('/payment/complete', [PayPalController::class, 'completePayment'])->name('payment.complete');

// Página de confirmação final do pedido
Route::get('/order/confirmation', [PayPalController::class, 'orderConfirmation'])->name('order.confirmation');

