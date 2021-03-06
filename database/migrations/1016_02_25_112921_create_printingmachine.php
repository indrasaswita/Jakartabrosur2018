<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrintingmachine extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TABLE printingmachines(
                id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
                machinename VARCHAR(32) NOT NULL,
                maxwidth SMALLINT DEFAULT 0,
                maxlength SMALLINT DEFAULT 0,
                created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP NULL
            );
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP TABLE printingmachines");
    }
}
