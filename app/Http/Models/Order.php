<?php

namespace App\Http\Models;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;

class Order extends Model
{
    use SoftDeletes;

    protected $table = 'order';
    protected $primaryKey = 'order_id';

    public $incrementing = false;

    public static $rules = [
        "product_id.*" => "required",
        "products" => "required",
        "products.*.sku_code" => "required|string|valid_product",
        // "products.*.product_id" => "required_with:sku_code|string|valid_product",
        "products.*.quantity" => "required|numeric|between:1,20",
        // "user_id" => "required",
        "coupon_code" => "valid_coupon",
    ];

    public static $messages = [
        'valid_product' => 'Product :attribute is out of stock.',
        'valid_coupon' => 'Coupon is out of stock, not exist, or expired.',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'user_id',
        'coupon_code',
        'coupon_value',
        'total',
        'total_before_coupon',
        'valid_by',
        'valid_at',
        'order_code'
    ];

    public static function newOrder($data)
    {
        $error = false;
        DB::beginTransaction();

        /**
         * Preparing variable
         */
        $order_id = Uuid::uuid4();
        $time = Carbon::now();
        $totalBeforeCoupon = 0;
        $coupon = (!empty($data['coupon_code'])? $data['coupon_code'] : false);
        $message = 'Order Failed.';

        // Calculate product to get subtotal (before coupon)
        $summaryProduct = Product::calculate($data['products']);
        $totalBeforeCoupon = Product::calculate($data['products'], $order_id, $time);
        $data['products'] = $totalBeforeCoupon['products'];

        // Check if in this order is using coupon
        if ($coupon) {
            $data += Coupon::calculate($coupon, $totalBeforeCoupon['sub_total']);
            $summaryProduct += Coupon::calculate($coupon, $totalBeforeCoupon['sub_total']);
        } else {
            $data['total'] = $totalBeforeCoupon['sub_total'];
            $summaryProduct['total'] = $summaryProduct['sub_total'];
            unset($summaryProduct['sub_total']);
        }

        try {
            // I'll leave here to test failed transaction
            // sleep(10);

            // Convert an email into a username, so when same email come, it didn't create a new one
            $username = sha1($data['customer']['email']);

            // If new username
            if (User::exist($username)) {
                $user_id = User::where('username', $username)->first()->user_id;
            } else {
                // Save Customer info
                $user_id = Uuid::uuid4();
                $data['customer']['user_id'] = $user_id;
                $data['customer']['user_type'] = 2;
                $data['customer']['username'] = $username;
                $data['customer']['password'] = app('hash')->make('secret'.time());
                User::create($data['customer']);
            }

            // Save Order Detail
            OrderDetail::insert($data['products']);

            // Save Order
            $data['order_id'] = $order_id;
            $data['order_code'] = str_random(6);
            // Add to summary
            $summaryProduct['order_code'] = $data['order_code'];
            $data['user_id'] = $user_id;
            $data['total_before_coupon'] = $totalBeforeCoupon['sub_total'];
            $order = Order::create($data);

            // Deducting Quantity of product
            foreach ($data['products'] as $key => $value) {
                \DB::table('product')->where('product_id','=',$value['product_id'])
                    ->decrement('quantity', $value['quantity']);

                // Check for error if the quantity below 1, then cancel the transaction
                $deductedProduct = Product::find($value['product_id'])->first()->quantity;
                if ($deductedProduct < 1) {
                    $error = true;
                    $message = "Product out of stock.";
                }
            }

            // Check if in this order is using coupon
            if ($coupon) {
                // Deducting Quantity of coupon
                $deductedCoupon = \DB::table('coupon')->where('code','=',$coupon)->decrement('quantity');

                // Check for error if the quantity below 1, then cancel the transaction
                $deductedCoupon = Coupon::where('code', $coupon)->first()->quantity;
                if ($deductedCoupon < 1) {
                    $error = true;
                    $message = "Coupon out of stock.";
                }
            }

            // Add to order status with status `1`, description `waiting for payment
            OrderStatus::create([
                'order_status_id' => Uuid::uuid4(),
                'order_id' => $order_id,
                'status' => 1,
                'description' => 'Waiting for payment',
                'created_at' => $time,
                'updated_at' => $time,
            ]);
        } catch (Exception $e) {
            $error = true;
        }

        if ($error) {
            // rollback if any errors while saving the data
            DB::rollback();

            return ['status' => false, 'message' => $message];
        } else {
            // commit the transactions
            DB::commit();
            $message = "Order success. Please paid ".$summaryProduct['total']." and upload payment proof to this URL " . env('BASE_URL') . "payment/proof/" . $summaryProduct['order_code'];
        }

        return ['status' => true, 'message' => $message, 'data' => $summaryProduct];
    }
}