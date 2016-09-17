<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableCoupon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::connection()->getPdo()->exec('
            ALTER TABLE coupon
                DROP COLUMN IF EXISTS start_date;
            ALTER TABLE coupon
                DROP COLUMN IF EXISTS end_date;
            ALTER TABLE coupon
                ADD COLUMN start_date timestamp;
            ALTER TABLE coupon
                ADD COLUMN end_date timestamp;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::connection()->getPdo()->exec('
            ALTER TABLE coupon
                DROP COLUMN IF EXISTS start_date;
            ALTER TABLE coupon
                DROP COLUMN IF EXISTS end_date;
            ALTER TABLE coupon
                ADD COLUMN start_date int4 NOT NULL default 0;
            ALTER TABLE coupon
                ADD COLUMN end_date int4 NOT NULL default 0;
        ');
    }
}
