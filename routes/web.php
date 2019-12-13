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
Route::get('/test-pdf', 'Frontend\HomeController@testPDF');
Route::post('/download-pdf', 'Frontend\HomeController@downloadPDF');


Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('admin/login', function(){
    if(Auth::id()){
        return redirect('admin/homes');    
    }
    return view('auth.login');
});

Route::group(['prefix'=>'admin','middleware'=>'auth'], function () { 
    Route::get('/logout', 'Auth\LoginController@logout');
    Route::get('/home', 'HomeController@index')->name('home');

    //Homes Routes
    Route::resource('homes', 'Admin\HomesController');
    Route::get('homes/create', 'Admin\HomesController@create');
    Route::get('homes/edit/{id}', 'Admin\HomesController@edit');
    Route::post('homes/save', 'Admin\HomesController@save');
    Route::post('homes/delete', 'Admin\HomesController@delete');
    Route::get('home-communities/{id}', 'Admin\HomesController@communities');
    Route::post('homes/addcommunity', 'Admin\HomesController@addcommunity');

    // User Routes
    Route::get('users', 'Admin\UsersController@index');
    Route::get('users/create', 'Admin\UsersController@create');
    Route::get('users/edit/{id}', 'Admin\UsersController@edit');
    Route::get('users/communities/{id}', 'Admin\UsersController@communities');
    Route::post('users/addcommunity', 'Admin\UsersController@addcommunity');
    Route::post('users/delete-community', 'Admin\UsersController@deleteCommunity');
    Route::post('users/save', 'Admin\UsersController@save');
    Route::post('users/delete', 'Admin\UsersController@delete');

    // User Role management Routes
    Route::get('users/roles', 'Admin\UsersController@roles');
    Route::get('users/edit-permissions/{id}', 'Admin\UsersController@editPermissions');
    Route::post('users/save-permissions', 'Admin\UsersController@savePermissions');

    
    //Communities Routes
    Route::resource('communities', 'Admin\CommunitiesController');
    Route::get('communities/create', 'Admin\CommunitiesController@create');
    Route::get('communities/edit/{id}', 'Admin\CommunitiesController@edit');
    Route::post('communities/save', 'Admin\CommunitiesController@save');
    Route::post('communities/delete', 'Admin\CommunitiesController@delete');

    //Floor Routes
    Route::get('floors/list/{id}', 'Admin\FloorController@index');
    Route::get('floors/create/{id}', 'Admin\FloorController@create');
    Route::get('floors/edit/{id}', 'Admin\FloorController@edit');
    Route::post('floors/save', 'Admin\FloorController@save');
    Route::post('floors/delete', 'Admin\FloorController@delete');

    //User Floor Routes
    Route::get('floor_plans', 'Admin\FloorPlansController@index');

    //Features Routes
    Route::get('features/list/{id}', 'Admin\FeaturesController@index');
    Route::get('features/create/{id}', 'Admin\FeaturesController@create');
    Route::get('features/edit/{id}', 'Admin\FeaturesController@edit');
    Route::post('features/save', 'Admin\FeaturesController@save');
    Route::post('features/delete', 'Admin\FeaturesController@delete');
    Route::get('features/set-acl/{id}', 'Admin\FeaturesController@setACLOptions');
    Route::post('/features/get_acl_form', 'Admin\FeaturesController@getACLRow');
    Route::post('features/save-acl', 'Admin\FeaturesController@saveAclSettings')->name('saveAclSettings');
    Route::post('features/delete-acl', 'Admin\FeaturesController@deleteAclSettings')->name('deleteAclSettings');
    Route::post('features/re_order_list', 'Admin\FeaturesController@reOrderList');

    //Settings Routes
    Route::resource('settings', 'Admin\SettingController');
    Route::post('settings/save', 'Admin\SettingController@save');
});
