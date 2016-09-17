<?php

namespace App\Http\Models;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class User extends Model
{
    use SoftDeletes;

    protected $table = 'user';
    protected $primaryKey = 'user_id';

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','user_type','name','username','email','password','phone_number','address'
    ];

    public static function exist($username)
    {
        $model = self::where(
            'username', '=', $username
        )->first();
        if (is_object($model)) {
            return true;
        } else {
            return false;
        }
    }
}