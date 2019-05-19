<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertConstantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('constants')->insert(['name'=>'BiayaPotongPerKg', 'price'=>'800']);
        DB::table('constants')->insert(['name'=>'BiayaPlatSM52', 'price'=>'20000']);
        DB::table('constants')->insert(['name'=>'BiayaPlatSM74', 'price'=>'100000']);
        DB::table('constants')->insert(['name'=>'BiayaPlatSM102', 'price'=>'150000']);
        DB::table('constants')->insert(['name'=>'BiayaPlatSM105', 'price'=>'175000']);
        DB::table('constants')->insert(['name'=>'InschietSM52', 'price'=>'75']);
        DB::table('constants')->insert(['name'=>'InschietSM74', 'price'=>'100']);
        DB::table('constants')->insert(['name'=>'InschietSM102', 'price'=>'125']);
        DB::table('constants')->insert(['name'=>'InschietSM105', 'price'=>'125']);
        DB::table('constants')->insert(['name'=>'InschietLaminating', 'price'=>'25']);
        DB::table('constants')->insert(['name'=>'InschietPond', 'price'=>'100']);
        DB::table('constants')->insert(['name'=>'InschietVarnish', 'price'=>'25']);
        DB::table('constants')->insert(['name'=>'InschietLipat', 'price'=>'100']);
        DB::table('constants')->insert(['name'=>'InschietRel', 'price'=>'50']);
        DB::table('constants')->insert(['name'=>'InschietNumerator', 'price'=>'50']);
        DB::table('constants')->insert(['name'=>'OngkosCetakSisaSM52', 'price'=>'20']);
        DB::table('constants')->insert(['name'=>'OngkosCetakSisaSM74', 'price'=>'30']);
        DB::table('constants')->insert(['name'=>'OngkosCetakSisaSM102', 'price'=>'45']);
        DB::table('constants')->insert(['name'=>'OngkosCetakSisaSM105', 'price'=>'50']);
        DB::table('constants')->insert(['name'=>'OngkosMinimPotong', 'price'=>'50000']);
        DB::table('constants')->insert(['name'=>'OngkosMinimLipat', 'price'=>'150000']);
        DB::table('constants')->insert(['name'=>'OngkosMinimPond', 'price'=>'150000']);
        DB::table('constants')->insert(['name'=>'OngkosMinimLaminating', 'price'=>'200000']);
        DB::table('constants')->insert(['name'=>'OngkosCetakMinimSM52', 'price'=>'60000']);
        DB::table('constants')->insert(['name'=>'OngkosCetakMinimSM74', 'price'=>'90000']);
        DB::table('constants')->insert(['name'=>'OngkosCetakMinimSM102', 'price'=>'130000']);
        DB::table('constants')->insert(['name'=>'OngkosCetakMinimSM105', 'price'=>'160000']);
        DB::table('constants')->insert(['name'=>'LaminatingDoffPerCm', 'price'=>'0.22']);
        DB::table('constants')->insert(['name'=>'LaminatingGlossPerCm', 'price'=>'0.2']);
        DB::table('constants')->insert(['name'=>'SpotUVPerCm', 'price'=>'0.4']);
        DB::table('constants')->insert(['name'=>'UVVarnishPerCm', 'price'=>'0.15']);
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
