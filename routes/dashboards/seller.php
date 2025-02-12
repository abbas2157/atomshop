<?php
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function() {
    Route::middleware([App\Http\Middleware\EnsureUserIsSeller::class])->group(function () {
        Route::group(['prefix' => 'seller'], function(){
            Route::get('/', [App\Http\Controllers\Dashboards\Sellers\DashboardController::class, 'index'])->name('seller');
            Route::group(['prefix' => 'profile'], function(){
                Route::get('/', [App\Http\Controllers\Dashboards\Sellers\ProfileController::class, 'create'])->name('seller.profile');
                Route::post('perform', [App\Http\Controllers\Dashboards\Sellers\ProfileController::class, 'update'])->name('seller.profile.perform');
                Route::get('change/password', [App\Http\Controllers\Dashboards\Sellers\ProfileController::class, 'password'])->name('seller.profile.change.password');
                Route::post('change/password', [App\Http\Controllers\Dashboards\Sellers\ProfileController::class, 'show'])->name('seller.profile.change.password');
                Route::post('picture/update', [App\Http\Controllers\Dashboards\Sellers\ProfileController::class, 'picture_update'])->name('change-profile.picture');
            });
        });
        Route::group(['prefix' => 'sellers'], function(){
            Route::get('/sellers', [App\Http\Controllers\Dashboards\Sellers\SellersController::class, 'create'])->name('seller.index');
            Route::post('perform', [App\Http\Controllers\Dashboards\Sellers\SellersController::class, 'update'])->name('seller.perform');
            // Route::get('change/password', [App\Http\Controllers\Dashboards\Sellers\SellersController::class, 'password'])->name('seller.profile.change.password');
            // Route::post('change/password', [App\Http\Controllers\Dashboards\Sellers\SellersController::class, 'show'])->name('seller.profile.change.password');
            // Route::post('picture/update', [App\Http\Controllers\Dashboards\Sellers\SellersController::class, 'picture_update'])->name('change-profile.picture');
        });
    });    
});
