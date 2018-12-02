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

Route::get('/admin', 'AdminController@index')->name('admin.index')->middleware('auth','admin');
Route::get('/admin/user{user}', 'AdminController@userorders')->name('admin.user.show')->middleware('auth','admin');
Route::get('admin/order{order}/show', 'AdminController@show')->name('admin.orders.show')->middleware('auth','admin');

Route::patch('admin/order{order}/show', 'AdminController@message')->name('admin.orders.message')->middleware('auth','admin');

Route::delete('order/{order}', 'OrderController@destroy')->name('orders.delete')->middleware('auth','admin');

Route::get('/orders', 'HomeController@orders')->middleware('auth','user');

Route::post('store', 'OrderController@store')->name('orders.store')->middleware('auth','user');
Route::get('create', 'OrderController@create')->name('orders.create')->middleware('auth','user');
Route::get('order{order}/show', 'OrderController@show')->name('orders.show')->middleware('auth','user');
Route::patch('order{order}/show', 'OrderController@message')->name('orders.message')->middleware('auth','user');
Route::delete('order/{order}', 'OrderController@destroy')->name('orders.delete')->middleware('auth','admin');
Route::patch('order{order}/update', 'OrderController@update')->name('orders.update')->middleware('auth','admin');


Route::get('profile', 'ProfileController@index')->name('user.profile')->middleware('auth','user');
Route::patch('profile/update', 'ProfileController@update')->name('user.profile.update')->middleware('auth','user');
Route::get('profile/edit', 'ProfileController@edit')->name('user.profile.edit')->middleware('auth','user');




