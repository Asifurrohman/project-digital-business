<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MidtransWebhookController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

Route::get('/login', function(){
    return redirect()->route('admin.login');
})->name('login');

Route::prefix('admin')->name('admin.')->group(function(){
    Route::get('/login', [AuthController::class, 'showLogin'])->middleware('guest')->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware(['auth', 'admin', 'prevent-back-history'])->group(function(){
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        // Route::get('/events', [EventController::class, 'indexAdmin'])->name('events.index');
        // Route::get('/transactions', [EventController::class, 'transactions'])->name('transactions');
        // Route::get('/categories', [EventController::class, 'categories'])->name('categories');

        Route::resource('/events', AdminEventController::class);
        Route::resource('/categories', CategoryController::class);
        Route::resource('/partners', PartnerController::class);
        Route::resource('/transactions', TransactionController::class);
    });
});

Route::get('/checkout/{event}', [CheckoutController::class, 'create'])->name('checkout.create');
Route::post('/checkout/{event}', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/payment/{order_id}', [CheckoutController::class, 'payment'])->name('checkout.payment');
// Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
Route::get('/success/{order_id}', [CheckoutController::class, 'success'])->name('checkout.success');
Route::post('/midtrans/callback', [MidtransWebhookController::class, 'handle']);



Route::get('/', [HomeController::class, 'index'])->name('home');
// Route::get('/checkout', [EventController::class, 'checkout'])->name('checkout');
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

