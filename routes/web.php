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
Route::get('/admin/login', 'Auth\LoginController@index')->name('admin.login');
Route::post('/authLogin', 'Auth\LoginController@authLogin')->name('authLogin');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');


Route::group(['prefix' => 'admin', 'middleware' => 'is_admin', 'namespace' => 'admin'], function (){
    Route::get('/products/trashed', 'ProductController@trashed')->name('products.trashed');
    Route::get('/products/kill/{id}', 'ProductController@kill')->name('products.kill');
    Route::get('/products/restore/{id}', 'ProductController@restore')->name('products.restore');
    Route::Resource('products', 'ProductController');
    Route::post('/products/product_details', 'ProductController@productDetail')->name('productDetail');
    Route::Resource('productSkuses', 'ProductSkusController');
    Route::get('/categories/trashed', 'CategoryController@trashed')->name('categories.trashed');
    Route::get('/categories/kill/{id}', 'CategoryController@kill')->name('categories.kill');
    Route::get('/categories/restore/{id}', 'CategoryController@restore')->name('categories.restore');
    Route::Resource('categories', 'CategoryController');
    Route::post('/featured/create', 'FeaturedController@store')->name('featured.store');
    Route::Resource('users', 'UserController');
    Route::Resource('roles', 'RoleController');
    Route::Resource('adminUsers', 'AdminUserController');
    Route::get('/get_roles', 'RoleController@getRoles')->name('getRoles');
});

Route::group(['namespace' => 'Front'], function (){
    Route::post('merchandise/{product}/favorite', 'MerchandiseController@favor')->name('merchandise.favor');
    Route::delete('merchandise/{product}/favorite', 'MerchandiseController@disfavor')->name('merchandise.disfavor');
    Route::get('merchandise/favorites', 'MerchandiseController@favorites')->name('merchandise.favorites');

    Route::resource('merchandise', 'MerchandiseController')->only(['index', 'show']);
    // 購物車
    Route::get('cart', 'CartController@index')->name('cart.index');
    Route::post('cart', 'CartController@add')->name('cart.add');
    Route::delete('cart/{sku}', 'CartController@remove')->name('cart.remove');

    Route::post('orders/{order}/received', 'OrderController@received')->name('orders.received');
    Route::get('orders/{order}/review', 'OrderController@review')->name('orders.review.show');
    Route::post('orders/{order}/review', 'OrderController@sendReview')->name('orders.review.store');
    Route::resource('orders', 'OrderController')->only(['index', 'store', 'show']);

    Route::post('orders/{order}/apply_refund', 'OrderController@applyRefund')->name('orders.apply_refund');
    Route::resource('user_addresses', 'UserAddressController')->except('show');

    Route::get('payment/{order}/website', 'PaymentController@payByWebsite')->name('payment.website');
    Route::post('payment/website/notify', 'PaymentController@websiteNotify')->name('payment.website.notify');
});