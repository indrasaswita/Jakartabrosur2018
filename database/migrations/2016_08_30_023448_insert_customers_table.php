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
                'remember_token'=>'1234',
                'balance' => 123456
            ]
        );
        
        DB::table('customers')->insert(
            [
                'companyID' => 2,
                'email' => 'windy.dharma@gmail.com',
                'password' => Hash::make('123456'),
                'name' => 'Septi Jelek Ilang Ireng Idup',
                'type' => 'personal',
                'title' => 'Mr.', 
                'address' => 'Jl. Agung Utara 5A no. 26, Sunter, Tanjung Priok', 
                'postcode' => '10430',
                'cityID' => 3,
                'phone1' => '0216555661',
                'phone2' => '0216661116',
                'news' => 0,
                'remember_token'=>'98765',
                'remember_token'=>'1234',
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
