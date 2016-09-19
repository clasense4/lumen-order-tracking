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
    $app->post('calculate', 'App\Http\Controllers\OrderController@calculate');
});

$app->group(['prefix' => 'payment'], function () use ($app) {
    $app->get('detail/{order_code}', 'App\Http\Controllers\PaymentController@detail');
    $app->get('view/code/{order_code}', 'App\Http\Controllers\PaymentController@viewFileByOrderCode');
    $app->get('view/file/{payment_file}', 'App\Http\Controllers\PaymentController@viewFileByPaymentFile');
    // Upload payment proof by customer
    $app->post('proof/{order_code}', 'App\Http\Controllers\PaymentController@proof');
});

$app->group(['middleware' => ['token']], function ($app) {
    $app->get('payment/admin/all_order', 'App\Http\Controllers\PaymentController@all');
    $app->post('payment/admin/view_proof', 'App\Http\Controllers\PaymentController@viewUploadedProof');
    $app->post('payment/admin/confirmation', 'App\Http\Controllers\PaymentController@confirmation');
    $app->post('payment/admin/shipping_code', 'App\Http\Controllers\PaymentController@shippingCode');
});
