<?php

namespace App\Http\Controllers;

use App\Http\Models\Order;
use App\Http\Models\OrderStatus;
use App\Http\Models\OrderDetail;
use App\Http\Models\OrderShipping;
use App\Helpers\ResponseHelpers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;

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
        $orders = Order::select('order_code','total','valid_at','valid_by','shipping_code','payment_file','shipped','user_id','order_id')
        ->with(['user' => function($query) {
            $query->select('user_id','name','email','phone_number','address');
        }])
        ->with(['status' => function($query) {
            $query->select('order_id','description');
        }])->get();

        return response()->json(ResponseHelpers::returnJson(Response::HTTP_OK, '', $orders));
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
            return response()->json(ResponseHelpers::returnJson(Response::HTTP_OK, 'Order code not found'));
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

        // Add to order status with status `2`, description `Payment Uploaded, waiting confirmation from administrator`
        OrderStatus::create([
            'order_status_id' => Uuid::uuid4(),
            'order_id' => $order->order_id,
            'status' => 2,
            'description' => 'Payment Uploaded, waiting confirmation from administrator',
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        return response()->json(ResponseHelpers::returnJson(Response::HTTP_OK, 'Payment Uploaded, please follow URL '. env('BASE_URL') .'payment/detail/'.$order_code.' to get shipping code and another updates.'));
    }

    public function detail(Request $request, $order_code)
    {
        // No order Code
        if (empty($order_code)) {
            return response()->json(ResponseHelpers::returnJson(Response::HTTP_BAD_REQUEST, 'No order code'));
        }

        // Order code not found
        $order = \DB::table('order')
            ->select(['total', 'order_code', 'shipping_code', 'updated_at as last_update', \DB::raw('(select description as status from order_status where order_status.order_id = "order".order_id order by updated_at desc limit 1)')])
            ->where('order_code', $order_code)->first();
        if (!is_object($order)) {
            return response()->json(ResponseHelpers::returnJson(Response::HTTP_OK, 'Order code not found'));
        }

        return response()->json(ResponseHelpers::returnJson(Response::HTTP_OK, '', $order));
    }

    public function viewFileByOrderCode(Request $request, $order_code)
    {
        // No order Code
        if (empty($order_code)) {
            return response()->json(ResponseHelpers::returnJson(Response::HTTP_BAD_REQUEST, 'No order code'));
        }

        // Order code not found
        $orderObj = Order::where('order_code', $order_code);
        $order = $orderObj->select(['total', 'order_code', 'shipping_code', 'updated_at as last_update'])->first();
        if (!is_object($order)) {
            return response()->json(ResponseHelpers::returnJson(Response::HTTP_OK, 'Order code not found'));
        }

        // Retrieve payment_file and display it
        $payment_file = $orderObj->select(['payment_file'])->first()->payment_file;
        return response()->make(Storage::get($payment_file), 200, [
            'Content-Type' => Storage::mimeType($payment_file),
            'Content-Disposition' => 'inline; '.$payment_file,
        ]);
    }

    public function confirmation(Request $request)
    {
        // check if input valid or invalid
        $postJSON = $request->json()->all();
        $v = \Validator::make($postJSON, ['order_code' => 'required']);

        if ($v->fails()) {
            return response()->json(ResponseHelpers::returnJson(Response::HTTP_BAD_REQUEST, $v->errors()->all()));
        }

        // Update table order, update valid_date and valid_by
        $order = Order::where([
            ['order_code', $postJSON['order_code']],
            ['payment_file', '!=', null]
        ])->first();
        if (!is_object($order)) {
            return response()->json(ResponseHelpers::returnJson(Response::HTTP_OK, 'Order code not found'));
        }

        $order->valid_by = 1;
        $order->valid_at = Carbon::now();
        $order->save();

        // Add to order status with status `3`, description `Payment confirmed, waiting for Shipping Code`
        $message = 'Payment confirmed, waiting for Shipping Code';
        OrderStatus::create([
            'order_status_id' => Uuid::uuid4(),
            'order_id' => $order->order_id,
            'status' => 3,
            'description' => $message,
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        return response()->json(ResponseHelpers::returnJson(Response::HTTP_OK, $message));
    }

    public function shippingCode(Request $request)
    {
        // check if input valid or invalid
        $postJSON = $request->json()->all();
        $v = \Validator::make($postJSON, ['order_code' => 'required', 'shipping_code' => 'required']);

        if ($v->fails()) {
            return response()->json(ResponseHelpers::returnJson(Response::HTTP_BAD_REQUEST, $v->errors()->all()));
        }

        // Update table order, update valid_date and valid_by
        $order = Order::where('order_code', $postJSON['order_code'])->first();
        if (!is_object($order)) {
            return response()->json(ResponseHelpers::returnJson(Response::HTTP_OK, 'Order code not found'));
        }

        $order->shipping_code = $postJSON['shipping_code'];
        $order->shipped = 1;
        $order->save();

        // Add to order status with status `4`, description `Shipping Code {shipping_code}, Thank You.`
        $message = 'Shipping Code '.$order->shipping_code.', Thank You.';
        OrderStatus::create([
            'order_status_id' => Uuid::uuid4(),
            'order_id' => $order->order_id,
            'status' => 4,
            'description' => $message,
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        return response()->json(ResponseHelpers::returnJson(Response::HTTP_OK, $message));
    }

    public function cancel(Request $request)
    {
        // check if input valid or invalid
        $postJSON = $request->json()->all();
        $v = \Validator::make($postJSON, ['order_code' => 'required']);

        if ($v->fails()) {
            return response()->json(ResponseHelpers::returnJson(Response::HTTP_BAD_REQUEST, $v->errors()->all()));
        }

        $error = false;
        \DB::beginTransaction();
        try {
            // Update table order, update valid_date and valid_by
            $order = Order::where('order_code', $postJSON['order_code'])->first();
            if (!is_object($order)) {
                return response()->json(ResponseHelpers::returnJson(Response::HTTP_OK, 'Order code not found'));
            }

            $order->valid_by = null;
            $order->valid_at = null;
            // $order->save();

            // Retrieve list of product, and increase the quantity
            $order_details = OrderDetail::where('order_id', $order->order_id)->get();
            foreach ($order_details as $key => $value) {
                // print_r($order_detail);
                \DB::table('product')->where('product_id','=',$value['product_id'])
                    ->increment('quantity', $value['quantity']);
            }

            // Retrieve list of coupon
            $increaseCoupon = \DB::table('coupon')->where('code','=',$order->coupon_code)->increment('quantity');

            // Add to order status with status `5`, description `Order is not vali, cancel transactiond.`
            $message = 'Order is not valid, cancel transaction.';
            OrderStatus::create([
                'order_status_id' => Uuid::uuid4(),
                'order_id' => $order->order_id,
                'status' => 5,
                'description' => $message,
                'created_at' => time(),
                'updated_at' => time(),
            ]);
        } catch (Exception $e) {
            $error = true;
        }

        if ($error) {
            // rollback if any errors while saving the data
            \DB::rollback();
        } else {
            // commit the transactions
            \DB::commit();
        }

        return response()->json(ResponseHelpers::returnJson(Response::HTTP_OK, $message));
    }

    public function viewUploadedProof(Request $request)
    {
        // Find Order with order_status = 2 (uploaded)
        $payment_url = env('BASE_URL').'payment/view/code/';
        $order = \DB::table('order')
            ->select(
                [
                    'order.order_code',
                    'order.coupon_code',
                    'order.coupon_value',
                    \DB::raw('concat(\''.$payment_url.'\',order_code) as payment_proof'),
                    'order_status.description',
                    'order.updated_at as last_update'
                ])
            ->join('order_status', 'order_status.order_id', '=', 'order.order_id')
            ->where('order_status.status', 2)
            ->where('order.shipped','=', null)
            ->where('order.valid_by','=', null)
            ->get();

        if (sizeof($order) == 0) {
            $msg = 'No Payment need to confirm.';
        } else {
            $msg = '';
        }
        return response()->json(ResponseHelpers::returnJson(Response::HTTP_OK, $msg, $order));
    }
}
