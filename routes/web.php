<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'portal/login', 'middleware' => ['guest']], function(){
    Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'create'])->name('login');
    Route::post('perform', [App\Http\Controllers\Auth\LoginController::class, 'store'])->name('login.perform');
});

Route::group(['prefix' => 'password', 'middleware' => ['guest']], function(){
    Route::get('forgot', [App\Http\Controllers\Auth\LoginController::class, 'forgot_password'])->name('password.forgot');
    Route::post('send-email', [App\Http\Controllers\Auth\LoginController::class, 'send_email'])->name('password.send-email');
    Route::get('reset/{id}', [App\Http\Controllers\Auth\LoginController::class, 'reset_password'])->name('password.reset');
    Route::post('reset/perform', [App\Http\Controllers\Auth\LoginController::class, 'change_password'])->name('password.reset.perform');
});

Route::group(['middleware' => ['auth']], function() {
    Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'destroy'])->name('logout');
});

