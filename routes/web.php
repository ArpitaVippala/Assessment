<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', 'App\Http\Controllers\ProductsController@getProducts');
Route::post('saveOrder', 'App\Http\Controllers\ProductsController@saveOrder')->name('saveOrder');
Route::post('saveDetails', 'App\Http\Controllers\ProductsController@saveDetails')->name('saveDetails');
