<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertCompanybankaccountdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            INSERT INTO companybankaccmutations VALUES ('0', '1', '2018-10-03', 'REF TRSF 1029 ALDI SPANDUK ALBATROS AA', '120000', '0', now(), now());
            INSERT INTO companybankaccmutations VALUES ('0', '1', '2018-10-04', 'CR TRSF bayar flyer hahahehe', '1300000', '0', now(), now());
            INSERT INTO companybankaccmutations VALUES ('0', '1', '2018-10-04', 'TRANSFER dr septi kampret', '1450000', '0', now(), now());
            INSERT INTO companybankaccmutations VALUES ('0', '1', '2018-10-05', 'REF TRSF 1029 SPANDUK OUTDOOR 2 PCS', '9750000', '0', now(), now());
            INSERT INTO companybankaccmutations VALUES ('0', '1', '2018-10-06', 'CR TRSF LUNAS', '88800000', '1', now(), now());
            INSERT INTO companybankaccmutations VALUES ('0', '1', '2018-10-07', 'TRANSFER; RAHAYU PRINTING', '1000000', '1', now(), now());
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
