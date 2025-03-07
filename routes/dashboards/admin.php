<?php
use Illuminate\Support\Facades\Route;

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
        Route::resource('sizes', App\Http\Controllers\Dashboards\Admin\Components\SizeController::class,['as' => 'admin']);
        Route::resource('memory', App\Http\Controllers\Dashboards\Admin\Components\MemoryController::class,['as' => 'admin']);
        Route::resource('sliders', App\Http\Controllers\Dashboards\Admin\Components\SliderController::class,['as' => 'admin']);

        //Product Management
        Route::resource('orders', App\Http\Controllers\Dashboards\Admin\Orders\OrderController::class,['as' => 'admin']);
        Route::group(['prefix' => 'orders'], function(){
            Route::get('status/{id}', [App\Http\Controllers\Dashboards\Admin\Orders\OrderController::class, 'status'])->name('admin.orders.status');
            Route::post('status/{id}', [App\Http\Controllers\Dashboards\Admin\Orders\OrderController::class, 'status'])->name('admin.orders.status.post');
        });
        Route::group(['prefix' => 'instalment'], function(){
            Route::post('pay', [App\Http\Controllers\Dashboards\Admin\Orders\OrderController::class, 'pay_instalment'])->name('seller.instalment.pay');
        });
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
                Route::group(['prefix' => 'web'], function(){
                    Route::get('/', [App\Http\Controllers\Dashboards\Admin\WebApp\WebsiteController::class, 'web_products'])->name('admin.website.products.web');
                    Route::get('sync', [App\Http\Controllers\Dashboards\Admin\WebApp\WebsiteController::class, 'web_products_sync'])->name('admin.website.products.web.sync');
                    Route::post('update', [App\Http\Controllers\Dashboards\Admin\WebApp\WebsiteController::class, 'web_products_update'])->name('admin.website.products.web.update');
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
        Route::group(['prefix' => 'app'], function(){
            Route::group(['prefix' => 'products'], function(){
                Route::get('/', [App\Http\Controllers\Dashboards\Admin\WebApp\AppSetupController::class, 'products'])->name('admin.app.products');
                Route::get('sync', [App\Http\Controllers\Dashboards\Admin\WebApp\AppSetupController::class, 'product_sync'])->name('admin.app.products.sync');
                Route::post('update', [App\Http\Controllers\Dashboards\Admin\WebApp\AppSetupController::class, 'product_update'])->name('admin.app.products.update');
                Route::group(['prefix' => 'feature'], function(){
                    Route::get('/', [App\Http\Controllers\Dashboards\Admin\WebApp\AppSetupController::class, 'feature_products'])->name('admin.app.products.feature');
                    Route::get('sync', [App\Http\Controllers\Dashboards\Admin\WebApp\AppSetupController::class, 'feature_products_sync'])->name('admin.app.products.feature.sync');
                    Route::post('update', [App\Http\Controllers\Dashboards\Admin\WebApp\AppSetupController::class, 'feature_products_update'])->name('admin.app.products.feature.update');
                });
                Route::group(['prefix' => 'app'], function(){
                    Route::get('/', [App\Http\Controllers\Dashboards\Admin\WebApp\AppSetupController::class, 'app_products'])->name('admin.app.products.app');
                    Route::get('sync', [App\Http\Controllers\Dashboards\Admin\WebApp\AppSetupController::class, 'app_products_sync'])->name('admin.app.products.app.sync');
                    Route::post('update', [App\Http\Controllers\Dashboards\Admin\WebApp\AppSetupController::class, 'app_products_update'])->name('admin.app.products.app.update');
                });
            });
            Route::group(['prefix' => 'categories'], function(){
                Route::get('/', [App\Http\Controllers\Dashboards\Admin\WebApp\AppSetupController::class, 'categories'])->name('admin.app.categories');
                Route::get('sync', [App\Http\Controllers\Dashboards\Admin\WebApp\AppSetupController::class, 'category_sync'])->name('admin.app.categories.sync');
                Route::post('update', [App\Http\Controllers\Dashboards\Admin\WebApp\AppSetupController::class, 'category_update'])->name('admin.app.categories.update');
            });
            Route::group(['prefix' => 'brands'], function(){
                Route::get('/', [App\Http\Controllers\Dashboards\Admin\WebApp\AppSetupController::class, 'brands'])->name('admin.app.brands');
                Route::get('sync', [App\Http\Controllers\Dashboards\Admin\WebApp\AppSetupController::class, 'brand_sync'])->name('admin.app.brands.sync');
                Route::post('update', [App\Http\Controllers\Dashboards\Admin\WebApp\AppSetupController::class, 'brand_update'])->name('admin.app.brands.update');
            });

            Route::group(['prefix' => 'sliders'], function(){
                Route::get('/', [App\Http\Controllers\Dashboards\Admin\WebApp\AppSetupController::class, 'sliders'])->name('admin.app.sliders');
                Route::get('sync', [App\Http\Controllers\Dashboards\Admin\WebApp\AppSetupController::class, 'slider_sync'])->name('admin.app.sliders.sync');
                Route::post('update', [App\Http\Controllers\Dashboards\Admin\WebApp\AppSetupController::class, 'slider_update'])->name('admin.app.sliders.update');
            });
        });
        //Installment Calculator
        Route::group(['prefix' => 'installment-calculator'], function(){
            Route::get('/', [App\Http\Controllers\Dashboards\Admin\CalculatorController::class, 'index'])->name('admin.installment-calculator');
            Route::post('store', [App\Http\Controllers\Dashboards\Admin\CalculatorController::class, 'store'])->name('admin.installment-calculator.store');
        });
    });
});
