<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertSizes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            INSERT INTO sizes (name, width, length) VALUES ('A4', '21', '29.7');
            INSERT INTO sizes (name, width, length) VALUES ('A3', '29.7', '42');
            INSERT INTO sizes (name, width, length) VALUES ('A2', '42', '60');
            INSERT INTO sizes (name, width, length) VALUES ('A4 eco', '20.2', '28.6');
            INSERT INTO sizes (name, width, length) VALUES ('A5', '14.8', '21');
            INSERT INTO sizes (name, width, length) VALUES ('A6', '10.5', '14.8');
            INSERT INTO sizes (name, width, length) VALUES ('F4', '21.5', '33');
            INSERT INTO sizes (name, width, length) VALUES ('B2', '50', '70.7');
            INSERT INTO sizes (name, width, length) VALUES ('B3', '35.3', '50');
            INSERT INTO sizes (name, width, length) VALUES ('B4', '25', '35.3');
            INSERT INTO sizes (name, width, length) VALUES ('sepertiga A4', '10', '21');
            INSERT INTO sizes (name, width, length) VALUES ('KN (standard)', '5.5', '9');
            INSERT INTO sizes (name, width, length) VALUES ('KN (kecil)', '5', '9');
            INSERT INTO sizes (name, width, length) VALUES ('KN (eu)', '5', '8.5');
            INSERT INTO sizes (name, width, length) VALUES ('ID (standard)', '5.4', '8.4');
            INSERT INTO sizes (name, width, length) VALUES ('Banner 60', '60', '160');
            INSERT INTO sizes (name, width, length) VALUES ('Banner 80', '80', '180');
            INSERT INTO sizes (name, width, length) VALUES ('Banner 85', '85', '200');
            INSERT INTO sizes (name, width, length) VALUES ('A5 Landscape', '20.5', '14.5');
            INSERT INTO sizes (name, width, length) VALUES ('A5 Portrait', '14.5', '20.5');
            INSERT INTO sizes (name, width, length) VALUES ('Square', '20', '20');
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
