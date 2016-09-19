<?php

namespace App\Providers;

use Validator;
use Illuminate\Support\ServiceProvider;
use App\Http\Models\Coupon;
use App\Http\Models\Product;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Can't continue when coupon code is not exists or expired
         */
        Validator::extend('valid_coupon', function($attribute, $value, $parameters, $validator) {
            if (is_array($value)) {
                return false;
            }

            $model = Coupon::where([
                ['code', '=', $value],
                ['quantity', '>', 0],
                ['start_date', '<=', Carbon::now()],
                ['end_date', '>=', Carbon::now()],
            ])->first();
            if (is_object($model)) {
                return true;
            } else {
                return false;
            }
        });

        /**
         * Can't continue when product quantity is below 1
         */
        Validator::extend('valid_product', function($attribute, $value, $parameters, $validator) {
            $model = Product::where(
                'sku_code', '=', $value
            )
            ->where('quantity', '>', 0)->first();
            if (is_object($model)) {
                return true;
            } else {
                return false;
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
