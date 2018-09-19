<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePapersizes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TABLE papersizes(
                id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
                width NUMERIC(7,2) UNSIGNED,
                length NUMERIC(10,2) UNSIGNED
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
        DB::unprepared("DROP TABLE papersizes");
    }
}
