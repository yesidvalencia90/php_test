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



});

Route::get('/users','UserController@home')->name('userHome');

Route::post('/user/add', 'UserController@store')->name('addUser');

Route::get('/user/get', 'UserController@get')->name('getUsers');

Route::put('/user/edit/{id}', 'UserController@edit')->name('editUser');

Route::delete('/user/delete/{id}', 'UserController@delete')->name('deleteUser');

Route::get('/buses','BusController@home')->name('busHome');

Route::post('/bus/add', 'BusController@store')->name('addBus');

Route::get('/bus/get', 'BusController@get')->name('getBus');

Route::put('/bus/edit/{id}', 'BusController@edit')->name('editBus');

Route::delete('/bus/delete/{id}', 'BusController@delete')->name('deleteBus');

