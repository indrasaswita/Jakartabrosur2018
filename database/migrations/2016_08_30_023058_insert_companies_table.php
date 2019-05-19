<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('companies')->insert(
            [
                'nickname' => 'None',
                'name' => 'No Company',
                'address' => '--',
                'cityID' => 1,
                'phone1' => '--',
                'type' => '--'
            ]
        );
        DB::table('companies')->insert(
            [
                'nickname' => 'WakeCup',
                'name' => 'PT. Wake Cup Indonesia',
                'address' => 'Jl. Jelambar 5 No. 13-14',
                'cityID' => 1,
                'phone1' => '02162371123',
                'phone2' => '02167182711',
                'type' => 'office'
            ]
        );
        DB::table('companies')->insert(
            [
                'nickname' => 'Rahayu',
                'name' => 'CV. Rahayu',
                'address' => 'Jl. Pangeran Jayakarta 113, Sebelah Pom BENSIN',
                'cityID' => 3,
                'phone1' => '0216495848',
                'phone2' => '0216392676',
                'type' => 'office'
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
