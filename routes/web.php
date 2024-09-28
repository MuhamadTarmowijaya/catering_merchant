<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MenuController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Merchant routes
Route::middleware('auth')->prefix('merchant')->group(function () {
    Route::get('/dashboard', [MerchantController::class, 'dashboard'])->name('merchant.dashboard');
    Route::get('/profile', [MerchantController::class, 'profile'])->name('merchant.profile');
    Route::post('/profile/update', [MerchantController::class, 'updateProfile'])->name('merchant.profile.update');
});

// Menu routes
Route::middleware('auth')->resource('menus', MenuController::class);


Route::prefix('customer')->group(function () {
    Route::get('/menus', [CustomerController::class, 'index'])->name('customer.menus.index');
    Route::get('/cart', [CustomerController::class, 'cart'])->name('customer.cart');
    Route::get('/cart/add/{id}', [CustomerController::class, 'addToCart'])->name('customer.cart.add');
    Route::get('/cart/remove/{id}', [CustomerController::class, 'removeFromCart'])->name('customer.cart.remove');
    Route::get('/checkout', [CustomerController::class, 'checkout'])->name('customer.checkout');
    Route::get('/orders', [CustomerController::class, 'orders'])->name('customer.orders');
    Route::get('/menus/search', [CustomerController::class, 'search'])->name('customer.menus.search');
});

// Route::get('/search-catering', [CateringController::class, 'search'])->name('search.catering');



