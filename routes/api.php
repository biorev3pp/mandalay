<?php

use Illuminate\Http\Request;

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
Route::post('/user-login', 'API\LoginController@index');
Route::post('/user-check', 'API\LoginController@check');
Route::post('/user-register', 'API\LoginController@register');
Route::post('/forgot-password', 'API\LoginController@forgotPassword');
Route::post('/update-password', 'API\LoginController@updatePassword');
Route::post('/verify-code', 'API\LoginController@VerifyCode');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
