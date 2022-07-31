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


