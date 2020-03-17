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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', function()
{
    return View::make('pages.home');
});

Route::get('/products', function()
{
    return View::make('pages.products');
});
/*Route::get('about', function()
{
    return View::make('pages.about');
});
Route::get('projects', function()
{
    return View::make('pages.projects');
});
Route::get('contact', function()
{
    return View::make('pages.contact');
});*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('weather', 'WeatherController@index');
Route::get('orders', 'OrdersController@index');
Route::get('orders/edit/{id}', 'OrdersController@edit');
Route::post('orders/edit/{id}', 'OrdersController@edit');
Route::get('products/page/{page}', 'ProductsController@page');
Route::put('products/update/{id}', 'ProductsController@update');
Route::get('tst', 'TstController@index');