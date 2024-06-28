<?php

use App\Http\Controllers\ActionsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewsController;
use App\Http\Controllers\CartController;

Route::get('/', [ViewsController::class, 'index'])->name('index');
Route::get('/register', [ViewsController::class, 'register'])->name('register')->middleware('guest');
Route::get('/login', [ViewsController::class, 'login'])->name('login')->middleware('guest');
Route::post('/register', [ActionsController::class, 'register']);
Route::post('/login', [ActionsController::class, 'login']);
Route::get('/logout', [ActionsController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('/profile', [ViewsController::class, 'profile'])->name('profile')->middleware('auth');
Route::get('/basket', [ViewsController::class, 'basket'])->name('basket')->middleware('auth');
Route::get('/category/{category}', [ViewsController::class, 'category'])->name('category.show');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add')->middleware('auth');
Route::post('/cart/decrease/{product}', [CartController::class, 'decrease'])->name('cart.decrease')->middleware('auth');
Route::post('/cart/increase/{product}', [CartController::class, 'increase'])->name('cart.increase')->middleware('auth');
Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout')->middleware('auth');
Route::put('/profile', [ActionsController::class, 'profile_update'])->name('profile.update')->middleware('auth');
Route::post('/receipts/{id}/review', [ActionsController::class, 'create_review'])->name('receipts.review')->middleware('auth');