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
        DB::table('salesdetails')->insert([
            'salesID'=>'6',
            'cartID'=>'4',
            'statusfile'=>0,
            'commited'=>1,
            'statusctp'=>1,
            'statusprint'=>1,
            'statuspacking'=>1,
            'statusdelivery'=>0,
            'statusdone'=>0,
            'created_at'=>now()
        ]);
        DB::table('salesdetails')->insert([
            'salesID'=>'4',
            'cartID'=>'5',
            'statusfile'=>1,
            'commited'=>1,
            'statusctp'=>0,
            'statusprint'=>0,
            'statuspacking'=>0,
            'statusdelivery'=>0,
            'statusdone'=>0,
            'created_at'=>now()
        ]);
        DB::table('salesdetails')->insert([
            'salesID'=>'5',
            'cartID'=>'9',
            'statusfile'=>1,
            'commited'=>1,
            'statusctp'=>1,
            'statusprint'=>1,
            'statuspacking'=>1,
            'statusdelivery'=>1,
            'statusdone'=>1,
            'created_at'=>now()
        ]);
        DB::table('salesdetails')->insert([
            'salesID'=>'3',
            'cartID'=>'7',
            'statusfile'=>1,
            'commited'=>1,
            'statusctp'=>1,
            'statusprint'=>1,
            'statuspacking'=>1,
            'statusdelivery'=>1,
            'statusdone'=>1,
            'created_at'=>now()
        ]);
        DB::table('salesdetails')->insert([
            'salesID'=>'3',
            'cartID'=>'8',
            'statusfile'=>1,
            'commited'=>1,
            'statusctp'=>1,
            'statusprint'=>1,
            'statuspacking'=>1,
            'statusdelivery'=>1,
            'statusdone'=>1,
            'created_at'=>now()
        ]);
        DB::table('salesdetails')->insert([
            'salesID'=>'7',
            'cartID'=>'12',
            'statusfile'=>1,
            'commited'=>1,
            'statusctp'=>1,
            'statusprint'=>1,
            'statuspacking'=>1,
            'statusdelivery'=>1,
            'statusdone'=>1,
            'created_at'=>now()
        ]);
        DB::table('salesdetails')->insert([
            'salesID'=>'8',
            'cartID'=>'11',
            'statusfile'=>1,
            'commited'=>1,
            'statusctp'=>1,
            'statusprint'=>1,
            'statuspacking'=>1,
            'statusdelivery'=>1,
            'statusdone'=>1,
            'created_at'=>now()
        ]);
        DB::table('salesdetails')->insert([
            'salesID'=>'8',
            'cartID'=>'13',
            'statusfile'=>1,
            'commited'=>1,
            'statusctp'=>1,
            'statusprint'=>1,
            'statuspacking'=>1,
            'statusdelivery'=>1,
            'statusdone'=>1,
            'created_at'=>now()
        ]);
        DB::table('salesdetails')->insert([
            'salesID'=>'9',
            'cartID'=>'16',
            'statusfile'=>1,
            'commited'=>1,
            'statusctp'=>1,
            'statusprint'=>1,
            'statuspacking'=>1,
            'statusdelivery'=>1,
            'statusdone'=>1,
            'created_at'=>now()
        ]);
        DB::table('salesdetails')->insert([
            'salesID'=>'9',
            'cartID'=>'15',
            'statusfile'=>1,
            'commited'=>1,
            'statusctp'=>1,
            'statusprint'=>1,
            'statuspacking'=>1,
            'statusdelivery'=>1,
            'statusdone'=>1,
            'created_at'=>now()
        ]);
        DB::table('salesdetails')->insert([
            'salesID'=>'9',
            'cartID'=>'14',
            'statusfile'=>1,
            'commited'=>1,
            'statusctp'=>1,
            'statusprint'=>1,
            'statuspacking'=>1,
            'statusdelivery'=>1,
            'statusdone'=>1,
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
