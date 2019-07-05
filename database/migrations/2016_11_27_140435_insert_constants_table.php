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
        DB::table('constants')->insert(['name'=>'BiayaPotongPerKg', 'price'=>'800', 'created_at'=>now()]);
        DB::table('constants')->insert(['name'=>'BiayaPlatSM52', 'price'=>'25000', 'created_at'=>now()]);
        DB::table('constants')->insert(['name'=>'BiayaPlatSM74', 'price'=>'125000', 'created_at'=>now()]);
        DB::table('constants')->insert(['name'=>'BiayaPlatSM102', 'price'=>'175000', 'created_at'=>now()]);
        DB::table('constants')->insert(['name'=>'BiayaPlatSM105', 'price'=>'175000', 'created_at'=>now()]);
        DB::table('constants')->insert(['name'=>'InschietSM52', 'price'=>'150', 'created_at'=>now()]);
        DB::table('constants')->insert(['name'=>'InschietSM74', 'price'=>'200', 'created_at'=>now()]);
        DB::table('constants')->insert(['name'=>'InschietSM102', 'price'=>'300', 'created_at'=>now()]);
        DB::table('constants')->insert(['name'=>'InschietSM105', 'price'=>'300', 'created_at'=>now()]);
        DB::table('constants')->insert(['name'=>'InschietLaminating', 'price'=>'25', 'created_at'=>now()]);
        DB::table('constants')->insert(['name'=>'InschietPond', 'price'=>'100', 'created_at'=>now()]);
        DB::table('constants')->insert(['name'=>'InschietVarnish', 'price'=>'25', 'created_at'=>now()]);
        DB::table('constants')->insert(['name'=>'InschietLipat', 'price'=>'100', 'created_at'=>now()]);
        DB::table('constants')->insert(['name'=>'InschietRel', 'price'=>'50', 'created_at'=>now()]);
        DB::table('constants')->insert(['name'=>'InschietNumerator', 'price'=>'50', 'created_at'=>now()]);
        DB::table('constants')->insert(['name'=>'OngkosCetakSisaSM52', 'price'=>'22', 'created_at'=>now()]);
        DB::table('constants')->insert(['name'=>'OngkosCetakSisaSM74', 'price'=>'30', 'created_at'=>now()]);
        DB::table('constants')->insert(['name'=>'OngkosCetakSisaSM102', 'price'=>'45', 'created_at'=>now()]);
        DB::table('constants')->insert(['name'=>'OngkosCetakSisaSM105', 'price'=>'50', 'created_at'=>now()]);
        DB::table('constants')->insert(['name'=>'OngkosMinimPotong', 'price'=>'50000', 'created_at'=>now()]);
        DB::table('constants')->insert(['name'=>'OngkosMinimLipat', 'price'=>'150000', 'created_at'=>now()]);
        DB::table('constants')->insert(['name'=>'OngkosMinimPond', 'price'=>'150000', 'created_at'=>now()]);
        DB::table('constants')->insert(['name'=>'OngkosMinimLaminating', 'price'=>'200000', 'created_at'=>now()]);
        DB::table('constants')->insert(['name'=>'OngkosCetakMinimSM52', 'price'=>'80000', 'created_at'=>now()]);
        DB::table('constants')->insert(['name'=>'OngkosCetakMinimSM74', 'price'=>'150000', 'created_at'=>now()]);
        DB::table('constants')->insert(['name'=>'OngkosCetakMinimSM102', 'price'=>'400000', 'created_at'=>now()]);
        DB::table('constants')->insert(['name'=>'OngkosCetakMinimSM105', 'price'=>'410000', 'created_at'=>now()]);
        DB::table('constants')->insert(['name'=>'LaminatingDoffPerCm', 'price'=>'0.22', 'created_at'=>now()]);
        DB::table('constants')->insert(['name'=>'LaminatingGlossPerCm', 'price'=>'0.2', 'created_at'=>now()]);
        DB::table('constants')->insert(['name'=>'SpotUVPerCm', 'price'=>'0.4', 'created_at'=>now()]);
        DB::table('constants')->insert(['name'=>'UVVarnishPerCm', 'price'=>'0.15', 'created_at'=>now()]);
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
