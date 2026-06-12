<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::get('/login', function(){
    return redirect()->route('admin.login');
})->name('login');

Route::prefix('admin')->name('admin.')->group(function(){
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware(['auth', 'admin'])->group(function(){
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/events', [EventController::class, 'indexAdmin'])->name('events.index');
        Route::get('/transactions', [EventController::class, 'transactions'])->name('transactions');
        // Route::get('/categories', [EventController::class, 'categories'])->name('categories');

        Route::resource('events', AdminEventController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('partners', PartnerController::class);
    });
});



Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/event/1', [EventController::class, 'show'])->name('events.show');
Route::get('/checkout', [EventController::class, 'checkout'])->name('checkout');
Route::get('/my-ticket', [TicketController::class, 'ticket'])->name('ticket');

// Route::group(['prefix' => 'admin', 'as' => 'admin.'], function(){
//     Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
//     Route::get('/events', [EventController::class, 'indexAdmin'])->name('events.index');
//     Route::get('/transactions', [EventController::class, 'transactions'])->name('transactions');
//     // Route::get('/categories', [EventController::class, 'categories'])->name('categories');

//     Route::resource('events', AdminEventController::class);
//     Route::resource('categories', CategoryController::class);
//     Route::resource('partners', PartnerController::class);
// });

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

