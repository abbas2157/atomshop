<?php

use Illuminate\Support\Facades\Route;


Route::get('installment-calculator', [App\Http\Controllers\Web\HomeController::class, 'calculator'])->name('calculator');

//Home
Route::get('/', [App\Http\Controllers\Web\HomeController::class, 'home'])->name('website');
Route::get('/{slug}', [App\Http\Controllers\Web\HomeController::class, 'product_detail'])->name('product.detail');

