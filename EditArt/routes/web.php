<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage');
})->name('home');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/client/dashboard', function () {
    return view('client.dashboard');
});

Route::resource('tipos', TipoObraController::class);


Route::resource('autores', AuthorController::class)
    ->parameters(['autores' => 'autor']);
