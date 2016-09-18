<?php

namespace App\Http\Models;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;
use App\Http\Models\OrderProduct;
use Carbon\Carbon;

class OrderStatus extends Model
{
    use SoftDeletes;

    protected $table = 'order_status';
    protected $primaryKey = 'order_status_id';

    public $incrementing = false;

    public static $rules = [
        "order_status_id" => "required",
        "order_id" => "required",
        "status" => "required",
        "description" => "required",
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_status_id',
        'order_id',
        'user_id',
        'status',
        'description',
    ];


}