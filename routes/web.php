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
    Route::Resource('products', 'ProductController');
    Route::get('/categories/trashed', 'CategoryController@trashed')->name('categories.trashed');
    Route::get('/categories/kill/{id}', 'CategoryController@kill')->name('categories.kill');
    Route::get('/categories/restore/{id}', 'CategoryController@restore')->name('categories.restore');
    Route::Resource('categories', 'CategoryController');
    Route::post('/featured/create', 'FeaturedController@store')->name('featured.store');
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

});