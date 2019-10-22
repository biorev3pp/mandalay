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

Route::get('/', 'Frontend\HomeController@index');
Route::post('/home-final', 'Frontend\HomeController@finalHomePage');
Route::post('/get-floor-data', 'Frontend\HomeController@getFloorsData');
Route::post('/get-feature-data', 'Frontend\HomeController@getFeatureData');

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

    //Floor Routes
    Route::get('floors/list/{id}', 'Admin\FloorController@index');
    Route::get('floors/create/{id}', 'Admin\FloorController@create');
    Route::get('floors/edit/{id}', 'Admin\FloorController@edit');
    Route::post('floors/save', 'Admin\FloorController@save');
    Route::post('floors/delete', 'Admin\FloorController@delete');

    //Features Routes
    Route::get('features/list/{id}', 'Admin\FeaturesController@index');
    Route::get('features/create/{id}', 'Admin\FeaturesController@create');
    Route::get('features/edit/{id}', 'Admin\FeaturesController@edit');
    Route::post('features/save', 'Admin\FeaturesController@save');
    Route::post('features/delete', 'Admin\FeaturesController@delete');
    Route::get('features/set-acl/{id}', 'Admin\FeaturesController@setACLOptions');
    Route::post('/features/get_acl_form', 'Admin\FeaturesController@getACLRow');
    Route::post('features/save-acl', 'Admin\FeaturesController@saveAclSettings')->name('saveAclSettings');

    //Settings Routes
    Route::resource('settings', 'Admin\SettingController');
    Route::post('settings/save', 'Admin\SettingController@save');
});
