<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertSalesdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('salesdetails')->insert([
            'salesID'=>'1',
            'cartID'=>'1',
            'statusfile'=>1,
            'commited'=>0,
            'statusctp'=>1,
            'statusprint'=>0,
            'statuspacking'=>0,
            'statusdelivery'=>0,
            'statusdone'=>0,
            'created_at'=>now()
        ]);
        DB::table('salesdetails')->insert([
            'salesID'=>'2',
            'cartID'=>'2',
            'statusfile'=>1,
            'commited'=>1,
            'statusctp'=>1,
            'statusprint'=>1,
            'statuspacking'=>0,
            'statusdelivery'=>0,
            'statusdone'=>0,
            'created_at'=>now()
        ]);
        /*DB::table('salesdetails')->insert([
            'salesID'=>'2',
            'cartID'=>'4',
            'statusfile'=>1,
            'commited'=>1,
            'statusctp'=>1,
            'statusprint'=>1,
            'statuspacking'=>1,
            'statusdelivery'=>0,
            'statusdone'=>0
        ]);
        DB::table('salesdetails')->insert([
            'salesID'=>'2',
            'cartID'=>'5',
            'statusfile'=>0,
            'commited'=>1,
            'statusctp'=>0,
            'statusprint'=>0,
            'statuspacking'=>0,
            'statusdelivery'=>0,
            'statusdone'=>0
        ]);
        DB::table('salesdetails')->insert([
            'salesID'=>'3',
            'cartID'=>'3',
            'statusfile'=>0,
            'commited'=>1,
            'statusctp'=>0,
            'statusprint'=>0,
            'statuspacking'=>0,
            'statusdelivery'=>0,
            'statusdone'=>0
        ]);*/
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
