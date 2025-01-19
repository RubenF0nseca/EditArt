<?php


use App\Http\Controllers\API\BookApiController;
use App\Http\Controllers\API\LoginApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('login', [LoginApiController::class,'login'])->name("api.login");
Route::get('books', [BookApiController::class, 'getBooks'])->name("api.books");
Route::get('books/{id}', [BookApiController::class, 'getBook'])->name("api.book");
