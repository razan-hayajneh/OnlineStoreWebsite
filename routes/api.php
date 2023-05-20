<?php

use App\Http\Controllers\API\{ProductAPIController, HomeAPIController, OrderTimelineAPIController};
use Illuminate\Support\Facades\Route;
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


Route::group(['middleware' => ['auth-check'], 'namespace' => 'Api\Client'], function () {

    //    /***************************** AuthController Start *****************************/
    //    client
    Route::post('register', [JWTAuthController::class, 'register']);
    Route::post('login', [JWTAuthController::class, 'login']);
    Route::group(['middleware' => ['auth.jwt', 'check-user-active']], function () {
        //        # User profile
        Route::post('logout', [JWTAuthController::class, 'logout']);
        Route::any('profile', 'AuthAPIController@ShowProfile');
        Route::any('profile/update', 'AuthAPIController@UpdateProfile');
        Route::any('change-password', 'AuthAPIController@UpdatePassword');
        Route::any('products', [ProductAPIController::class, 'index']);
        Route::any('/home-data', [HomeAPIController::class, 'index']);
        Route::any('/suggested-products', [ProductAPIController::class, 'suggest']);
        Route::resource('options', OptionAPIController::class);
        Route::resource('option_keys', OptionKeyAPIController::class);
        Route::resource('orders', OrderAPIController::class);
        Route::resource('categories', CategoryAPIController::class);
        Route::resource('coupons', CouponAPIController::class);
        Route::resource('product_option_keys', ProductOptionKeyAPIController::class);
        Route::resource('social_media', SocialMediaAPIController::class);
        Route::resource('ratings', RatingAPIController::class);
        Route::resource('order_timelines', OrderTimelineAPIController::class);
    });
});


