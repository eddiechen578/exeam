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
    return view('auth.login');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/authLogin', 'Auth\LoginController@authLogin')->name('authLogin');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function (){
    Route::get('/index', 'ProductController@index')->name('index');
    Route::post('/product/create', 'ProductController@store')->name('product.store');
    Route::Resource('products', 'ProductController');
    Route::post('/featured/create', 'FeaturedController@store')->name('featured.store');
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');


});