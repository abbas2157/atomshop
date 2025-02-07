<?php

use Illuminate\Support\Facades\Route;
Route::get('/shop', [App\Http\Controllers\Web\HomeController::class, 'shop_products'])->name('shop.products');
Route::post('/shop/filter', [App\Http\Controllers\Web\HomeController::class, 'filter'])->name('products.filter');

Route::get('/', [App\Http\Controllers\Web\HomeController::class, 'home'])->name('website');
Route::get('/{slug}', [App\Http\Controllers\Web\HomeController::class, 'product_detail'])->name('product.detail');
