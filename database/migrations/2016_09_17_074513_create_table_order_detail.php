<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOrderDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::connection()->getPdo()->exec('
            CREATE TABLE IF NOT EXISTS "public"."order_detail" (
                "order_detail_id" varchar(38) NOT NULL COLLATE "default",
                "order_id" varchar(38) NOT NULL COLLATE "default",
                "product_id" varchar(38) NOT NULL COLLATE "default",
                "sku_code" varchar(30) NOT NULL COLLATE "default",
                "price" int4 NOT NULL,
                "quantity" int4 NOT NULL,
                "sub_total" int4 NOT NULL,
                "created_at" timestamp,
                "updated_at" timestamp,
                "deleted_at" timestamp,
                CONSTRAINT order_detail_pk PRIMARY KEY (order_detail_id)
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
            ALTER TABLE "public"."order_detail" DROP CONSTRAINT IF EXISTS "order_detail_pk";
            DROP TABLE IF EXISTS "public"."order_detail";
        ');
    }
}
