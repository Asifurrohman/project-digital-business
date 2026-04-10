<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return '<h1>25.12.3722 - Muhammad Asifurrohman</h1>';
});

Route::get('/about', function () {
    return '<h1>Halaman About EventHub</h1>';
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/catalog', function () {
    return view('catalog');
});

Route::get('/bantuan', function () {
    return view('bantuan');
});

Route::get('/profile', function () {
    return view('profil');
});

