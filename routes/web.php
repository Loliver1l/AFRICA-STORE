<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ShopController::class, 'home'])->name('home');
Route::get('/store', [ShopController::class, 'index'])->name('store');
Route::get('/products/{product:slug}', [ShopController::class, 'show'])->name('products.show');
Route::get('/available', [ShopController::class, 'available'])->name('products.available');
Route::get('/coming-soon', [ShopController::class, 'comingSoon'])->name('products.coming-soon');
Route::get('/search', [ShopController::class, 'search'])->name('products.search');

Route::middleware('auth')->group(function () {
    Route::view('/dashboard', 'account.dashboard')->name('dashboard');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/{product}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{product}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
});
