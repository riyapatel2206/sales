<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
   return redirect()->route('sale.list');
});

Route::get('/sales-list','SaleController@list')->name('sale.list');
Route::post('/add-dummy-records','SaleController@addDummyRecords')->name('sale.dummy.record');
Route::post('/list-fetch','SaleController@listFetch')->name('sales-list-fetch');
Route::post('/change-status','SaleController@changeStatus')->name('sales-change-status');
Route::get('/sales-view/{id}','SaleController@view')->name('sales-view');
Route::post('/product-import','ProductController@import')->name('product-import');