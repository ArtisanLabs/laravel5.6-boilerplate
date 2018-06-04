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

Route::get('/home', [
	'uses' => 'HomeController@index',
	'as' => 'home'
]);

// The password routes
Route::get('/password', [
	'uses' => 'HomeController@getPasswordPage',
	'as' => 'user.password'
]);

Route::post('/password', [
	'uses' => 'HomeController@updateUserPassword',
	'as' => 'user.password'
]);

// Notification routes
Route::get('/inbox', [
	'uses' => 'HomeController@showUserInbox',
	'as' => 'user.inbox'
]);