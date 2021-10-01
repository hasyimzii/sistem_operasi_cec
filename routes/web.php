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
    return view('auth.login');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', '\App\Http\Controllers\HomeController@index')->name('home');
    Route::get('/riwayat', '\App\Http\Controllers\HomeController@history')->name('history');
    // User
    Route::group(['as' => 'user.','prefix' => 'akun'], function () {
        Route::get('/', '\App\Http\Controllers\UserController@index')->name('index')->middleware('role:admin');
        Route::get('/create', '\App\Http\Controllers\UserController@create')->name('create')->middleware('role:admin');
        Route::post('/create', '\App\Http\Controllers\UserController@store')->name('store')->middleware('role:admin');
        Route::get('{id}/show', '\App\Http\Controllers\UserController@show')->name('show')->middleware('role:admin,employee');
        Route::get('{id}/edit', '\App\Http\Controllers\UserController@edit')->name('edit')->middleware('role:admin');
        Route::patch('{id}/edit', '\App\Http\Controllers\UserController@update')->name('update')->middleware('role:admin');
    });
    // Outlet
    Route::group(['as' => 'outlet.','prefix' => 'outlet'], function () {
        Route::get('/', '\App\Http\Controllers\OutletController@index')->name('index')->middleware('role:admin');
        Route::get('/create', '\App\Http\Controllers\OutletController@create')->name('create')->middleware('role:admin');
        Route::post('/create', '\App\Http\Controllers\OutletController@store')->name('store')->middleware('role:admin');
        Route::get('{id}/show', '\App\Http\Controllers\OutletController@show')->name('show')->middleware('role:admin,employee');
        Route::get('{id}/edit', '\App\Http\Controllers\OutletController@edit')->name('edit')->middleware('role:admin');
        Route::patch('{id}/edit', '\App\Http\Controllers\OutletController@update')->name('update')->middleware('role:admin');
    });
    // Category
    Route::group(['as' => 'category.','prefix' => 'kategori'], function () {
        Route::get('/', '\App\Http\Controllers\CategoryController@index')->name('index')->middleware('role:admin');
        Route::get('/create', '\App\Http\Controllers\CategoryController@create')->name('create')->middleware('role:admin');
        Route::post('/create', '\App\Http\Controllers\CategoryController@store')->name('store')->middleware('role:admin');
        Route::get('{id}/edit', '\App\Http\Controllers\CategoryController@edit')->name('edit')->middleware('role:admin');
        Route::patch('{id}/edit', '\App\Http\Controllers\CategoryController@update')->name('update')->middleware('role:admin');
    });
    // Product
    Route::group(['as' => 'product.','prefix' => 'produk'], function () {
        Route::get('/', '\App\Http\Controllers\ProductController@index')->name('index')->middleware('role:admin');
        Route::get('/create', '\App\Http\Controllers\ProductController@create')->name('create')->middleware('role:admin');
        Route::post('/create', '\App\Http\Controllers\ProductController@store')->name('store')->middleware('role:admin');
        Route::get('{id}/show', '\App\Http\Controllers\ProductController@show')->name('show')->middleware('role:admin,employee');
        Route::get('{id}/edit', '\App\Http\Controllers\ProductController@edit')->name('edit')->middleware('role:admin');
        Route::patch('{id}/edit', '\App\Http\Controllers\ProductController@update')->name('update')->middleware('role:admin');
    });
    // Stock
    Route::group(['as' => 'stock.','prefix' => 'stok'], function () {
        Route::get('/', '\App\Http\Controllers\StockController@index')->name('index')->middleware('role:admin');
        Route::get('{id}/stok', '\App\Http\Controllers\StockController@list')->name('list')->middleware('role:admin');
        Route::get('{id}/create', '\App\Http\Controllers\StockController@create')->name('create')->middleware('role:admin');
        Route::post('{id}/create', '\App\Http\Controllers\StockController@store')->name('store')->middleware('role:admin');
        Route::get('{id}/show', '\App\Http\Controllers\StockController@show')->name('show')->middleware('role:admin,employee');
        Route::get('{id}/edit', '\App\Http\Controllers\StockController@edit')->name('edit')->middleware('role:admin');
        Route::patch('{id}/edit', '\App\Http\Controllers\StockController@update')->name('update')->middleware('role:admin');
    });
});

Auth::routes();

