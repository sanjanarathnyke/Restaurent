<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\BookingTableController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/',[WelcomeController::class,'index'])->name('welcome');

Route::get('/menu',[MenuController::class,'menu'])->name('menu');

Route::get('/cart',[CartController::class,'index'])->name('cart');

Route::post('/cart/add',[CartController::class,'addToCart'])->name('cart.add');

Route::get('cart/remove/{id}',[CartController::class,'removeFromCart'])->name('cart.remove');

Route::get('/checkout',[WelcomeController::class,'checkout'])->name('checkout');

Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');

Route::post('/cart/update-multiple', [CartController::class, 'updateMultiple'])->name('cart.updateMultiple');

Route::post('/book-table', [BookingTableController::class, 'store'])->name('book.table');

