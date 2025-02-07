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
            //Product Management
            Route::resource('products', App\Http\Controllers\Dashboards\Admin\Components\ProductController::class,['as' => 'admin']);
            Route::delete('products/{product}/gallery-image/{id}', [App\Http\Controllers\Dashboards\Admin\Components\ProductController::class, 'deleteGalleryImage'])->name('products.gallery-image');
            Route::resource('categories', App\Http\Controllers\Dashboards\Admin\Components\CategoryController::class,['as' => 'admin']);
            Route::resource('brands', App\Http\Controllers\Dashboards\Admin\Components\BrandController::class,['as' => 'admin']);
            Route::resource('colors', App\Http\Controllers\Dashboards\Admin\Components\ColorController::class,['as' => 'admin']);
            Route::resource('memory', App\Http\Controllers\Dashboards\Admin\Components\MemoryController::class,['as' => 'admin']);
            Route::resource('sliders', App\Http\Controllers\Dashboards\Admin\Components\SliderController::class,['as' => 'admin']);
            
            //Zone Management
            Route::resource('cities', App\Http\Controllers\Dashboards\Admin\Components\CitiesController::class,['as' => 'admin']);
            Route::resource('areas', App\Http\Controllers\Dashboards\Admin\Components\AreaController::class,['as' => 'admin']);
            //Account Management
            Route::resource('users', App\Http\Controllers\Dashboards\Admin\Accounts\UserController::class,['as' => 'admin']);
            Route::resource('sellers', App\Http\Controllers\Dashboards\Admin\Accounts\SellersController::class,['as' => 'admin']);
            Route::resource('customers', App\Http\Controllers\Dashboards\Admin\Accounts\CustomerController::class,['as' => 'admin']);
            //Website & App settings
            Route::group(['prefix' => 'website'], function(){
                Route::group(['prefix' => 'products'], function(){
                    Route::get('/', [App\Http\Controllers\Dashboards\Admin\WebApp\WebsiteController::class, 'products'])->name('admin.website.products');
                    Route::get('sync', [App\Http\Controllers\Dashboards\Admin\WebApp\WebsiteController::class, 'product_sync'])->name('admin.website.products.sync');
                    Route::post('update', [App\Http\Controllers\Dashboards\Admin\WebApp\WebsiteController::class, 'product_update'])->name('admin.website.products.update');
                    Route::group(['prefix' => 'feature'], function(){
                        Route::get('/', [App\Http\Controllers\Dashboards\Admin\WebApp\WebsiteController::class, 'feature_products'])->name('admin.website.products.feature');
                        Route::get('sync', [App\Http\Controllers\Dashboards\Admin\WebApp\WebsiteController::class, 'feature_products_sync'])->name('admin.website.products.feature.sync');
                        Route::post('update', [App\Http\Controllers\Dashboards\Admin\WebApp\WebsiteController::class, 'feature_products_update'])->name('admin.website.products.feature.update');
                    });
                });
                Route::group(['prefix' => 'categories'], function(){
                    Route::get('/', [App\Http\Controllers\Dashboards\Admin\WebApp\WebsiteController::class, 'categories'])->name('admin.website.categories');
                    Route::get('sync', [App\Http\Controllers\Dashboards\Admin\WebApp\WebsiteController::class, 'category_sync'])->name('admin.website.categories.sync');
                    Route::post('update', [App\Http\Controllers\Dashboards\Admin\WebApp\WebsiteController::class, 'category_update'])->name('admin.website.categories.update');
                });
                Route::group(['prefix' => 'brands'], function(){
                    Route::get('/', [App\Http\Controllers\Dashboards\Admin\WebApp\WebsiteController::class, 'brands'])->name('admin.website.brands');
                    Route::get('sync', [App\Http\Controllers\Dashboards\Admin\WebApp\WebsiteController::class, 'brand_sync'])->name('admin.website.brands.sync');
                    Route::post('update', [App\Http\Controllers\Dashboards\Admin\WebApp\WebsiteController::class, 'brand_update'])->name('admin.website.brands.update');
                });

                Route::group(['prefix' => 'sliders'], function(){
                    Route::get('/', [App\Http\Controllers\Dashboards\Admin\WebApp\WebsiteController::class, 'sliders'])->name('admin.website.sliders');
                    Route::get('sync', [App\Http\Controllers\Dashboards\Admin\WebApp\WebsiteController::class, 'slider_sync'])->name('admin.website.sliders.sync');
                    Route::post('update', [App\Http\Controllers\Dashboards\Admin\WebApp\WebsiteController::class, 'slider_update'])->name('admin.website.sliders.update');
                });
            });
            //Installment Calculator
            Route::group(['prefix' => 'installment-calculator'], function(){
                Route::get('/', [App\Http\Controllers\Dashboards\Admin\CalculatorController::class, 'index'])->name('admin.installment-calculator');
                Route::post('store', [App\Http\Controllers\Dashboards\Admin\CalculatorController::class, 'store'])->name('admin.installment-calculator.store');
            });
        });
    });
});
