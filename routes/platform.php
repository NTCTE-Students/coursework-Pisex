<?php

declare(strict_types=1);

use App\Orchid\Screens\Products\Product\ProductsEditScreen;
use App\Orchid\Screens\Products\Product\ProductsListScreen;
use Illuminate\Support\Facades\Route;
use App\Orchid\Screens\Products\Category\CategoriesListScreen;
use App\Orchid\Screens\Products\Category\CategoriesEditScreen;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
Route::screen('/main', CategoriesListScreen::class)
    ->name('platform.main');

Route::screen('/categories', CategoriesListScreen::class)->name('platform.category.list');
Route::screen('/category/{category?}', CategoriesEditScreen::class)->name('platform.category.edit');

Route::screen('/products', ProductsListScreen::class)->name('platform.product.list');
Route::screen('/product/{product?}', ProductsEditScreen::class)->name('platform.product.edit');

//Route::screen('idea', Idea::class, 'platform.screens.idea');
