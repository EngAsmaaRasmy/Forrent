<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceProviderAuthController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CustomerServicesController;
use App\Http\Controllers\FavoriteServiceController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceProviderController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\LocalizationController;
use Spatie\Analytics\Period;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {

    $analyticsData = Analytics::fetchVisitorsAndPageViews(Period::days(7));
    return view('welcome', ['analyticsData' => $analyticsData]);
});
Route::group(['prefix' => ''], function (){

        Route::get('/lang/{lang}', [LocalizationController::class, 'index'])->name('lang.switch');

        Route::get('/', function () {
            return view('index');
        })->name('home');

        Route::get('service-provider-add-service', function () {
            return view('serviceproviders.services.add');
        })->name('service-provider-add-service');





        //-------------------------------------------------route for login page------------------------------------------------//

        Route::get('login', function () {
            return view('login');
        })->name('show.login.form');

        Route::get('login-with-otp', function () {
            return view('login-otp');
        })->name('show.login-otp.form');



        //-------------------------------------------------route for registeration------------------------------------------------//
        Route::get('sign-up', function () {
            return view('register');
        })->name('show.register.form');
        

        //-------------------------------------------------route for customers------------------------------------------------//


        Route::group(['prefix' => 'customer'], function () {

            // Route::get('lang/{locale}', [LocalizationController::class, 'index']);
            Route::get('register', [CustomerAuthController::class, 'showRegisterForm'])->name('customer.register.form');
            Route::post('register', [CustomerAuthController::class, 'register'])->name('customer.register');
            Route::get('forget-password', [CustomerAuthController::class, 'showForgetPasswordForm'])->name('forget.password.get');
            Route::post('forget-password', [CustomerAuthController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
            Route::get('reset-password/{token}', [CustomerAuthController::class, 'showResetPasswordForm'])->name('reset.password.get');
            Route::post('reset-password', [CustomerAuthController::class, 'submitResetPasswordForm'])->name('reset.password.post');
            Route::get('login', [CustomerAuthController::class, 'showLoginForm'])->name('customer.login.form');
            Route::post('login', [CustomerAuthController::class, 'login'])->name('customer.login');
            Route::post('login-otp', [CustomerAuthController::class, 'otpCheck'])->name('customer.login-otp');
            Route::get('logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');
            Route::resource('customer-services', CustomerServicesController::class);
            Route::post('store-favorite-service', [FavoriteServiceController::class, 'store'])->name('store.favorite.service');
            Route::resource('favorite-services', FavoriteServiceController::class);
            Route::group(
                ['middleware' => ['customer_auth']],
                function () {
                    Route::get('/', [CustomerAuthController::class, 'index'])->name('customer.main');
                }
            );
        });


        //-------------------------------------------------end route for customers------------------------------------------------//



        //-------------------------------------------------route for Service Providers------------------------------------------------//


        Route::group(['prefix' => 'service-provider'], function () {
            // Route::get('lang/{locale}', [LocalizationController::class, 'index']);
            Route::get('register', [ServiceProviderAuthController::class, 'showRegisterForm'])->name('service.provider.register.form');
            Route::post('register', [ServiceProviderAuthController::class, 'register'])->name('service.provider.register');
            Route::get('forget-password', [ServiceProviderAuthController::class, 'showForgetPasswordForm'])->name('forget.passwordSp.get');
            Route::post('forget-password', [ServiceProviderAuthController::class, 'submitForgetPasswordForm'])->name('forget.passwordSp.post'); 
            Route::get('reset-password/{token}', [ServiceProviderAuthController::class, 'showResetPasswordForm'])->name('reset.passwordSp.get');
            Route::post('reset-password', [ServiceProviderAuthController::class, 'submitResetPasswordForm'])->name('reset.passwordSp.post');
            Route::get('login', [ServiceProviderAuthController::class, 'showLoginForm'])->name('service.provider.login.form');
            Route::post('login', [ServiceProviderAuthController::class, 'login'])->name('service.provider.login');
            Route::post('login-otp', [ServiceProviderAuthController::class, 'otpCheck'])->name('service.provider.login-otp');
            Route::get('logout', [ServiceProviderAuthController::class, 'logout'])->name('service.provider.logout');
            Route::get('account-details', [ServiceProviderController::class, 'accountDetails'])->name('service.provider.account');
            Route::resource('service-provider-account', ServiceProviderController::class);
            // Route::post('account-update/{id}', [ServiceProviderController::class, 'accountUpdate'])->name('service.provider.account.update');
            Route::resource('all-services', ServiceController::class);
            Route::get('service-provider.main', function () {
                return view('serviceProvider.dashboard');
            })->name('serviceProvider.maindashboard');
            Route::group(
                ['middleware' => ['service_provider_auth']],
                function () {
                    Route::get('/', [ServiceProviderAuthController::class, 'index'])->name('serviceProvider.main');  
                }
            );
        });
        //-------------------------------------- end route for service providers------------------------------------------------//


        //-----------------------------------------route for Visitors------------------------------------------------//


        Route::get('search', [ServiceController::class, 'search'])->name('services.search');
        Route::get('mobile-search', [ServiceController::class, 'mobileSearch'])->name('services.mobileSearch');
        Route::get('all-services', [VisitorController::class, 'index'])->name('visitors.index');
        Route::get('filter', [ServiceController::class, 'filter'])->name('services.filter');
        Route::get('category-services/{id}', [ServiceController::class, 'categoryServices'])->name('categoryServices'); 
        Route::get('sub-category-services/{id}', [ServiceController::class, 'subCategoryServices'])->name('subCategoryServices');
        Route::get('single-service/{id}', [VisitorController::class, 'singleService'])->name('single-service');
        Route::get('service/{slug}', [VisitorController::class, 'link'])->name('service.link'); 

        Route::get('contact-us', function () {
            return view('contact-us');
        })->name('contact-us');

        Route::get('about-us', function () {
            return view('about-us');
        })->name('about-us');

        Route::get('privacy-policy', function () {
            return view('privacy');
        })->name('privacy-policy');
//-----------------------------------------end route for visitors------------------------------------------------//
});
Route::get('/migrate', function () {
    Artisan::call('migrate', array('--force' => true));
    Artisan::call('route:clear');
    Artisan::call('route:cache');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    return "Done";
}); 