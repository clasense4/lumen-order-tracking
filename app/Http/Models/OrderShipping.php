<?php

namespace App\Http\Models;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderShipping extends Model
{
    use SoftDeletes;

    protected $table = 'order_shipping';
    protected $primaryKey = 'order_shipping_id';

    public $incrementing = false;

    public static $rules = [
        "order_id" => "required",
        "order_code" => "required",
        "shipping_code" => "required",
        "description" => "required",
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_shipping_id',
        'order_id',
        'order_code',
        'shipping_code',
        'description',
    ];


}