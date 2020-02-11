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

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => 'auth'], function () {

    Route::get('customer', 'DashboardController@customer')->name('customer.index');

    Route::get('users', 'UserController@index')->name('user.index');
    Route::get('users/create', 'UserController@create')->name('user.create');
    Route::post('users', 'UserController@store')->name('user.store');
    Route::get('users/{userModel}', 'UserController@show')->name('user.show');
    Route::get('users/{user}/edit', 'UserController@edit')->name('user.edit');
    Route::patch('user/{user}', 'UserController@update')->name('user.update');
    Route::delete('user/{user}', 'UserController@destroy')->name('user.delete');


    Route::post('users/{user}/permission', 'UserPermissionController')->name('user.permission');

});
