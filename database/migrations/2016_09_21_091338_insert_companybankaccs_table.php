<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertCompanybankaccsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('companybankaccs')->insert([
            'accno'=>'1949969868',
            'bankID'=>9,
            'acclocation'=>'Pangeran Jayakarta',
            'userlogin'=>'indrasas0920',
            'passlogin'=>'029092',
            'accname'=>'INDRA SASWITA',
            'created_at'=>now()
        ]);
        DB::table('companybankaccs')->insert([
            'accno'=>'9000014120381',
            'bankID'=>4,
            'acclocation'=>'Pangeran Jayakarta',
            'userlogin'=>'',
            'passlogin'=>'029092',
            'accname'=>'INDRA SASWITA',
            'created_at'=>now()
        ]);
        DB::table('companybankaccs')->insert([
            'accno'=>'NO ACC',
            'bankID'=>2,
            'acclocation'=>'Pangeran Jayakarta',
            'userlogin'=>'',
            'passlogin'=>'',
            'accname'=>'INDRA SASWITA',
            'created_at'=>now()
        ]);
        DB::table('companybankaccs')->insert([
            'accno'=>'NO ACC',
            'bankID'=>5,
            'acclocation'=>'Pangeran Jayakarta',
            'userlogin'=>'',
            'passlogin'=>'',
            'accname'=>'INDRA SASWITA',
            'created_at'=>now()
        ]);
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
