<?php

namespace App\Http\Controllers;

use App\Http\Models\Product;
use App\Http\Models\Order;
use App\Http\Models\Coupon;
use App\Helpers\ResponseHelpers;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $product;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function all(Request $request)
    {
        $orders = Order::all();
        return response()->json(ResponseHelpers::returnJsonData(Response::HTTP_OK, $orders, ''));
    }

    public function create(Request $request)
    {
        // check if input valid or invalid
        $postJSON = $request->json()->all();
        $v = \Validator::make($postJSON, Order::$rules, Order::$messages);

        if ($v->fails()) {
            return response()->json(ResponseHelpers::returnJson(Response::HTTP_BAD_REQUEST, $v->errors()->all()));
        }

        $order = Order::newOrder($postJSON);
        if ($order['status']) {
            return response()->json(ResponseHelpers::returnJson(Response::HTTP_OK, $order['message']));
        } else {
            return response()->json(ResponseHelpers::returnJson(Response::HTTP_INTERNAL_SERVER_ERROR, $order['message']));
        }
    }
}
