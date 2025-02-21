<?php

use Illuminate\Support\Facades\Route;

Route::get('login', [App\Http\Controllers\Web\AuthController::class, 'login'])->name('login');
Route::post('login', [App\Http\Controllers\Web\AuthController::class, 'login_perform'])->name('login.perform');
Route::get('register', [App\Http\Controllers\Web\AuthController::class, 'register'])->name('website.register');
Route::post('register', [App\Http\Controllers\Web\AuthController::class, 'register_perform'])->name('website.register.perform');
Route::get('register/verification', [App\Http\Controllers\Web\AuthController::class, 'verification'])->name('website.register.verification');
Route::post('register/verification', [App\Http\Controllers\Web\AuthController::class, 'verification_perform'])->name('website.register.verification.perform');

//installment-calculator
Route::group(['prefix' => 'installment-calculator'], function(){
    Route::get('/', [App\Http\Controllers\Web\InstallmentCalculatorController::class, 'index'])->name('calculator');
    Route::get('brands', [App\Http\Controllers\Web\InstallmentCalculatorController::class, 'brands'])->name('calculator.brands');
    Route::get('brands/products', [App\Http\Controllers\Web\InstallmentCalculatorController::class, 'products'])->name('calculator.brands.products');
    Route::get('products/detail', [App\Http\Controllers\Web\InstallmentCalculatorController::class, 'product_detail'])->name('calculator.products.detail');
});
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


//Home
Route::get('/', function(){
    return view('welcome');
})->name('home');
Route::get('home', [App\Http\Controllers\Web\HomeController::class, 'home'])->name('website');
Route::get('shop', [App\Http\Controllers\Web\ShopController::class, 'index'])->name('shop');
Route::get('category/{slug}', [App\Http\Controllers\Web\ShopController::class, 'category'])->name('category');
Route::get('brand/{slug}', [App\Http\Controllers\Web\ShopController::class, 'brand'])->name('brand');

// Other Pages
Route::get('about-us', [App\Http\Controllers\Web\PageController::class, 'about'])->name('about-us');
Route::get('privacy-policy', [App\Http\Controllers\Web\PageController::class, 'privacypolicy'])->name('privacy-policy');
Route::get('return-refund-policy', [App\Http\Controllers\Web\PageController::class, 'returnrefundpolicy'])->name('return-refund-policy');
Route::get('faqs', [App\Http\Controllers\Web\PageController::class, 'faqs'])->name('faqs');

Route::get('contact-us', [App\Http\Controllers\Web\PageController::class, 'contact'])->name('contact-us');
Route::post('contact-us', [App\Http\Controllers\Web\PageController::class, 'contact_perform'])->name('contact.send');

Route::get('/{slug}', [App\Http\Controllers\Web\HomeController::class, 'product_detail'])->name('website.product.detail');

