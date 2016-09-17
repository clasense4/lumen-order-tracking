<?php

namespace App\Http\Models;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;
use App\Http\Models\OrderProduct;
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
        'order_id','user_id','coupon_code','coupon_value','total','total_before_coupon','valid_by','valid_at'
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

        // Save Order Detail, embed sub_total and
        foreach ($data['products'] as $key => $value) {
            $data['products'][$key]['order_detail_id'] = Uuid::uuid4();
            $data['products'][$key]['order_id'] = $order_id;
            $data['products'][$key]['product_id'] = Product::getPrice($value['sku_code'])->product_id;
            $data['products'][$key]['price'] = Product::getPrice($value['sku_code'])->price;
            $data['products'][$key]['sub_total'] = $value['quantity'] * Product::getPrice($value['sku_code'])->price;
            $data['products'][$key]['created_at'] = $time;
            $data['products'][$key]['updated_at'] = $time;

            // Calculate sub_total to be added to total_before_coupon
            $totalBeforeCoupon += $data['products'][$key]['sub_total'];
        }

        // Check if in this order is using coupon
        if ($coupon) {
            // Get Coupon value
            $couponOrder = Coupon::getCouponData($coupon);
            // Deduction with using coupon, still hardcode
            if ($couponOrder['type'] == 1) {
                // Percentage
                $data['total'] = ($totalBeforeCoupon * (100 - $couponOrder['value'])) / 100;
                $data['coupon_value'] = ($totalBeforeCoupon * ($couponOrder['value'])) / 100;
            } elseif ($couponOrder['type'] == 2) {
                // Amount
                $data['total'] = $totalBeforeCoupon - $couponOrder['value'];
                $data['coupon_value'] = $couponOrder['value'];
            }
        } else {
            $data['total'] = $totalBeforeCoupon;
        }

        try {
            // I'll leave here to test failed transaction
            // sleep(10);

            // Save Customer info
            $username = sha1($data['customer']['name'].$data['customer']['email']);
            // If new username
            if (User::exist($username)) {
                $user_id = User::where('username', $username)->first()->user_id;
            } else {
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
            $data['user_id'] = $user_id;
            $data['total_before_coupon'] = $totalBeforeCoupon;
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
            $message = "Order success.";
        }

        return ['status' => true, 'message' => $message];
    }
}