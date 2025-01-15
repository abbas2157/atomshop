<?php
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function() {
    Route::middleware([App\Http\Middleware\EnsureUserIsAdmin::class])->group(function () {
        Route::group(['prefix' => 'admin'], function(){
            Route::post('forgot-password/send-email', [App\Http\Controllers\Auth\LoginController::class, 'send_email'])->name('admin.forgot-password.email');
            Route::get('/', [App\Http\Controllers\Dashboards\Admin\DashboardController::class, 'index'])->name('admin');
            Route::group(['prefix' => 'profile'], function(){
                Route::get('/', [App\Http\Controllers\Dashboards\Admin\ProfileController::class, 'create'])->name('admin.profile');
                Route::post('perform', [App\Http\Controllers\Dashboards\Admin\ProfileController::class, 'update'])->name('admin.profile.perform');
                Route::get('change/password', [App\Http\Controllers\Dashboards\Admin\ProfileController::class, 'password'])->name('admin.profile.change.password');
                Route::post('change/password', [App\Http\Controllers\Dashboards\Admin\ProfileController::class, 'show'])->name('admin.profile.change.password');
                Route::post('picture/update', [App\Http\Controllers\Dashboards\Admin\ProfileController::class, 'picture_update'])->name('change-profile.picture');
            });
            Route::resource('categories', App\Http\Controllers\Dashboards\Admin\Components\CategoryController::class,['as' => 'admin']);
        });
    });
});
