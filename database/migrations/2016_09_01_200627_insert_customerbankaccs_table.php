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
        DB::table('customerbankaccs')->insert(['bankID'=>1, 'customerID'=>1, 'accno'=>'889889889889', 'accname'=>'INDRA BOY', 'acclocation'=>'KCU. Sawah Besar', 'created_at'=>now()]);
        DB::table('customerbankaccs')->insert(['bankID'=>1, 'customerID'=>1, 'accno'=>'1234789162734', 'accname'=>'INDRA BOY', 'acclocation'=>'KCU. Mangga Dua Pasar Pagi', 'created_at'=>now()]);
        DB::table('customerbankaccs')->insert(['bankID'=>2, 'customerID'=>1, 'accno'=>'1826738112', 'accname'=>'INDRA BOY', 'acclocation'=>'KCU. Juanda', 'created_at'=>now()]);
        DB::table('customerbankaccs')->insert(['bankID'=>2, 'customerID'=>2, 'accno'=>'100000567', 'accname'=>'WINDI DARMA', 'acclocation'=>'KCU. Sunter', 'created_at'=>now()]);
        DB::table('customerbankaccs')->insert(['bankID'=>5, 'customerID'=>2, 'accno'=>'09012454487', 'accname'=>'WINDY DHHARRMMAA', 'acclocation'=>'KCU. Sunter', 'created_at'=>now()]);
        DB::table('customerbankaccs')->insert(['bankID'=>4, 'customerID'=>2, 'accno'=>'567.897.123', 'accname'=>'WINDY DHARMA', 'acclocation'=>'KCU. Sunter', 'created_at'=>now()]);
        DB::table('customerbankaccs')->insert(['bankID'=>9, 'customerID'=>2, 'accno'=>'5678971230', 'accname'=>'WINDY', 'acclocation'=>'KCU. Sunter', 'created_at'=>now()]);
        DB::table('customerbankaccs')->insert(['bankID'=>9, 'customerID'=>3, 'accno'=>'5121237089', 'accname'=>'SAPI GANTENG', 'acclocation'=>'KCU. Sunter SELATAN', 'created_at'=>now()]);
        DB::table('customerbankaccs')->insert(['bankID'=>9, 'customerID'=>4, 'accno'=>'7291031122', 'accname'=>'ONYET ONYET ONYET', 'acclocation'=>'KCU. Danau Sunter Utara', 'created_at'=>now()]);
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
