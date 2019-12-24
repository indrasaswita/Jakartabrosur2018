<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class InsertSalesheadersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::table('salesheaders')->insert([
			"customerID" => 1,
			"name" => 'Potong Septi',
			"tempo" => Carbon::now(),
			'created_at' => Carbon::now(),
			'updated_at' => null
		]);
		DB::table('salesheaders')->insert([
			"customerID" => 2,
			"name" => 'Potong Kambing',
			"tempo" => Carbon::now(),
			'created_at' => Carbon::now(),
			'updated_at' => null
		]);
		
		DB::unprepared("
			INSERT INTO salesheaders(customerID, name, tempo, estdate, created_at, updated_at, deleted_at) VALUES 
				(1, 'Flyer bekas', null, '2018-06-22 12:00:00', '2018-06-20 12:00:23', null, null), 
				(2, 'Sapphire Moonlight', null, '2018-06-23 12:00:00', '2018-06-21 17:05:00', null, null), 
				(3, 'It feel like oh-la-la..', null, '2018-06-24 12:00:00', '2018-06-21 16:00:09', null, null), 
				(4, 'Tequila Sunrise', null, '2018-06-25 12:00:00', '2018-06-22 18:23:24', null, null), 
				(5, 'Hello World 102', null, '2018-07-02 10:00:00', '2018-07-01 3:02:04', null, null), 
				(6, 'Hello World', null, '2018-08-01 10:00:00', '2018-07-01 7:23:00', null, null);
		");
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
