<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::connection()->getPdo()->exec('
            CREATE TABLE IF NOT EXISTS "public"."order" (
                "order_id" varchar(38) NOT NULL COLLATE "default",
                "user_id" varchar(38) NOT NULL COLLATE "default",
                "coupon_code" varchar(10) COLLATE "default",
                "coupon_value" int4,
                "total" int4 NOT NULL,
                "valid_by" varchar(38) COLLATE "default",
                "valid_at" timestamp,
                "created_at" timestamp,
                "updated_at" timestamp,
                "deleted_at" timestamp,
                CONSTRAINT order_pk PRIMARY KEY (order_id)
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
            ALTER TABLE "public"."order" DROP CONSTRAINT IF EXISTS "order_pk";
            DROP TABLE IF EXISTS "public"."order";
        ');
    }
}
