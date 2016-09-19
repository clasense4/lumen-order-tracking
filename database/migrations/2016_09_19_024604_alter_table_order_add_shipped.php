<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableOrderAddShipped extends Migration
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
                ADD COLUMN shipped char(1) COLLATE "default";
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
                DROP COLUMN IF EXISTS shipped;
        ');
    }
}
