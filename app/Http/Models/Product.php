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

    public static function getPrice($sku_code)
    {
        return self::where('sku_code',$sku_code)->firstOrFail();
    }
}