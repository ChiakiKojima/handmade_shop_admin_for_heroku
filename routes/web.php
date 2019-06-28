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

Route::get('/', 'ItemsController@index')->name('home');
Route::get('about','PagesController@about')->name('about');

//Route::get('items', 'ItemsController@index')->name('items.index');

//Route::get('items/create', 'ItemsController@create')->name('items.create');
//Route::get('items/{id}', 'ItemsController@show')->name('items.show');

//Route::post('items', 'ItemsController@store')->name('items.store');

//Route::get('items/{id}/edit', 'ItemsController@edit')->name('items.edit');  
//Route::patch('items/{id}', 'ItemsController@update')->name('items.update');
//Route::delete('items/{id}', 'ItemsController@destroy')->name('items.destroy');

Route::resource('items', 'ItemsController');
Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
