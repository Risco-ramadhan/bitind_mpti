<?php

use App\Http\Controllers\api_v1\AuthController;
use App\Http\Controllers\api_v1\ForgotPasswordController;
use App\Http\Controllers\api_v1\VerifyEmailController;
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

Route::group(
    [
        'middleware' => 'api',
        'namespace'  => 'App\Http\Controllers\api_v1',
        'prefix'     => 'auth',
    ],
    function ($router) {
        Route::post('login', 'AuthController@login');
        Route::post('verifyCode', 'VerifyEmailController@verifyEmailWithCode');
        Route::post('register', 'AuthController@register');
        Route::post('logout', 'AuthController@logout');
        Route::get('profile', 'AuthController@profile');
        Route::post('refresh', 'AuthController@refresh');
        Route::get('checkUserJWT', 'AuthController@checkUserToken');
       
        
    }
);


Route::get('/email/resend', [VerifyEmailController::class,'resend'])
->middleware(['api'])
->name('verification.resend');

//verify email
Route::get('/email/verify/{id}/{hash}',[VerifyEmailController::class,'__invoke'])
    ->middleware(['signed','throttle:6,1'])
    ->name('verification.verify');
//
Route::post('/password/email', [ForgotPasswordController::class, 'forgot']);
Route::post('/password/reset', [ForgotPasswordController::class, 'reset']);

Route::group(
    [
        'middleware' => 'api',
        'namespace'  => 'App\Http\Controllers\api_v1',
    ],
    function($router){
        Route::get('landingPage', 'LandingPageController@index');
        Route::get('getcountries', 'RegionController@getCountries');
        Route::get('getcity', 'RegionController@getCity');
        Route::get('detail/{id}', 'LandingPageController@show');
        Route::post('orderSection', 'OrderController@create');
        Route::get('salesTransaction', 'OrderController@create');
        Route::put('updateData/{id}', 'OrderController@update');
    }
);

Route::group(
    [
        'middleware' => ['api', 'user'],
        'namespace'  => 'App\Http\Controllers\api_v1',
    ],  
    function ($router) {
        Route::resource('userdashboard', 'UserDashboardController');
        Route::get('orderuser', 'UserDashboardController@orderUser');
        Route::get('statususer', 'UserDashboardController@statusUser');
        Route::get('allwebsite', 'UserDashboardController@userWebsite');
        Route::get('productdashboard', 'UserDashboardController@cardProductDashboard');
        Route::get('salesdashboard', 'UserDashboardController@cardProductSales');
        Route::get('finishedsalesproduct', 'UserDashboardController@detailSalesFinished');
        Route::get('unfinishedsalesproduct', 'UserDashboardController@detailSalesUnfinished');
        Route::get('websitedetail/{id}', 'UserDashboardController@detailWebsite');
        Route::get('preparingwebsite/{id}', 'UserDashboardController@timelinePreparing');
        Route::post('revisionform', 'RevisionController@create');
    }
);


Route::group(
    [
        'middleware' => ['api', 'admin'],
        'namespace'  => 'App\Http\Controllers\api_v1\admin',
    ],
    function ($router) {
        Route::resource('admindashboard', 'timelineController');
        Route::get('adminorder', 'timelineController@orderAll');
        Route::post('adminupdatepayment/{id}/{status}', 'timelineController@statusPaymentDataChanger');
        Route::post('adminupdateproduct/{id}/{status}', 'timelineController@statusProductDataChanger');
        Route::post('admindeletesalesdata/{id}', 'timelineController@deleteDataSalesTransactionUser');
        Route::post('adminupdatestimeline/{id}/{status}', 'timelineController@statusTimelinesDataChanger');
        Route::post('adminupdaterevision/{id}/{status}', 'timelineController@revisionDataChanger');
        Route::post('adminupdatestatus/{id}/{status}', 'timelineController@statusRevisionDataChanger');
    }
);
