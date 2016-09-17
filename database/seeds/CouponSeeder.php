<?php

namespace database\seeds;

use Illuminate\Database\Seeder;
use DB;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        //delete tbl_application_type table records
        DB::table('coupon')->delete();
        //insert some default records
        DB::table('coupon')->insert([
          [
            'coupon_id' => 'f2461ad4-f656-4719-9ff4-01bbcf8c2b27',
            'coupon_type_id' => '1', # Percentage
            'code' => 'ss50',
            'description' => '50% Discount',
            'value' => 50,
            'quantity' => 20,
            'start_date' => '2016-09-16 00:00:00',
            'end_date' => '2016-09-26 00:00:00',
            'created_at' => '2016-09-17 08:40:17',
            'updated_at' => '2016-09-17 08:40:17',
          ],
          [
            'coupon_id' => '66c07e3d-d4f3-4f7d-abb0-8b3c0d312c0f',
            'coupon_type_id' => '2', # Amount
            'code' => 'ss75',
            'description' => '75K Discount',
            'value' => 75000,
            'quantity' => 20,
            'start_date' => '2016-09-16 00:00:00',
            'end_date' => '2016-09-26 00:00:00',
            'created_at' => '2016-09-17 08:40:17',
            'updated_at' => '2016-09-17 08:40:17',
          ],
          [
            'coupon_id' => 'f62497db-74f1-4038-b1ca-1f28142992da', # exipired coupon
            'coupon_type_id' => '2', # Amount
            'code' => 'ss95',
            'description' => '95K Discount',
            'value' => 95000,
            'quantity' => 20,
            'start_date' => '2016-09-06 00:00:00',
            'end_date' => '2016-09-16 00:00:00',
            'created_at' => '2016-09-16 08:40:17',
            'updated_at' => '2016-09-16 08:40:17',
          ],
        ]);
    }
}
