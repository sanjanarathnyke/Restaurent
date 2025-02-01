<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\BookingTableController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ConsumerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\orderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RegisterdController;
use App\Http\Controllers\WelcomeController;
use App\Models\Category;
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


Route::get('/bill', [CheckoutController::class, 'showBill'])->name('showbill');


/* this troute is for the submit custoemer informations */
Route::post('/consumer/store', [ConsumerController::class, 'store'])->name('consumer.store');

Route::get('/dashboard/customers',[ConsumerController::class,'Display'])->name('showcustomers');


Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);

Route::get('dashboard', function () {
    return view('dashboard'); // Create a dashboard view
})->middleware('is_admin')->name('dashboard');

Route::get('/form',function(){
    return view('form-submit');
});

Route::post('/menu_items', [MenuController::class, 'store'])->name('menu_items.store');



Route::get('/categories', [DashboardController::class, 'getCategories']);
Route::get('/dashboard',[DashboardController::class,'categoryitems']);

Route::post('/saveitems', [DashboardController::class, 'saveMenuItem'])->name('save-items');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

Route::delete('/delete-item/{id}', [DashboardController::class, 'deleteItem']);

Route::get('/dashboard/getorders',[DashboardController::class,'fetchorders'])->name('fetch-orders');

Route::get('/dashboard/chart',[orderController::class,'showChart'])->name('report');


Route::get('/dashboard/mails',[ConsumerController::class,'ViewPage'])->name('showmails');

Route::post('/dashboard/sendmails',[ConsumerController::class,'sendEmail'])->name('send.email');