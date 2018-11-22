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
Route::get('admin/order{order}/show', 'AdminController@show')->name('admin.orders.show')->middleware('auth','admin');
Route::patch('admin/order{order}/update', 'AdminController@update')->name('admin.orders.update')->middleware('auth','admin');
Route::patch('admin/order{order}/show', 'AdminController@message')->name('admin.orders.message')->middleware('auth','admin');
Route::get('admin/download', 'AdminController@getDownload')->name('admin.orders.download')->middleware('auth','admin');

Route::get('/user', 'UserController@index')->middleware('auth','user');
Route::post('user/store', 'UserController@store')->name('user.orders.store')->middleware('auth','user');
Route::get('user/create', 'UserController@create')->name('user.orders.create')->middleware('auth','user');
Route::get('user/order{order}/show', 'UserController@show')->name('user.orders.show')->middleware('auth','user');
Route::patch('user/order{order}/show', 'UserController@message')->name('user.orders.message')->middleware('auth','user');

Route::get('send', 'MailController@send');


