<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return 'Hello Lumen';
});

$app->group(['prefix' => 'product'], function () use ($app) {
    $app->get('all', 'App\Http\Controllers\ProductController@all');
    $app->post('create', 'App\Http\Controllers\ProductController@create');
});

$app->group(['prefix' => 'coupon'], function () use ($app) {
    $app->get('all', 'App\Http\Controllers\CouponController@all');
    $app->post('create', 'App\Http\Controllers\CouponController@create');
});

$app->group(['prefix' => 'order'], function () use ($app) {
    $app->get('all', 'App\Http\Controllers\OrderController@all');
    $app->post('create', 'App\Http\Controllers\OrderController@create');
});
