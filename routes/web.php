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
// */

// use Illuminate\Routing\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//company
Route::resource('company','CompanyController');

//product and Product Type resources
Route::resource('productType','ProductTypeController');
Route::resource('product','ProductController');

//supplier and customers resources
Route::resource('supplier','SupplierController');
Route::resource('customer','CustomerController');

//storeIn
Route::resource('storeIn','StoreInController');
Route::get('storeIn/pdf/{id}','StoreInController@download_Pdf')->name('storein.downloadPdf');


//store out
Route::resource('storeOut','StoreOutController');
Route::get('/storeOut/pdf/{id}','StoreOutController@download_Pdf')->name('storeout.downloadPdf');


//waste Controller
Route::resource('waste','WasteController');
Route::get('/waste/pdf/{id}','WasteController@download_Pdf')->name('waste.downloadPdf');

//report  Store status
Route::get('report', 'ReportController@index')->name('report.index');

//report  Date status
Route::get('report/date', 'ReportController@search_date_wise')->name('report.date');
Route::post('report/date/search', 'ReportController@search_date_wise')->name('report.search');


//report  supplier status
Route::get('report/supplier', 'ReportController@supplier_wise')->name('report.supplier');
Route::post('report/supplier', 'ReportController@supplier_wise_report')->name('report.supplier_wise');


//income year
Route::resource('income','IncomeYearController');


//Group Ledger
Route::resource('ledger','GroupledgerController');

//sub group Ledger
Route::resource('subledger','SubGroupLedgerController');


//control ledger
Route::resource('controlLedger','ControlLedgerController');
