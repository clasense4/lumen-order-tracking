<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCouponType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::connection()->getPdo()->exec('
            CREATE TABLE IF NOT EXISTS "public"."coupon_type" (
                "coupon_type_id" varchar(38) NOT NULL COLLATE "default",
                "name" varchar(20) NOT NULL COLLATE "default",
                "description" text NULL COLLATE "default",
                "created_at" timestamp,
                "updated_at" timestamp,
                "deleted_at" timestamp,
                CONSTRAINT coupon_type_pk PRIMARY KEY (coupon_type_id)
            );
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
            ALTER TABLE "public"."coupon_type" DROP CONSTRAINT IF EXISTS "coupon_type_pk";
            DROP TABLE IF EXISTS "public"."coupon_type";
        ');
    }
}
