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
Route::get('/categorytree', 'CategoriesController@categoryTree')->name('categorytree')->middleware('auth');
Route::get('/leafcategories', 'CategoriesController@getLeafCategories')->name('leafcategories')->middleware('auth');
Route::get('/singlepath/{node}', 'CategoriesController@getSinglePath')->where('node', '[A-Z]+')->name('singlepath')->middleware('auth');
Route::get('/depthofnodes', 'CategoriesController@getDepthOfNodes')->name('depthofnodes')->middleware('auth');
Route::get('/depthofsubtree/{node}', 'CategoriesController@getDepthOfSubtree')->where('node', '[A-Z]+')->name('depthofsubtree')->middleware('auth');
Route::get('/subordinatesofanode/{node}', 'CategoriesController@getSubordinates')->where('node', '[A-Z]+')->name('subordinatesofanode')->middleware('auth');
Route::get('/addnewnode/{node}/{newnode}', 'CategoriesController@addNewNode')->name('addnewnode')->middleware('auth');
Route::get('/addnewnodeaschildofnode/{node}/{newnode}', 'CategoriesController@addNewNodeASChildOfNode')->name('addnewnodeaschildofnode')->middleware('auth');
Route::get('/deleteLeafNode/{node}', 'CategoriesController@deleteLeafNode')->name('deleteLeafNode')->middleware('auth');
Route::get('/deleteParentNode/{node}', 'CategoriesController@deleteParentNode')->name('deleteParentNode')->middleware('auth');

Route::post('/createnewnode', 'CategoriesController@createNewNode')->name('createnewnode')->middleware('auth');
Route::get('/removenode/{nodeid}', 'CategoriesController@removeNode')->name('removenode')->middleware('auth');

Route::get('/termekek', 'CategoriesController@productsBrowser')->name('termekek')->middleware('auth');
Route::get('/termekek/{catid}', 'CategoriesController@getTermekek')->middleware('auth');
