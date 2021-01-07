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


Auth::routes();

Route::resource('products', 'ProductsController');
Route::resource('profile', 'ProfileController');
Route::resource('orders', 'OrdersController');
Route::resource('payments', 'PaymentsController');
Route::resource('transaction', 'TransactionController');
Route::get('/', 'HomeController@index')->name('homepage');
Route::get('/verify', 'ProductsController@verify')->name('products.verify');
Route::get('/paymentsadmin', 'PaymentsController@admin')->name('payments.admin');
Route::get('/myproducts', 'ProductsController@myproducts')->name('products.myproducts');
Route::get('/myproducts/delete', 'ProductsController@delete')->name('products.delete');
Route::get('/paymentsverify', 'PaymentsController@PaymentsVerification')->name('payments.verify');
Route::post('/orders', 'OrdersController@orders')->name('orders');
Route::post('/orders/delete', 'OrdersController@delete')->name('orders.delete');
Route::post('/orders/checkout', 'OrdersController@checkout')->name('orders.checkout');
Route::post('/payments/{update}','PaymentsController@update')->name('payments.update');
Route::post('/products/{update}','ProductsController@update')->name('products.update');
Route::post('/orders/{id}','OrdersController@update')->name('orders.finish');
