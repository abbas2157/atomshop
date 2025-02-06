<?php

use Illuminate\Support\Facades\Route;

Route::get('/{uuid}', [App\Http\Controllers\Web\HomeController::class, 'addtocart'])->name('cart');
Route::post('/update-cart/{id}', [App\Http\Controllers\Web\HomeController::class, 'updateCart']);
Route::post('/remove-cart/{id}', [App\Http\Controllers\Web\HomeController::class, 'removeCart']);
Route::get('installment-calculator', [App\Http\Controllers\Web\HomeController::class, 'calculator'])->name('calculator');

//Home
Route::get('/', function(){
    return view('welcome');
})->name('home');
Route::get('home', [App\Http\Controllers\Web\HomeController::class, 'home'])->name('website');
Route::get('/{slug}', [App\Http\Controllers\Web\HomeController::class, 'product_detail'])->name('website.product.detail');

