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


Route::get('/','billsController@index');

// Item.
Route::get('items','itemsController@index');
Route::get('item/create','itemsController@create');
Route::post('item/store','itemsController@store');
Route::get('item/edit/{id}','itemsController@edit');
Route::post('item/update/{id}','itemsController@update');
Route::get('getItem/{id}','itemsController@getItem');

// Bill.
Route::get('bills', 'billsController@bills');
Route::get('bill/view/{id}', 'billsController@view');
Route::post('bill/save', 'billsController@saveBill');
Route::get('getBill/items/{id}','billsController@getBillItem');
Route::get('getBill/json','billsController@getBillsJson');


// Copying
Route::get('copying/search','copyingController@search');
Route::post('copying/searchResult','copyingController@searchResult');
Route::get('copying/create','copyingController@create');
Route::post('copying/store','copyingController@store');

// remainderController
Route::get('remainder','remainderController@index');
Route::get('get/turnover/{id}','billsController@getTurnover');
Route::post('remainder/store','remainderController@store');

// Users
Route::get('users','usersController@index');
Route::get('user/create','usersController@create');
Route::post('user/store','usersController@store');
Route::get('user/edit/{id}','usersController@edit');
Route::put('user/update/{id}','usersController@update');
Route::delete('user/delete/{id}','usersController@delete');

// BackUp Routers.
Route::get('backUp','backupController@index');
Route::post('backUp/export','backupController@export');
Route::post('backUp/import','backupController@import');

// Settings
Route::get('settings','settingsController@index');
Route::post('settings/save','settingsController@save');


// Reports.
Route::get('report/custom','reportsController@custom');
Route::post('report/show/custom','reportsController@showCustom');
Route::get('report/daily','reportsController@daily');


Auth::routes();

Route::get('/logout', function(){
    Auth::logout();
    return Redirect::to('login');
});