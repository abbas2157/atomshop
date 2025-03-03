<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'account'], function(){
    Route::post('create', [App\Http\Controllers\Api\AccountController::class, 'create_account']);
    Route::post('login', [App\Http\Controllers\Api\AccountController::class, 'login']);

    Route::post('send/code', [App\Http\Controllers\Api\AccountController::class, 'send_code']);
    Route::post('send/code/verify', [App\Http\Controllers\Api\AccountController::class, 'verify_code']);
    Route::post('send/code/reset/password', [App\Http\Controllers\Api\AccountController::class, 'reset_password']);

    Route::middleware('auth:sanctum')->post('profile/upload', [App\Http\Controllers\Api\AccountController::class, 'profile_upload']);
    Route::middleware('auth:sanctum')->get('profile/{uuid}', [App\Http\Controllers\Api\AccountController::class, 'profile']);
    Route::middleware('auth:sanctum')->post('profile/update', [App\Http\Controllers\Api\AccountController::class, 'profile_update']);

    Route::post('change/password', [App\Http\Controllers\Api\AccountController::class, 'change_password']);
});

Route::middleware('auth:sanctum')->get('user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'checkout'], function(){
    Route::get('/', [App\Http\Controllers\Api\Order\OrderController::class, 'index']);
    Route::post('perform', [App\Http\Controllers\Api\Order\OrderController::class, 'checkout_perform']);
    Route::get('success', [App\Http\Controllers\Api\Order\OrderController::class, 'success']);
    Route::get('failed', [App\Http\Controllers\Api\Order\OrderController::class, 'faileds']);
});

Route::get('categories', [App\Http\Controllers\Api\HomePageController::class, 'categories']);
Route::get('brands', [App\Http\Controllers\Api\HomePageController::class, 'brands']);

Route::get('cities', [App\Http\Controllers\Api\CityAreaController::class, 'cities']);
Route::get('areas', [App\Http\Controllers\Api\CityAreaController::class, 'areas']);
Route::get('areas/{city_id}', [App\Http\Controllers\Api\CityAreaController::class, 'areas_with_city_id']);

Route::get('sliders', [App\Http\Controllers\Api\HomePageController::class, 'sliders']);
Route::get('promotions', [App\Http\Controllers\Api\HomePageController::class, 'promotions']);
Route::group(['prefix' => 'products'], function(){
    Route::get('/', [App\Http\Controllers\Api\ProductController::class, 'products']);

    Route::get('toprated', [App\Http\Controllers\Api\HomePageController::class, 'home_products']);
    Route::get('feature', [App\Http\Controllers\Api\HomePageController::class, 'feature_products']);

    Route::get('category/{id}', [App\Http\Controllers\Api\HomePageController::class, 'category_products']);
    Route::get('brand/{id}', [App\Http\Controllers\Api\HomePageController::class, 'brand_products']);

    Route::get('{id}', [App\Http\Controllers\Api\ProductController::class, 'product_detail']);
});

Route::group(['prefix' => 'cart'], function(){
    Route::post('/', [App\Http\Controllers\Api\Order\CartController::class, 'get_cart']);
    Route::post('add', [App\Http\Controllers\Api\Order\CartController::class, 'add_to_cart']);
    Route::post('update', [App\Http\Controllers\Api\Order\CartController::class, 'update_cart']);
    Route::post('remove', [App\Http\Controllers\Api\Order\CartController::class, 'remove_from_cart']);
    Route::post('count', [App\Http\Controllers\Api\Order\CartController::class, 'cart_count']);
});


