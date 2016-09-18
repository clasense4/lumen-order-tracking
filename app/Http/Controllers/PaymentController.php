<?php

namespace App\Http\Controllers;

use App\Http\Models\Order;
use App\Helpers\ResponseHelpers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class PaymentController extends Controller
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
        // $orders = Order::all();
        // return response()->json(ResponseHelpers::returnJson(Response::HTTP_OK, '', $orders));
    }

    public function proof(Request $request, $order_code)
    {
        // No order Code
        if (empty($order_code)) {
            return response()->json(ResponseHelpers::returnJson(Response::HTTP_BAD_REQUEST, 'No order code'));
        }

        // Order code not found
        $order = Order::where('order_code', $order_code)->first();
        if (!is_object($order)) {
            return response()->json(ResponseHelpers::returnJson(Response::HTTP_OK, 'Order code ot found'));
        }

        // Get uploaded file
        $file = $request->file('photo');
        if (empty($file)) {
            return response()->json(ResponseHelpers::returnJson(Response::HTTP_BAD_REQUEST, 'No photo'));
        }

        // rename the file
        $ext = explode('.', $file->getClientOriginalName())[1];
        $filename = $order->order_id . "_" . $order->order_code . "." . $ext;

        // Save to local
        Storage::disk('local')->put($filename, File::get($file));

        // Update order table with uploaded filename
        $order->payment_file = $filename;
        $order->save();

        return response()->json(ResponseHelpers::returnJson(Response::HTTP_OK, 'Payment Uploaded, please follow URL '. env('BASE_URL') .'payment/detail/'.$order_code.' to get shipping code and another updates.'));
    }

    public function detail(Request $request, $order_code)
    {
        // No order Code
        if (empty($order_code)) {
            return response()->json(ResponseHelpers::returnJson(Response::HTTP_BAD_REQUEST, 'No order code'));
        }

        // Order code not found
        $order = Order::where('order_code', $order_code)->select(['total', 'order_code', 'shipping_code', 'updated_at as last_update'])->first();
        if (!is_object($order)) {
            return response()->json(ResponseHelpers::returnJson(Response::HTTP_OK, 'Order code ot found'));
        }

        return response()->json(ResponseHelpers::returnJson(Response::HTTP_OK, '', $order));
    }

    public function viewFile(Request $request, $order_code)
    {
        // No order Code
        if (empty($order_code)) {
            return response()->json(ResponseHelpers::returnJson(Response::HTTP_BAD_REQUEST, 'No order code'));
        }

        // Order code not found
        $orderObj = Order::where('order_code', $order_code);
        $order = $orderObj->select(['total', 'order_code', 'shipping_code', 'updated_at as last_update'])->first();
        if (!is_object($order)) {
            return response()->json(ResponseHelpers::returnJson(Response::HTTP_OK, 'Order code ot found'));
        }

        // Retrieve payment_file and display it
        $payment_file = $orderObj->select(['payment_file'])->first()->payment_file;
        return response()->make(Storage::get($payment_file), 200, [
            'Content-Type' => Storage::mimeType($payment_file),
            'Content-Disposition' => 'inline; '.$payment_file,
        ]);
    }
}
