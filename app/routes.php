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
Route::group(array('before' => 'auth|csrf'), function()
{
	Route::get('/', 'DashboardController@index');
	Route::get('reports','ClientController@detailedReport');
	Route::get('client/addRecord/{id}','ClientController@addRecord');
	Route::post('client/addRecord/{id}','ClientController@handleAddRecord');
	Route::get('client/updateRecord/{id}','ClientController@updateRecord');
	Route::post('client/updateRecord','ClientController@handleUpdateRecord');
	Route::resource('client', 'ClientController');
	Route::resource('employee', 'EmployeeController');
});
//Login
Route::get('login', 'EmployeeController@showLogin')->before('guest');
Route::post('login', 'EmployeeController@doLogin')->before('guest');
//Logout
Route::get('logout', 'EmployeeController@doLogout')->before('auth');