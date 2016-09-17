<?php

namespace database\seeds;

use Illuminate\Database\Seeder;
use DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        //delete tbl_application_type table records
        DB::table('product')->delete();
        //insert some default records
        DB::table('product')->insert([
          [
            'product_id' => '77e42794-5816-47ea-a8df-95f4fbc3158c',
            'product_type_id' => '1',
            'name' => 'Xiaomi Redmi 1s',
            'description' => 'First entry level xiaomi',
            'price' => 1500000,
            'quantity' => 15,
            'sku_code' => 'XMR1S',
            'created_at' => '2016-09-17 08:40:17',
            'updated_at' => '2016-09-17 08:40:17',
          ],
          [
            'product_id' => '43825c86-945c-46c5-b4b1-3544bf8b16bf',
            'product_type_id' => '1',
            'name' => 'Xiaomi Redmi 2',
            'description' => 'Second entry level xiaomi',
            'price' => 1600000,
            'quantity' => 13,
            'sku_code' => 'XMR2',
            'created_at' => '2016-09-17 08:40:17',
            'updated_at' => '2016-09-17 08:40:17',
          ],
        ]);
    }
}
