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

Route::middleware(['auth'])->group(function () {

	//Users URL's

	Route::get('/users','UserController@home')->name('userHome');

	Route::post('/user/add', 'UserController@store')->name('addUser');

	Route::get('/user/get', 'UserController@get')->name('getUsers');

	Route::put('/user/edit/{id}', 'UserController@edit')->name('editUser');

	Route::delete('/user/delete/{id}', 'UserController@delete')->name('deleteUser');

	//Buses URL's

	Route::get('/buses','BusController@home')->name('busHome');

	Route::post('/bus/add', 'BusController@store')->name('addBus');

	Route::get('/bus/get', 'BusController@get')->name('getBus');

	Route::put('/bus/edit/{id}', 'BusController@edit')->name('editBus');

	Route::delete('/bus/delete/{id}', 'BusController@delete')->name('deleteBus');

	//Routes URL's

	Route::get('/routes','RouteController@home')->name('routeHome');

	Route::post('/route/add', 'RouteController@store')->name('addRoute');

	Route::get('/route/get', 'RouteController@get')->name('getRoute');

	Route::put('/route/edit/{id}', 'RouteController@edit')->name('editRoute');

	Route::delete('/route/delete/{id}', 'RouteController@delete')->name('deleteRoute');

});


//Quotes URL's

Route::get('/quote','QuoteController@home')->name('quoteHome');

Route::post('/quote/price', 'QuoteController@price')->name('priceQuote');

