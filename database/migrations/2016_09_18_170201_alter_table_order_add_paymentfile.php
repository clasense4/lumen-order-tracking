<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableOrderAddPaymentfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::connection()->getPdo()->exec('
            ALTER TABLE "order"
                ADD COLUMN payment_file varchar(50) COLLATE "default";
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
            ALTER TABLE "order"
                DROP COLUMN IF EXISTS payment_file;
        ');
    }
}
