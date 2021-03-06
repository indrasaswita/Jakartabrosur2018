<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertPrintingmachine extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            INSERT INTO printingmachines(machinename, maxwidth, maxlength) VALUES('SM52', '52', '37');
            INSERT INTO printingmachines(machinename) VALUES('SM74');
            INSERT INTO printingmachines(machinename) VALUES('SM102');
            INSERT INTO printingmachines(machinename) VALUES('SM92');
            INSERT INTO printingmachines(machinename) VALUES('DigitalA3');
            INSERT INTO printingmachines(machinename) VALUES('DigitalA2');
            INSERT INTO printingmachines(machinename) VALUES('DigitalB2');
            INSERT INTO printingmachines(machinename) VALUES('Indoor5PL');
            INSERT INTO printingmachines(machinename) VALUES('Outdoor35PL');
            INSERT INTO printingmachines(machinename) VALUES('DigitalCuttingSticker');
            INSERT INTO printingmachines(machinename) VALUES('A3CuttingSticker');
            INSERT INTO printingmachines(machinename) VALUES('UV Flatbed');
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
