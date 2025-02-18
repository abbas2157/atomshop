<?php

use Illuminate\Support\Facades\Route;

Route::get('login', [App\Http\Controllers\Web\AuthController::class, 'login'])->name('website.login');
Route::post('login', [App\Http\Controllers\Web\AuthController::class, 'login_perform'])->name('website.login.perform');
Route::get('register', [App\Http\Controllers\Web\AuthController::class, 'register'])->name('website.register');
Route::post('register', [App\Http\Controllers\Web\AuthController::class, 'register_perform'])->name('website.register.perform');
Route::get('register/verification', [App\Http\Controllers\Web\AuthController::class, 'verification'])->name('website.register.verification');
Route::post('register/verification', [App\Http\Controllers\Web\AuthController::class, 'verification_perform'])->name('website.register.verification.perform');
//Cart Management
Route::group(['prefix' => 'cart'], function(){
    Route::get('/', [App\Http\Controllers\Web\Order\CartController::class, 'index'])->name('cart');
});

//Auth Routes
Route::group(['middleware' => ['auth']], function(){
    Route::group(['prefix' => 'checkout'], function(){
        Route::get('/', [App\Http\Controllers\Web\Order\OrderController::class, 'index'])->name('checkout');
        Route::post('perform', [App\Http\Controllers\Web\Order\OrderController::class, 'checkout_perform'])->name('checkout.perform');
    });
    Route::group(['prefix' => 'order'], function(){
        Route::get('success', [App\Http\Controllers\Web\Order\OrderController::class, 'success'])->name('order.success');
        Route::get('failed', [App\Http\Controllers\Web\Order\OrderController::class, 'failed'])->name('order.failed');
    });
});
Route::get('installment-calculator', [App\Http\Controllers\Web\HomeController::class, 'calculator'])->name('calculator');

//Home
Route::get('/', function(){
    return view('welcome');
})->name('home');
Route::get('home', [App\Http\Controllers\Web\HomeController::class, 'home'])->name('website');
Route::get('shop', [App\Http\Controllers\Web\ShopController::class, 'index'])->name('shop');

// Other Pages
Route::get('about-us', [App\Http\Controllers\Web\PageController::class, 'about'])->name('about-us');
Route::get('privacy-policy', [App\Http\Controllers\Web\PageController::class, 'privacypolicy'])->name('privacy-policy');
Route::get('return-refund-policy', [App\Http\Controllers\Web\PageController::class, 'returnrefundpolicy'])->name('return-refund-policy');
Route::get('faqs', [App\Http\Controllers\Web\PageController::class, 'faqs'])->name('faqs');

Route::get('contact-us', [App\Http\Controllers\Web\ContactController::class, 'contact'])->name('contact-us');
Route::post('contact-us', [App\Http\Controllers\Web\ContactController::class, 'contact_perform'])->name('contact.send');

Route::get('/{slug}', [App\Http\Controllers\Web\HomeController::class, 'product_detail'])->name('website.product.detail');

