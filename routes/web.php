<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/event/1', [EventController::class, 'show'])->name('events.show');
Route::get('/checkout', [EventController::class, 'checkout'])->name('checkout');

Route::get('/tentang', function () {
    return '<h1>Halaman tentang EventHub</h1>';
});

Route::get('/kontak', function () {
    return view('kontak');
});

Route::get('/katalog', function () {
    return view('katalog');
});

Route::get('/bantuan', function () {
    return view('bantuan');
});

Route::get('/profil', function () {
    return view('profil');
});

