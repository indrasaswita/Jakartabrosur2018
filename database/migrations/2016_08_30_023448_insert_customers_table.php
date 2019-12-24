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
				'phone1' => '081315519889',
				'phone2' => '085959717175',
				'news' => 1,
				'remember_token'=>'1234575',
				'verify_token'=>'1234',
				'balance' => 123456,
				'verified' => 1,
				'created_at' => now()
			]
		);
		
		DB::table('customers')->insert(
			[
				'companyID' => 2,
				'email' => 'windy.dharma@gmail.com',
				'password' => Hash::make('123456'),
				'name' => 'Septiana Rahayu Dewi',
				'type' => 'personal',
				'title' => 'Mr.', 
				'phone1' => '0216555661',
				'phone2' => '0216661116',
				'news' => 0,
				'remember_token'=>'9876556',
				'verify_token'=>'1234',
				'balance' => 0,
				'verified' => 1,
				'created_at' => now()
			]
		);
		
		DB::table('customers')->insert(
			[
				'companyID' => null,
				'email' => 'sapiii@gmail.com',
				'password' => Hash::make('123456'),
				'name' => 'Septi Sapi',
				'type' => 'personal',
				'title' => 'Mr.', 
				'phone1' => '0216555661',
				'phone2' => '0216661116',
				'news' => 0,
				'remember_token'=>'9876512',
				'verify_token'=>'1234',
				'balance' => 200000,
				'created_at' => now()
			]
		);
		
		DB::table('customers')->insert(
			[
				'companyID' => null,
				'email' => 'anakonyet@gmail.com',
				'password' => Hash::make('123456'),
				'name' => 'ANak Onyet',
				'type' => 'personal',
				'title' => 'Mrs.', 
				'phone1' => '0216555661',
				'phone2' => '0216661116',
				'news' => 1,
				'remember_token'=>'9876574',
				'verify_token'=>'1234',
				'balance' => 100000,
				'created_at' => now()
			]
		);
		
		DB::table('customers')->insert(
			[
				'companyID' => null,
				'email' => 'endut@gmail.com',
				'password' => Hash::make('123456'),
				'name' => 'Endut Banget',
				'type' => 'personal',
				'title' => 'Mr.', 
				'phone1' => '0216555661',
				'phone2' => '0216661116',
				'news' => 1,
				'remember_token'=>'9876515',
				'verify_token'=>'1234',
				'balance' => 150000,
				'created_at' => now()
			]
		);
		
		DB::table('customers')->insert(
			[
				'companyID' => null,
				'email' => 'kurus@gmail.com',
				'password' => Hash::make('123456'),
				'name' => 'Kurus Banget',
				'type' => 'personal',
				'title' => 'Mrs.', 
				'phone1' => '0216555661',
				'phone2' => '0216661116',
				'news' => 0,
				'remember_token'=>'9876274',
				'verify_token'=>'1234',
				'balance' => 180000,
				'created_at' => now()
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
