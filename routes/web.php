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

Route::get('/', 'ProductsController@index');

Route::get('/checkout', 'ProductsController@checkout');

Route::get('/testmail', 'OrdersController@testmail');

Route::post('/charge', 'OrdersController@charge');

Route::get('/create-payment-intent', 'OrdersController@createPaymentIntent');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
