<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Debugbar::enable();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/theme', function(){
    return \Theme::lists();
});

// Authentication routes...
Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('register', 'Auth\AuthController@getRegister');
Route::post('register', 'Auth\AuthController@postRegister');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

Route::group(['as' => 'profle::'], function(){
	Route::get('profile', [
    	'middleware' => 'auth',
	    'uses' => 'ProfileController@show'
	]);
	Route::get('profile/edit', [
    	'middleware' => 'auth',
	    'uses' => 'ProfileController@getEdit'
	]);
	Route::post('profile/edit', [
    	'middleware' => 'auth',
	    'uses' => 'ProfileController@updateProfile'
	]);
});

Route::get('admin', [
    'middleware' => 'auth',
    'uses' => 'AdminController@show'
]);

Route::group(['prefix' => 'admin', 'as' => 'admin::'], function(){
	Route::get('info', [
    	'middleware' => 'auth',
    	'as' => 'info',
	    'uses' => 'AdminController@adminInfo'
	]);
	
	Route::get('themes', [
    	'middleware' => 'auth',
    	'as' => 'themes',
	    'uses' => 'AdminController@showThemes'
	]);
});