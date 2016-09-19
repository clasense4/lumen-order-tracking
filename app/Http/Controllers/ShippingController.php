<?php

namespace App\Http\Controllers;

use App\Http\Models\OrderShipping;
use App\Http\Models\Order;
use App\Helpers\ResponseHelpers;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class ShippingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function detail(Request $request, $shipping_code)
    {
        // No shipping Code
        if (empty($shipping_code)) {
            return response()->json(ResponseHelpers::returnJson(Response::HTTP_BAD_REQUEST, 'No shipping code'));
        }

        // shipping code not found
        $shipping = OrderShipping::select(['created_at as datetime', 'order_code', 'shipping_code', 'description'])
            ->where('shipping_code', $shipping_code)
            ->orderBy('created_at', 'desc')
            ->get();

        if (!is_object($shipping)) {
            return response()->json(ResponseHelpers::returnJson(Response::HTTP_OK, 'Shipping code not found'));
        }

        if (sizeof($shipping) < 1) {
            return response()->json(ResponseHelpers::returnJson(Response::HTTP_OK, 'Shipping code not found'));
        }

        return response()->json(ResponseHelpers::returnJson(Response::HTTP_OK, '', $shipping));
    }

    public function update(Request $request)
    {
        // check if input valid or invalid
        $postJSON = $request->json()->all();
        $rules = ['shipping_code' => 'required', 'description' => 'required'];
        $v = \Validator::make($postJSON, $rules);

        if ($v->fails()) {
            return response()->json(ResponseHelpers::returnJson(Response::HTTP_BAD_REQUEST, $v->errors()->all()));
        }

        // shipping code not found
        $order = Order::where('shipping_code', $postJSON['shipping_code'])->first();
        if (!is_object($order)) {
            return response()->json(ResponseHelpers::returnJson(Response::HTTP_OK, 'Shipping code not found'));
        }

        // Add to table OrderShipping
        OrderShipping::create([
            'order_shipping_id' => Uuid::uuid4(),
            'order_id' => $order->order_id,
            'order_code' => $order->order_code,
            'shipping_code' => $order->shipping_code,
            'description' => $postJSON['description'],
        ]);

        return response()->json(ResponseHelpers::returnJson(Response::HTTP_OK, 'Shipping detail added.', ''));
    }
}
