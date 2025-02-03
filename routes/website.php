<?php

use Illuminate\Support\Facades\Route;
Route::get('/', [App\Http\Controllers\Web\HomeController::class, 'home'])->name('website');
Route::get('/{slug}', [App\Http\Controllers\Web\HomeController::class, 'product_detail'])->name('product.detail');
