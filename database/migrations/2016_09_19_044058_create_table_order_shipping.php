<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOrderShipping extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::connection()->getPdo()->exec('
            CREATE TABLE IF NOT EXISTS "public"."order_shipping" (
                "order_shipping_id" varchar(38) NOT NULL COLLATE "default",
                "order_id" varchar(38) NOT NULL COLLATE "default",
                "order_code" varchar(30) NOT NULL COLLATE "default",
                "shipping_code" varchar(150),
                "description" text NULL COLLATE "default",
                "created_at" timestamp,
                "updated_at" timestamp,
                "deleted_at" timestamp,
                CONSTRAINT order_shipping_pk PRIMARY KEY (order_shipping_id)
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
            ALTER TABLE "public"."order_shipping" DROP CONSTRAINT IF EXISTS "order_shipping_pk";
            DROP TABLE IF EXISTS "public"."order_shipping";
        ');
    }
}
