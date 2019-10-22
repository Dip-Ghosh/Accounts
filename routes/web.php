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

//product and Product Type resources
Route::resource('productType','ProductTypeController');
Route::resource('product','ProductController');

//supplier and customers resources
Route::resource('supplier','SupplierController');
Route::resource('customer','CustomerController');

//storeIn,storeOut & waste resources
Route::resource('storeIn','StoreInController');
Route::resource('storeOut','StoreOutController');
Route::resource('waste','WasteController');

