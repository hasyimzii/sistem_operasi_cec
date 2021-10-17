<?php

use Illuminate\Support\Facades\Route;

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
    return redirect()->route('home');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', '\App\Http\Controllers\HomeController@index')->name('home');
    Route::get('/riwayat', '\App\Http\Controllers\HomeController@history')->name('history');
    // User
    Route::group(['as' => 'user.','prefix' => 'akun'], function () {
        Route::get('{id}/show', '\App\Http\Controllers\UserController@show')->name('show');
        Route::get('{id}/edit', '\App\Http\Controllers\UserController@edit')->name('edit');
        Route::post('{id}/edit', '\App\Http\Controllers\UserController@update')->name('update');
        Route::get('{id}/ganti-password', '\App\Http\Controllers\UserController@passEdit')->name('passEdit');
        Route::post('{id}/ganti-password', '\App\Http\Controllers\UserController@passUpdate')->name('passUpdate');
    });
    // Employee
    Route::group(['as' => 'employee.','prefix' => 'karyawan'], function () {
        Route::get('/', '\App\Http\Controllers\EmployeeController@index')->name('index')->middleware('admin');
        Route::get('/create', '\App\Http\Controllers\EmployeeController@create')->name('create')->middleware('admin');
        Route::post('/create', '\App\Http\Controllers\EmployeeController@store')->name('store')->middleware('admin');
        Route::get('{id}/show', '\App\Http\Controllers\EmployeeController@show')->name('show')->middleware('admin');
        Route::get('{id}/edit', '\App\Http\Controllers\EmployeeController@edit')->name('edit')->middleware('admin');
        Route::post('{id}/edit', '\App\Http\Controllers\EmployeeController@update')->name('update')->middleware('admin');
    });
    // Outlet
    Route::group(['as' => 'outlet.','prefix' => 'outlet'], function () {
        Route::get('/', '\App\Http\Controllers\OutletController@index')->name('index')->middleware('admin');
        Route::get('/create', '\App\Http\Controllers\OutletController@create')->name('create')->middleware('admin');
        Route::post('/create', '\App\Http\Controllers\OutletController@store')->name('store')->middleware('admin');
        Route::get('{id}/show', '\App\Http\Controllers\OutletController@show')->name('show');
        Route::get('{id}/edit', '\App\Http\Controllers\OutletController@edit')->name('edit')->middleware('admin');
        Route::post('{id}/edit', '\App\Http\Controllers\OutletController@update')->name('update')->middleware('admin');
    });
    // Category
    Route::group(['as' => 'category.','prefix' => 'kategori'], function () {
        Route::get('/', '\App\Http\Controllers\CategoryController@index')->name('index')->middleware('admin');
        Route::get('/create', '\App\Http\Controllers\CategoryController@create')->name('create')->middleware('admin');
        Route::post('/create', '\App\Http\Controllers\CategoryController@store')->name('store')->middleware('admin');
        Route::get('{id}/edit', '\App\Http\Controllers\CategoryController@edit')->name('edit')->middleware('admin');
        Route::post('{id}/edit', '\App\Http\Controllers\CategoryController@update')->name('update')->middleware('admin');
    });
    // Product
    Route::group(['as' => 'product.','prefix' => 'produk'], function () {
        Route::get('/', '\App\Http\Controllers\ProductController@index')->name('index')->middleware('admin');
        Route::get('/create', '\App\Http\Controllers\ProductController@create')->name('create')->middleware('admin');
        Route::post('/create', '\App\Http\Controllers\ProductController@store')->name('store')->middleware('admin');
        Route::get('{id}/show', '\App\Http\Controllers\ProductController@show')->name('show');
        Route::get('{id}/edit', '\App\Http\Controllers\ProductController@edit')->name('edit')->middleware('admin');
        Route::post('{id}/edit', '\App\Http\Controllers\ProductController@update')->name('update')->middleware('admin');
    });
    // Stock
    Route::group(['as' => 'stock.','prefix' => 'stok'], function () {
        Route::get('/', '\App\Http\Controllers\StockController@index')->name('index')->middleware('admin');
        Route::get('{id}/list', '\App\Http\Controllers\StockController@list')->name('list');
        Route::get('{id}/create', '\App\Http\Controllers\StockController@create')->name('create');
        Route::post('{id}/create', '\App\Http\Controllers\StockController@store')->name('store');
        Route::get('{id}/show', '\App\Http\Controllers\StockController@show')->name('show');
        Route::get('{id}/edit', '\App\Http\Controllers\StockController@edit')->name('edit');
        Route::post('{id}/edit', '\App\Http\Controllers\StockController@update')->name('update');
    });
    // Sale
    Route::group(['as' => 'sale.','prefix' => 'penjualan'], function () {
        Route::get('/', '\App\Http\Controllers\SaleController@index')->name('index')->middleware('admin');
        Route::get('{id}/list', '\App\Http\Controllers\SaleController@list')->name('list');
        Route::get('{id}/create', '\App\Http\Controllers\SaleController@create')->name('create');
        Route::post('{id}/create', '\App\Http\Controllers\SaleController@addList')->name('addList');
        // Route::post('{id}/create', '\App\Http\Controllers\SaleController@store')->name('store');
        Route::get('{id}/edit', '\App\Http\Controllers\SaleController@edit')->name('edit')->middleware('admin');
        Route::post('{id}/edit', '\App\Http\Controllers\SaleController@update')->name('update')->middleware('admin');
    });
});

Auth::routes();

