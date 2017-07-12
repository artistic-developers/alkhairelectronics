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

/*HOME CONTROLLER*/
Route::get('/home', 'HomeController@index');

Route::get('/products', 'HomeController@products');

Route::get('/products/add', 'HomeController@add_products');
Route::post('/products/add', 'HomeController@add_products_post');
Route::get('/products/edit/{product_id?}', 'HomeController@edit_product');
Route::post('/products/edit', 'HomeController@edit_product_post');

Route::get('/products/categories', 'HomeController@categories');
Route::post('/products/categories/add', 'HomeController@add_categories_post');
Route::post('/products/categories/edit', 'HomeController@edit_categories_post');

Route::get('/products/companies', 'HomeController@companies');
Route::post('/products/companies/add', 'HomeController@add_companies_post');
Route::post('/products/companies/edit', 'HomeController@edit_companies_post');


Route::group(['middleware'=>'auth'], function()
{

});
