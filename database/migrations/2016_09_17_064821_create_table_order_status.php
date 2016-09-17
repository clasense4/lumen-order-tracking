<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOrderStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::connection()->getPdo()->exec('
            CREATE TABLE IF NOT EXISTS "public"."order_status" (
                "order_status_id" varchar(38) NOT NULL COLLATE "default",
                "order_id" varchar(38) NOT NULL COLLATE "default",
                "status" varchar(50) NOT NULL COLLATE "default",
                "description" text NULL COLLATE "default",
                "created_at" timestamp,
                "updated_at" timestamp,
                "deleted_at" timestamp,
                CONSTRAINT order_status_pk PRIMARY KEY (order_status_id)
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
            ALTER TABLE "public"."order_status" DROP CONSTRAINT IF EXISTS "order_status_pk";
            DROP TABLE IF EXISTS "public"."order_status";
        ');
    }
}
