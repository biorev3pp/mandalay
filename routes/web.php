<?php

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
    return view('welcome');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->group(function(){
    Route::get('/login', function(){
        return view('auth.login');
    });

    Route::get('/logout', 'Auth\LoginController@logout');
    Route::get('/home', 'HomeController@index')->name('home');

    //Homes Routes
    Route::resource('homes', 'Admin\HomesController');
    Route::get('homes/create', 'Admin\HomesController@create');
    Route::get('homes/edit/{id}', 'Admin\HomesController@edit');
    Route::post('homes/save', 'Admin\HomesController@save');
    Route::post('homes/delete', 'Admin\HomesController@delete');
});