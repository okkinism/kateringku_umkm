<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Redirect::route('login');
});

Auth::routes(['verify' => true]);

Route::middleware(['admin'])->group(function() {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/menu/create', [MenuController::class, 'create_menu'])->name('create_menu');
    Route::post('/menu/create', [MenuController::class, 'store_menu'])->name('store_menu');
    Route::get('/menu/{menu}/edit', [MenuController::class, 'edit_menu'])->name('edit_menu');
    Route::patch('/menu/{menu}/update', [MenuController::class, 'update_menu'])->name('update_menu');
    Route::delete('/menu/{menu}', [MenuController::class, 'delete_menu'])->name('delete_menu');
    Route::get('/menu/{menu}/dish', [MenuController::class, 'add_dishes'])->name('add_dishes');
    Route::post('/menu/{menu}/dish', [MenuController::class, 'store_dish'])->name('store_dish');
    Route::delete('/dish/{dish}', [MenuController::class, 'delete_dish'])->name('delete_dish');
});

Route::middleware(['auth', 'verified'])->group(function(){
    Route::get('/menu', [MenuController::class, 'index_menu'])->name('index_menu');
    Route::get('/menu/{menu}', [MenuController::class, 'show_detail'])->name('show_detail');
    Route::post('/cart/{menu}', [CartController::class, 'add_to_cart'])->name('add_to_cart');
    Route::get('/cart', [CartController::class, 'show_cart'])->name('show_cart');
    Route::patch('/cart/{cart}', [CartController::class, 'update_cart'])->name('update_cart');
    Route::delete('/cart/{cart}', [CartController::class, 'delete_cart'])->name('delete_cart');
    Route::get('/create_checkout', [OrderController::class, 'create_checkout'])->name('create_checkout');
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::delete('/cancel/{order}', [OrderController::class, 'cancel_checkout'])->name('cancel_checkout');
    Route::get('/invoice/{order}', [OrderController::class, 'invoice'])->name('invoice');
    Route::get('/create_checkout/{order}', [OrderController::class, 'show_order'])->name('show_order');
    Route::get('/profile', [ProfileController::class, 'show_profile'])->name('show_profile');
    Route::post('/profile', [ProfileController::class, 'edit_profile'])->name('edit_profile');
});
