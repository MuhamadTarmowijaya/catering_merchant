<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\CustomerController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/merchant/dashboard', [MerchantController::class, 'dashboard'])->middleware('auth')->name('merchant.dashboard');
Route::get('/merchant/profile', [MerchantController::class, 'profile'])->middleware('auth')->name('merchant.profile');
Route::post('/merchant/profile', [MerchantController::class, 'updateProfile'])->middleware('auth')->name('merchant.updateProfile');


Route::get('/customer/dashboard', [CustomerController::class, 'dashboard'])->middleware('auth')->name('customer.dashboard');

Route::resource('menus', MenuController::class)->middleware('auth');


