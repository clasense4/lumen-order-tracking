<?php

namespace App\Http\Models;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'product';
    protected $primaryKey = 'product_id';
    public $incrementing = false;

    public static $rules = [
        "product_type_id" => "required",
        "name" => "required",
        "description" => "required",
        "price" => "required",
        "quantity" => "required",
        "sku_code" => "required",
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['product_id','product_type_id', 'name', 'description', 'price', 'quantity','sku_code'];

    public static function newProduct($data)
    {
        // Embed product_id
        $data['product_id'] = Uuid::uuid4();
        // Validate product type
        $product = self::create($data);
        return true;
    }

    public static function bySku($sku_code)
    {
        return self::where('sku_code',$sku_code)->firstOrFail();
    }

    public static function calculate(Array $products, $order_id = false, $time = false)
    {
        $sub_total = 0;
        $result = [];

        foreach ($products as $key => $value) {
            $productModel = Product::bySku($value['sku_code']);
            $products[$key]['price'] = $productModel->price;
            $products[$key]['sub_total'] = $value['quantity'] * $productModel->price;

            // if order id given add to array
            if (($order_id) && ($time)) {
                $products[$key]['order_detail_id'] = Uuid::uuid4();
                $products[$key]['order_id'] = $order_id;
                $products[$key]['product_id'] = $productModel->product_id;
                $products[$key]['created_at'] = $time;
                $products[$key]['updated_at'] = $time;
                $result['products'] = $products;
            } else {
                $result['products'][$key]['name'] = $productModel->name;
                $result['products'][$key]['price'] = $productModel->price;
                $result['products'][$key]['quantity'] = $value['quantity'];
                $result['products'][$key]['sub_total'] = $value['quantity'] * $productModel->price;
            }

            // Calculate sub_total to be added to total_before_coupontrfgb
            $sub_total += $products[$key]['sub_total'];
        }

        $result['sub_total'] = $sub_total;

        return $result;
    }
}