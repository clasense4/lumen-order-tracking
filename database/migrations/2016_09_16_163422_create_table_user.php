<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::connection()->getPdo()->exec('
            CREATE TABLE IF NOT EXISTS "public"."user" (
                "user_id" varchar(38) NOT NULL COLLATE "default",
                "user_type" varchar(3) NOT NULL COLLATE "default",
                "name" varchar(75) NOT NULL COLLATE "default",
                "username" varchar(50) NOT NULL COLLATE "default",
                "email" varchar(50) NOT NULL COLLATE "default",
                "password" varchar(150) NOT NULL COLLATE "default",
                "phone_number" varchar(20) NOT NULL COLLATE "default",
                "address" text NULL COLLATE "default",
                "created_at" timestamp,
                "updated_at" timestamp,
                "deleted_at" timestamp,
                CONSTRAINT user_pk PRIMARY KEY (user_id)
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
            ALTER TABLE "public"."user" DROP CONSTRAINT IF EXISTS "user_pk";
            DROP TABLE IF EXISTS "public"."user";
        ');
    }
}
