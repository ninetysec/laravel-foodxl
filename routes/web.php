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

// 操作路由

// Auth::routes();

// Route::get('home', 'HomeController@index')->name('home');
/*
Route::group(['prefix' => 'admin','namespace' => 'Admin'],function ($router)
{
    $router->get('login', 'AdminController@index')->name('admin.login');
    $router->post('login', 'AuthController@login');
    $router->post('logout', 'AuthController@logout');

    $router->get('dash', 'DashboardController@index');
});
*/
Route::group(['middleware' => 'web'], function () {

    // 前台登录
    /*
	Route::group(['prefix' => 'home','namespace' => 'home'], function ($router)
	{
		Route::any('login', 'AuthController@login')->name('admin.login');

		Route::group(['middleware' => 'home'], function ($router)
		{
			Route::get('/', 'AdminController@index');

		    Route::get('logout', 'AuthController@logout');

		    Route::get('order/list', 'OrderController@getList');

		    Route::get('order/info', 'OrderController@info');

		    Route::get('category/list', 'CategoryController@getList');

		    Route::get('category/info', 'CategoryController@info');

		    Route::get('goods/list', 'GoodsController@getList');

		    Route::get('goods/info', 'GoodsController@info');
		});
	});
	*/

	Route::get('/', 'DisplayController@index');

	Route::get('contact', 'DisplayController@contact');

	Route::get('cart', 'DisplayController@cart');

	Route::get('services', 'DisplayController@services');

	Route::get('order', 'DisplayController@order');

	Route::get('order_info', 'DisplayController@order_info');

	// 前台API
	// 后期界面完成添加中间件判断是否为ajax，才给予显示
	Route::group(['prefix' => 'api','namespace' => 'Api'], function ($router)
	{
		Route::get('category/list', 'CategoryController@index');

		Route::get('category/info', 'CategoryController@info');

		Route::get('goods/info', 'GoodsController@info');

		Route::get('cart/add', 'CartController@add');

		Route::any('cart/edit', 'CartController@edit');

		Route::get('cart/get', 'CartController@getList');

		Route::get('cart/address', 'CartController@address');

		Route::get('cart/act', 'CartController@act');

		Route::get('cart/checkout', 'CartController@checkout');

		Route::get('cart/clear', 'CartController@clear');

		Route::get('order/list', 'OrderController@getList');

		Route::get('order/info', 'OrderController@info');

		Route::get('order/search', 'OrderController@search');
	});

	// 后台登录
	Route::group(['prefix' => 'admin','namespace' => 'Admin'], function ($router)
	{
		Route::any('login', 'AuthController@login')->name('admin.login');

		Route::group(['middleware' => 'admin'], function ($router)
		{
			Route::get('/', 'AdminController@index');

		    Route::get('logout', 'AuthController@logout');

		    Route::get('order/list', 'OrderController@getList');

		    Route::get('order/info', 'OrderController@info');

		    Route::any('order/act', 'OrderController@act');

		    Route::get('category/list', 'CategoryController@getList');

		    Route::get('category/info', 'CategoryController@info');

		    Route::get('category/add', 'CategoryController@add');

		    Route::any('category/act', 'CategoryController@act');

		    Route::get('goods/list', 'GoodsController@getList');

		    Route::get('goods/info', 'GoodsController@info');

		    Route::get('goods/add', 'GoodsController@add');

		    Route::get('goods/status', 'GoodsController@status');

		    Route::any('goods/act', 'GoodsController@act');
		});
	});
});
