<?php
use Illuminate\Support\Facades\Route;

Route::middleware([App\Http\Middleware\EnsureUserIsSeller::class])->group(function () {
    Route::group(['prefix' => 'seller'], function(){
        Route::get('/', [App\Http\Controllers\Dashboards\Sellers\DashboardController::class, 'index'])->name('seller');
        Route::group(['prefix' => 'profile'], function(){
            Route::get('/', [App\Http\Controllers\Dashboards\Sellers\ProfileController::class, 'create'])->name('seller.profile');
            Route::post('perform', [App\Http\Controllers\Dashboards\Sellers\ProfileController::class, 'update'])->name('seller.profile.perform');
            Route::get('change/password', [App\Http\Controllers\Dashboards\Sellers\ProfileController::class, 'password'])->name('seller.profile.change.password');
            Route::post('change/password', [App\Http\Controllers\Dashboards\Sellers\ProfileController::class, 'show'])->name('seller.profile.change.password');
            Route::post('picture/update', [App\Http\Controllers\Dashboards\Sellers\ProfileController::class, 'picture_update'])->name('change-profile.picture');

            //Business Information
            Route::get('seller-info', [App\Http\Controllers\Dashboards\Sellers\ProfileController::class, 'seller_info'])->name('seller.profile.seller-info');
            Route::post('seller-info', [App\Http\Controllers\Dashboards\Sellers\ProfileController::class, 'seller_info_perform'])->name('seller.profile.seller-info.perform');

            //Business Information
            Route::get('business-info', [App\Http\Controllers\Dashboards\Sellers\ProfileController::class, 'business_info'])->name('seller.profile.business-info');
            Route::post('business-info', [App\Http\Controllers\Dashboards\Sellers\ProfileController::class, 'business_info_perform'])->name('seller.profile.business-info.perform');
        });
        Route::resource('customers', App\Http\Controllers\Dashboards\Sellers\CustomerController::class,['as' => 'seller']);    });
});
