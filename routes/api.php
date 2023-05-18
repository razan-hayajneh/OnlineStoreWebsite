<?php

use App\Http\Controllers\API\{ProductAPIController, HomeAPIController};
// use App\Http\Controllers\;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => ['auth-check'], 'namespace' => 'Api\Client'], function () {

    //    /***************************** AuthController Start *****************************/
    //    client
    Route::any('sign-in', 'AuthController@Login');
    Route::any('user/sign-up', 'AuthController@UserRegister');
    Route::any('send-active-code', 'AuthController@sendActiveCode');
    Route::any('check-active-code', 'AuthController@checkActiveCode');
    Route::any('logout', 'AuthController@Logout');

    Route::group(['middleware' => ['jwt.verify', 'check-user-active']], function () {
        //        # User profile
        Route::any('profile', 'AuthController@ShowProfile');
        Route::any('profile/update', 'AuthController@UpdateProfile');
        Route::any('change-password', 'AuthController@UpdatePassword');
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
    });
});


Route::resource('order_timelines', App\Http\Controllers\API\OrderTimelineAPIController::class);
