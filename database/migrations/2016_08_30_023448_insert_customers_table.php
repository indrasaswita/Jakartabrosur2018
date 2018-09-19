<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('customers')->insert(
            [
                'companyID' => 1,
                'email' => 'indrasaswita@gmail.com',
                'password' => Hash::make('indra'),
                'name' => 'Indra Saswita',
                'type' => 'personal',
                'title' => 'Mr.', 
                'address' => 'Jl. Pangeran Jayakarta 113 A', 
                'postcode' => '10730',
                'cityID' => 1,
                'phone1' => '081315519889',
                'phone2' => '085959717175',
                'news' => 1,
                'remember_token'=>'12345',
                'balance' => 123456
            ]
        );
        
        DB::table('customers')->insert(
            [
                'companyID' => 2,
                'email' => 'rudipriyanto@gmail.com',
                'password' => Hash::make('rucil'),
                'name' => 'Rudi Priyanto',
                'type' => 'personal',
                'title' => 'Mr.', 
                'address' => 'Jl. Pangeran Jayakarta 113 B', 
                'postcode' => '10730',
                'cityID' => 2,
                'phone1' => '0216491502',
                'phone2' => '0216491502',
                'news' => 0,
                'balance' => 0
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
