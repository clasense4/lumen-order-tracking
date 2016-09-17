<?php

namespace App\Http\Models;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class OrderDetail extends Model
{
    use SoftDeletes;

    protected $table = 'order_detail';
    protected $primaryKey = 'order_detail_id';

    public $incrementing = false;

    public static $rules = [
        "order_id" => "required",
        "product_id" => "required",
        "quantity" => "required",
        "price" => "required",
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['order_id','product_id','quantity','price'];

    public static function newOrderDetail($data)
    {
        // Embed coupon_id
        $data['coupon_id'] = Uuid::uuid4();
        // Validate coupon type
        $product = self::create($data);
        return true;
    }
}