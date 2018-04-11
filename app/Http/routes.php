<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// GET http://domain.com/
Route::get('/', 'IndexController@index'); // *** IndexController @ index = class @ method ***

// GET http://domain.com/intro
Route::get('intro', 'IndexController@intro'); // *** IndexController @ index = class @ method ***

// GET http://domain.com/products
Route::get('products', 'IndexController@products'); // *** IndexController @ index = class @ method ***

// GET http://domain.com/products/search/...
Route::get('products/search/{query}', 'IndexController@search');

// GET http://domain.com/products/category/1..0
Route::get('products/category/{id}', 'IndexController@category');

// GET http://domain.com/report/queue
Route::get('queue', 'ReportController@queue');

// need login before use
Route::group(['middleware' => 'auth'], function () {

    // GET http://domain.com/report
    Route::get('backend', function ()    {
        // return Redirect::to('manage-category');
        return Redirect::to('report');
    });

    // GET http://domain.com/manage-category            => CategoryController@index
    // GET http://domain.com/manage-category/create     => CategoryController@create
    // GET http://domain.com/manage-category/1/edit     => CategoryController@edit
    // GET http://domain.com/manage-category/1          => CategoryController@show
    // POST http://domain.com/manage-category           => CategoryController@store
    // PUT http://domain.com/manage-category/1          => CategoryController@update
    // DELETE http://domain.com/manage-category/1       => CategoryController@destroy
    Route::resource('manage-category', 'CategoryController');

    // GET http://domain.com/product                    => ProductController@index
    // GET http://domain.com/product/create             => ProductController@create
    // GET http://domain.com/product/1/edit             => ProductController@edit
    // GET http://domain.com/product/1                  => ProductController@show
    // POST http://domain.com/product                   => ProductController@store
    // PUT http://domain.com/product/1                  => ProductController@update
    // DELETE http://domain.com/product/1               => ProductController@destroy
    Route::resource('product', 'ProductController');

    // GET http://domain.com/product/search/...
    Route::get('product/search/{query}', 'ProductController@search');

    // GET http://domain.com/product/category/1..0
    Route::get('product/category/{id}', 'ProductController@category');

    // GET http://domain.com/report                     => ReportController@index
    Route::resource('report', 'ReportController');

    // GET http://domain.com/home
    Route::get('home', 'ReportController@index');
    // Route::get('home', 'CategoryController@index');

    // GET http://domain.com/history_report/1/2/2016
    Route::get('history_report/{d}/{m}/{y}', 'ReportController@history');

    // GET http://domain.com/reset-queue
    Route::get('reset-queue', 'ReportController@resetQueue');

    // GET http://domain.com/report/search/...
    Route::get('report/search/{query}', 'ReportController@search');

    // GET http://domain.com/report/category/1..0
    Route::get('report/category/{id}', 'ReportController@category');

    // GET http://domain.com/changepassword
    Route::get('changepassword', 'UserController@getChangePassword');

    // POST http://domain.com/changepassword
    Route::post('changepassword', 'UserController@postChangePassword');
});

// login page
Route::controllers([
    'auth' => 'Auth\AuthController',
    // 'password' => 'Auth\PasswordController',
]);

// for mobile use
Route::group(['prefix' => 'api'], function() use (&$productList, &$orderList)
{
    // POST http://domain.com/api/authenticate          = check login
    Route::post('authenticate', 'Api\AuthController@authenticate');

    // GET http://domain.com/api/product_list
    Route::get('product_list', 'Api\ProductController@getProductList');

    // POST http://domain.com/api/order
    Route::post('order', 'Api\OrderController@postOrder');

    // GET http://domain.com/api/queue
    Route::get('queue', 'Api\OrderController@getOrderQueue');

    // POST http://domain.com/api/queue_close
    Route::post('queue_close', 'Api\OrderController@postCloseOrderQueue');
});
