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
    return view('index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', 'AdminController@index')->middleware('auth','admin');


Route::get('/user', 'UserController@index')->middleware('auth','user');
Route::post('user/store', 'UserController@store')->name('orders.store');
Route::get('user/create', 'UserController@create')->name('orders.create');
Route::get('user/order{order}/show', 'UserController@show')->name('orders.show');


