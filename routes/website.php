<?php

use Illuminate\Support\Facades\Route;

//Cart Management 
Route::group(['prefix' => 'cart'], function(){
    Route::get('/', [App\Http\Controllers\Web\Order\CartController::class, 'index'])->name('cart');
});


Route::get('installment-calculator', [App\Http\Controllers\Web\HomeController::class, 'calculator'])->name('calculator');

//Home
Route::get('/', function(){
    return view('welcome');
})->name('home');
Route::get('home', [App\Http\Controllers\Web\HomeController::class, 'home'])->name('website');
Route::get('shop', [App\Http\Controllers\Web\ShopController::class, 'index'])->name('shop');
Route::get('/{slug}', [App\Http\Controllers\Web\HomeController::class, 'product_detail'])->name('website.product.detail');

