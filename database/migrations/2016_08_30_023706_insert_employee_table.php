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
            'name' => 'Septiana Employee',
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
        DB::table('employees')->insert([
            'name' => 'Beni Irawan',
            'email' => '',
            'password' => '',
            'roleID' => 3
            ,'created_at' => now()]);
        DB::table('employees')->insert([
            'name' => 'Diki',
            'email' => '',
            'password' => '',
            'roleID' => 3
            ,'created_at' => now()]);
        DB::table('employees')->insert([
            'name' => 'Darmono',
            'email' => '',
            'password' => '',
            'roleID' => 3
            ,'created_at' => now()]);
        DB::table('employees')->insert([
            'name' => 'Ardiansyah',
            'email' => '',
            'password' => '',
            'roleID' => 3
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
