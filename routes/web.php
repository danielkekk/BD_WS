<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'IndexController@index')->name('index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::get('/products', 'ProductController@index')->name('products')->middleware('product');
Route::post('/product', 'ProductController@create')->name('product')->middleware('product');
Route::get('/deleteproduct/{id}', 'ProductController@delete')->name('deleteproduct')->middleware('product');

Route::get('/categories', 'CategoriesController@index')->name('categories')->middleware('auth');
