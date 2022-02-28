<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes(['register' => false]);

// Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix' => 'owner', 'middleware' => ['auth','role:owner']], function() {
    Route::get('/', 'Owner\DashboardController@index');
    Route::resource('/stores', 'Owner\StoreController');
    Route::resource('/employees', 'Owner\EmployeeController');
});

Route::group(['prefix' => 'storekeeper', 'middleware' => ['auth','role:storekeeper']], function() {
    Route::get('/', 'StoreKeeper\DashboardController@index');
    Route::get('products/{id}/stock', 'StoreKeeper\DashboardController@newStock')->name('product.newStock');
    Route::put('products/{id}/stock', 'StoreKeeper\DashboardController@storeStock')->name('product.storeStock');
    Route::resource('/workers', 'StoreKeeper\WorkerController');
    Route::resource('/categories', 'StoreKeeper\ProductCategoryController');
    Route::resource('/products', 'StoreKeeper\ProductController');
    Route::resource('/sales', 'StoreKeeper\SaleController');
    Route::post('/sales/{id}', 'StoreKeeper\DashboardController@addproduct')->name('sale.addproduct');
    Route::post('/sale/{id}', 'StoreKeeper\DashboardController@finalize')->name('sale.finalize');
    Route::get('/sales/{id}', 'StoreKeeper\DashboardController@showsale')->name('sale.showsale');
    Route::delete('/sales/{id}/edit', 'StoreKeeper\DashboardController@removeprod')->name('order.removeprod');
    Route::put('/sales/{id}', 'StoreKeeper\DashboardController@updateprod')->name('order.updateprod');
    // Route::get('sales/{sales}/addproduct', ['as' => 'sales.addproduct', 'uses' => 'StoreKeeper\SaleController@addproduct']);
});

Route::group(['prefix' => 'worker', 'middleware' => ['auth','role:worker']], function() {
    Route::get('/', 'Worker\DashboardController@index');
});