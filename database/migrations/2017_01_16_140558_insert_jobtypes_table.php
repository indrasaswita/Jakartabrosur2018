<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertJobtypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            INSERT INTO jobtypes (name, shortname) VALUES ('Ad and Promotion', 'Promosi');
            INSERT INTO jobtypes (name, shortname) VALUES ('Business Stationery', 'Kantor');
            INSERT INTO jobtypes (name, shortname) VALUES ('Souvenir', 'Suvenir');
            INSERT INTO jobtypes (name, shortname) VALUES ('Restaurant Needs', 'Resto');
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
