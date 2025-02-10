<?php


use App\Http\Controllers\API\BookApiController;
use App\Http\Controllers\API\CartApiController;
use App\Http\Controllers\API\LoginApiController;
use App\Http\Controllers\API\RegisterApiController;
use App\Http\Controllers\API\SecurityTokenApiController;
use App\Http\Controllers\API\WishlistApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('login', [LoginApiController::class,'login'])->name("api.login");
Route::post('register', [RegisterApiController::class, 'register'])->name("api.register");
Route::post('/check-token', [SecurityTokenApiController::class, 'checkToken']);
Route::get('books', [BookApiController::class, 'getBooks'])->name("api.books");
Route::get('books/{id}', [BookApiController::class, 'getBook'])->name("api.book");
Route::get('wishlist/{id}', [WishlistApiController::class, 'getWishlist'])->name("api.wishlist");
Route::post('/wishlist/{user_id}/add', [WishlistApiController::class, 'addToWishlist']);
Route::post('/wishlist/{user_id}/remove', [WishlistApiController::class, 'removeFromWishlist']);
Route::get('cart/{id}', [CartApiController::class, 'getCart'])->name("api.cart");
Route::post('/cart/{user_id}/add', [CartApiController::class, 'addToCart']);
Route::post('/cart/{user_id}/remove', [CartApiController::class, 'removeFromCart']);
