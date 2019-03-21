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
    return view('about');
});

Auth::routes();


Route::resource('product', 'ProductsController');
Route::resource('category', 'CategoryController');
Route::resource('reservation', 'ReservationController');
Route::resource('customer', 'CustomerController');

Route::get('/dash', 'HomeController@index')->name('home');
Route::get('/about', 'HomeController@about')->name('about');
Route::get('/contact', 'HomeController@contact')->name('contact');
Route::get('/products', 'HomeController@products')->name('product');
