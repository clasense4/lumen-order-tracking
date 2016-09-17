<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCoupon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::connection()->getPdo()->exec('
            CREATE TABLE IF NOT EXISTS "public"."coupon" (
                "coupon_id" varchar(38) NOT NULL COLLATE "default",
                "coupon_type_id" varchar(38) NOT NULL COLLATE "default",
                "code" varchar(10) NOT NULL COLLATE "default",
                "description" text NULL COLLATE "default",
                "value" int4 NOT NULL,
                "quantity" int4 NOT NULL,
                "start_date" int4 NOT NULL,
                "end_date" int4 NOT NULL,
                "created_at" timestamp,
                "updated_at" timestamp,
                "deleted_at" timestamp,
                CONSTRAINT coupon_pk PRIMARY KEY (coupon_id)
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
            ALTER TABLE "public"."coupon" DROP CONSTRAINT IF EXISTS "coupon_pk";
            DROP TABLE IF EXISTS "public"."coupon";
        ');
    }
}
