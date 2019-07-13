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
            'name' => 'Septiana Acting Employee',
            'email' => 'windy.dharma2@gmail.com',
            'password' => Hash::make('123456'),
            'roleID' => 1, 
            'created_at' => now()]);
        DB::table('employees')->insert([
            'name' => 'Indra Employee',
            'email' => 'employee@test.com',
            'password' => Hash::make('password'),
            'roleID' => 1
            ,'created_at' => now()]);
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
