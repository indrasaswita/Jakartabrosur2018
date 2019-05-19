<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertOffdaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            INSERT INTO offdays VALUES('0', '1', '2017-10-30', '9:00', '10:00', 'mau bobok', '0', now(), now());
            INSERT INTO offdays VALUES('0', '1', '2017-10-31', '9:00', '18:00', 'mau bobok', '1', now(), now());
            INSERT INTO offdays VALUES('0', '1', '2017-11-1', '9:00', '18:00', 'bobok ciang', '2', now(), now());
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
