<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BookingTableController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/',[WelcomeController::class,'index'])->name('welcome');

Route::get('/menu',[MenuController::class,'menu'])->name('menu');

Route::get('/cart',[CartController::class,'index'])->name('cart');

Route::get('/cart/items',[CartController::class,'cartItems'])->name('cart.items');

Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');

Route::post('/cart/delete', [CartController::class, 'delete'])->name('cart.delete');

Route::post('/cart/add',[CartController::class,'addToCart'])->name('cart.add');

Route::get('cart/remove/{id}',[CartController::class,'removeFromCart'])->name('cart.remove');

Route::get('/checkouts',[WelcomeController::class,'checkout'])->name('checkout');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');

Route::get('/payment', [PaymentController::class, 'index'])->name('payment');


Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');

Route::post('/cart/update-multiple', [CartController::class, 'updateMultiple'])->name('cart.updateMultiple');

Route::post('/book-table', [BookingTableController::class, 'store'])->name('book.table');

// Define the route for showing the bill page
Route::get('/show', [BillController::class, 'showBill'])->name('showbill');

Route::post('/billing-details', [CustomerController::class, 'store'])->name('customer');




