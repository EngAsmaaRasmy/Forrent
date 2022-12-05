<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\ServiceApiController;
use App\Http\Controllers\ServiceProviderApiController;
use App\Http\Controllers\CustomerApiController;
use App\Http\Controllers\GeneralSetting;
use App\Http\Controllers\InfoUsApiController;
use App\Http\Controllers\MSAuthController;
use App\Http\Controllers\NumberofAccountsApiController;
use App\Http\Controllers\ReviewServiceProviderApiController;
use App\Http\Controllers\SearchLog;
use App\Http\Controllers\SearchLogController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['prefix' => 'admin-dashboard'], function () {
    app()->setLocale('ar');
    Route::post('login', [MSAuthController::class, 'login']);
    Route::post('logout', [MsAuthController::class, 'logout']); 
    Route::group(
        ['middleware' => ['admin_api_auth']],
        function () {
            Route::resource('categories', CategoryController::class);
            Route::resource('home-posters', GeneralSetting::class);
            Route::resource('search-log', SearchLogController::class);
            Route::get('categories/{id}/sub-categories', [CategoryController::class, 'subCategories']);
            Route::apiResource('sub-categories', SubCategoryController::class);
            Route::get('sub-categories/{id}/services', [SubCategoryController::class, 'services']);
            Route::resource('cities', CityController::class);
            Route::resource('areas', AreaController::class);
            Route::resource('services', ServiceApiController ::class);
            Route::resource('service_providers', ServiceProviderApiController ::class);
            Route::resource('customers', CustomerApiController ::class);
            //Route::resource('reviews', ReviewServiceProviderApiController ::class);
            Route::get('showInfo', [InfoUsApiController ::class ,'show']);
            Route::resource('updateInfo', InfoUsApiController::class);
            Route::put('reviews/{id}', [ReviewServiceProviderApiController ::class ,'update']);
            Route::put('day-cost', [GeneralSetting ::class ,'updateCost']);
            Route::get('number_of_acounts', [NumberofAccountsApiController::class, 'numberOfAccounts']);
            Route::get('blocked/{id}', [ServiceProviderApiController::class, 'blocked']);
            Route::get('allow/{id}', [ServiceApiController::class, 'allow']);

        }
    );
    Route::get('/migrate', function () {
        Artisan::call('migrate', array('--force' => true));
        return "Migrating Is Done";
    });
});
