<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('employees')->insert([
            'name' => 'Septiana Dodol Item Idup',
            'email' => 'windy.dharma2@gmail.com',
            'password' => Hash::make('123456'),
            'roleID' => 1
        ]);
        DB::table('employees')->insert([
            'name' => 'Indra Employee',
            'email' => 'employee@test.com',
            'password' => Hash::make('employee'),
            'roleID' => 1
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
