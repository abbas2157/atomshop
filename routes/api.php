<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'account'], function(){
    Route::post('create', [App\Http\Controllers\Api\AccountController::class, 'create_account']);
    Route::post('login', [App\Http\Controllers\Api\AccountController::class, 'login']);

    Route::post('send/code', [App\Http\Controllers\Api\AccountController::class, 'send_code']);
    Route::post('send/code/verify', [App\Http\Controllers\Api\AccountController::class, 'verify_code']);
    Route::post('send/code/reset/password', [App\Http\Controllers\Api\AccountController::class, 'reset_password']);

    Route::post('profile/upload', [App\Http\Controllers\Api\AccountController::class, 'profile_upload']);
    Route::post('profile/update', [App\Http\Controllers\Api\AccountController::class, 'profile_update']);

    Route::post('change/password', [App\Http\Controllers\Api\AccountController::class, 'change_password']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'home'], function(){
    Route::get('categories', [App\Http\Controllers\Api\HomePageController::class, 'categories']);
    Route::get('brands', [App\Http\Controllers\Api\HomePageController::class, 'brands']);
});
