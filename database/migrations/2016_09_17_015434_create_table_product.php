<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::connection()->getPdo()->exec('
            CREATE TABLE IF NOT EXISTS "public"."product" (
                "product_id" varchar(38) NOT NULL COLLATE "default",
                "product_type_id" varchar(38) NOT NULL COLLATE "default",
                "name" varchar(255) NOT NULL COLLATE "default",
                "description" text NULL COLLATE "default",
                "price" int4 NOT NULL,
                "quantity" int4 NOT NULL,
                "created_at" timestamp,
                "updated_at" timestamp,
                "deleted_at" timestamp,
                CONSTRAINT product_pk PRIMARY KEY (product_id)
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
            ALTER TABLE "public"."product" DROP CONSTRAINT IF EXISTS "product_pk";
            DROP TABLE IF EXISTS "public"."product";
        ');
    }
}
