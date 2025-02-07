<?php
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function() {
    Route::middleware([App\Http\Middleware\EnsureUserIsSeller::class])->group(function () {
        Route::group(['prefix' => 'seller'], function(){
            Route::get('/', [App\Http\Controllers\Dashboards\Sellers\DashboardController::class, 'index'])->name('seller');
        });
    });
});