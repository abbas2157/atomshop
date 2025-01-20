<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'user'], function(){
    Route::post('register', [App\Http\Controllers\Api\Auth\RegisterController::class, 'register']);
    Route::post('email-verify', [App\Http\Controllers\Api\Auth\RegisterController::class, 'emailverify']);

    Route::post('login', [App\Http\Controllers\Api\Auth\LoginController::class, 'login']);

    Route::post('forgot-password', [App\Http\Controllers\Api\Auth\LoginController::class, 'forget_password']);
    Route::post('verify-code', [App\Http\Controllers\Api\Auth\LoginController::class, 'verify_code']);
    Route::post('reset-password', [App\Http\Controllers\Api\Auth\LoginController::class, 'reset_password']);
    Route::post('logout', [App\Http\Controllers\Api\Auth\LoginController::class, 'logout'])->middleware('auth:sanctum');

});
