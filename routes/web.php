<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return '<h1>25.12.3722 - Muhammad Asifurrohman</h1>';
});

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

