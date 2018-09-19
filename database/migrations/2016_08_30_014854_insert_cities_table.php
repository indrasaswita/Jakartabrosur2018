<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('cities')->insert(
            [
                'name'=>'Jakarta Utara'
            ]
        );
        DB::table('cities')->insert(
            [
                'name'=>'Jakarta Barat'
            ]
        );
        DB::table('cities')->insert(
            [
                'name'=>'Jakarta Pusat'
            ]
        );
        DB::table('cities')->insert(
            [
                'name'=>'Jakarta Timur'
            ]
        );
        DB::table('cities')->insert(
            [
                'name'=>'Jakarta Selatan'
            ]
        );
        DB::table('cities')->insert(
            [
                'name'=>'Bekasi'
            ]
        );
        DB::table('cities')->insert(
            [
                'name'=>'Bogor'
            ]
        );
        DB::table('cities')->insert(
            [
                'name'=>'Tangerang'
            ]
        );
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
