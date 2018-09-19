<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertCustomerbankaccsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('customerbankaccs')->insert(['bankID'=>1, 'customerID'=>1, 'accno'=>'889889889889', 'accname'=>'SIGAN', 'acclocation'=>'AKHIRAT']);
        DB::table('customerbankaccs')->insert(['bankID'=>1, 'customerID'=>1, 'accno'=>'1234789162734', 'accname'=>'WAHALUALAM', 'acclocation'=>'HELL']);
        DB::table('customerbankaccs')->insert(['bankID'=>2, 'customerID'=>1, 'accno'=>'1826738112', 'accname'=>'WAHALUALAM', 'acclocation'=>'HEAVEN']);
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
