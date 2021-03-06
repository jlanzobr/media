<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(['before' => 'auth'], function()
{
	Route::get('/', array('as'=>'/', 'uses'=> 'HomeController@getIndex'));
	Route::get('logout', array('as'=>'logout', 'uses'=> 'UserController@logoutHandler'));
	Route::get('media/{model}', array('uses'=> 'MediaController@displayMedia'));
	Route::post('search', array('as'=>'search',  'uses'=> 'MediaController@searchMedia'));
	Route::get('edit/{model}/{id}', array('uses'=> 'MediaController@editMediaItem'));
	Route::post('update', array('as'=>'update',  'uses'=> 'MediaController@saveMediaItem'));
});

Route::group(['before' => 'guest'], function()
{
	Route::get('login', array('as'=>'login', 'uses'=> 'UserController@showLoginPage'));
	Route::post('loginHandler', array('as'=>'loginHandler', 'uses'=> 'UserController@loginHandler'));
});
