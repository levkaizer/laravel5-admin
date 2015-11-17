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

Route::get('/', 'HomeController@show');

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
    	'as' => 'save',
	    'uses' => 'ProfileController@updateProfile'
	]);
});

Route::get('admin', [
    'middleware' => 'auth',
    'uses' => 'AdminController@show'
]);

Route::get('install', [
    'uses' => 'InstallController@getIndex'
]);

Route::post('install', [
    'uses' => 'InstallController@postIndex',
    'as' => 'install-save'
]);

Route::group(['prefix' => 'admin', 'as' => 'admin::'], function(){

	//Route::controller('users', 'UserController');
	
	Route::get('users', [
    	'middleware' => 'auth',
    	'as' => 'users',
	    'uses' => 'UserController@getIndex'
	]);
	
	Route::get('users/edit/{id}', [
    	'middleware' => 'auth',
    	'as' => 'edit-user',
	    'uses' => 'UserController@getEdit'
	]);
	
	Route::post('users/edit/{id}', [
    	'middleware' => 'auth',
    	'as' => 'save-user',
	    'uses' => 'UserController@postEdit'
	]);
	
	Route::post('users/delete/{id}', [
    	'middleware' => 'auth',
    	'as' => 'delete-user',
	    'uses' => 'UserController@postDelete'
	]);
	
	Route::post('users/update-password', [
    	'middleware' => 'auth',
    	'as' => 'update-password',
	    'uses' => 'UserController@postUpdate_password'
	]);
	
	Route::get('info', [
    	'middleware' => 'auth',
    	'as' => 'info',
	    'uses' => 'AdminController@adminInfo'
	]);
	Route::post('saveInfo', [
    	'middleware' => 'auth',
    	'as' => 'edit-info',
	    'uses' => 'AdminController@saveAdminInfo'
	]);
	
	Route::get('themes', [
    	'middleware' => 'auth',
    	'as' => 'themes',
	    'uses' => 'AdminController@showThemes'
	]);
	Route::post('saveThemes', [
    	'middleware' => 'auth',
    	'as' => 'edit-themes',
	    'uses' => 'AdminController@saveThemes'
	]);
	
	Route::get('css', [
    	'middleware' => 'auth',
    	'as' => 'css',
	    'uses' => 'AdminController@frontEndCSS'
	]);
	Route::post('saveFrontEndCSS', [
    	'middleware' => 'auth',
    	'as' => 'edit-css',
	    'uses' => 'AdminController@saveFrontEndCSS'
	]);
	
	// mailing lists
	Route::get('lists', [
    	'middleware' => 'auth',
    	'as' => 'lists',
	    'uses' => 'MailListController@getAdminLists'
	]);
	
	Route::get('list-add', [
    	'middleware' => 'auth',
    	'as' => 'add-list',
	    'uses' => 'MailListController@getAdminCreateList'
	]);
	
	Route::post('list-add', [
    	'middleware' => 'auth',
    	'as' => 'save-list',
	    'uses' => 'MailListController@postAdminCreateList'
	]);
	
		Route::get('lists/edit/{id}', [
    	'middleware' => 'auth',
    	'as' => 'edit-list',
	    'uses' => 'MailListController@getAdminEditList'
	]);
	
	Route::post('lists/edit/{id}', [
    	'middleware' => 'auth',
    	'as' => 'edit-list-save',
	    'uses' => 'MailListController@postAdminEditList'
	]);
	
	Route::post('lists/status/{id}', [
    	'middleware' => 'auth',
    	'as' => 'delete-list',
	    'uses' => 'MailListController@postStatus'
	]);
	
	Route::post('lists/delete/{id}', [
    	'middleware' => 'auth',
    	'as' => 'delete-list',
	    'uses' => 'MailListController@postDelete'
	]);
	
	Route::get('lists/{id}/members', [
    	'middleware' => 'auth',
    	'as' => 'list-members',
	    'uses' => 'MailListController@getMembers'
	]);
	
	Route::get('lists/default', [
    	'middleware' => 'auth',
    	'as' => 'list-default',
	    'uses' => 'MailListController@getHomepageList'
	]);
	
	Route::post('lists/default', [
    	'middleware' => 'auth',
    	'as' => 'save-default',
	    'uses' => 'MailListController@postHomepageList'
	]);
	
	// debug
	if(\Configuration::debug()) {
		Route::get('flush', [
			'middleware' => 'auth',
			'as' => 'flush',
			'uses' => 'AdminController@flushRoutes'
		]);
	}
	
	
});

Route::post('lists/submit', [
	'as' => 'save-list-member',
	'uses' => 'MailListController@submit'
]);

Route::get('unsubscribe', [
	'as' => 'unsubscribe',
	'uses' => 'MailListController@unsubscribe'
]);