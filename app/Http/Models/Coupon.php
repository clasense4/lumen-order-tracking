<?php

namespace App\Http\Models;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class Coupon extends Model
{
    use SoftDeletes;

    protected $table = 'coupon';
    protected $primaryKey = 'coupon_id';
    public $incrementing = false;

    public static $rules = [
        "coupon_type_id" => "required",
        "code" => "required",
        "description" => "required",
        "value" => "required",
        "quantity" => "required",
        "start_date" => "required",
        "end_date" => "required",
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['start_date', 'end_date', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['coupon_id','coupon_type_id', 'code', 'description', 'value', 'quantity', 'start_date', 'end_date'];

    public static function newCoupon($data)
    {
        // Embed coupon_id
        $data['coupon_id'] = Uuid::uuid4();
        // Validate coupon type
        $product = self::create($data);
        return true;
    }

    public static function getCouponData($code)
    {
        $coupon = self::where([
            ['code','=',$code],
            ['quantity','>',0]
        ])->first();
        if (is_object($coupon)) {
            return [
                'type' => $coupon->coupon_type_id,
                'value' => $coupon->value,
            ];
        } else {
            return false;
        }
    }
}