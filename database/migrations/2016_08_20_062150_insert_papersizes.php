<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertPapersizes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            INSERT INTO papersizes VALUES ('1', '61', '86');
            INSERT INTO papersizes VALUES ('2', '61', '88');
            INSERT INTO papersizes VALUES ('3', '61', '92');
            INSERT INTO papersizes VALUES ('4', '65', '90');
            INSERT INTO papersizes VALUES ('5', '65', '100');
            INSERT INTO papersizes VALUES ('6', '79', '109');
            INSERT INTO papersizes VALUES ('7', '70', '100');
            INSERT INTO papersizes VALUES ('8', '90', '120');
            INSERT INTO papersizes VALUES ('9', '66', '101.6');
            INSERT INTO papersizes VALUES ('10', '70', '108');
            INSERT INTO papersizes VALUES ('11', '86', '106');
            INSERT INTO papersizes VALUES ('12', '53', '86');
            INSERT INTO papersizes VALUES ('13', '21', '29.7');
            INSERT INTO papersizes VALUES ('14', '21.5', '33');
            INSERT INTO papersizes VALUES ('15', '33', '43');
            INSERT INTO papersizes VALUES ('16', '73', '103');
            INSERT INTO papersizes VALUES ('17', '32', '48');
            INSERT INTO papersizes VALUES ('18', '33', '48');
            INSERT INTO papersizes VALUES ('19', '127', '5500');
            INSERT INTO papersizes VALUES ('20', '90', '5500');
            INSERT INTO papersizes VALUES ('21', '152', '5500');
            INSERT INTO papersizes VALUES ('22', '106', '5500');
            INSERT INTO papersizes VALUES ('23', '110', '5000');
            INSERT INTO papersizes VALUES ('24', '220', '5000');
            INSERT INTO papersizes VALUES ('25', '260', '5000');
            INSERT INTO papersizes VALUES ('26', '320', '5000');
            INSERT INTO papersizes VALUES ('27', '160', '5000');
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
