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
				(6, 'Acara 17 agustus', null, '2020-01-05 10:00:00', '2019-08-15 7:23:00', null, null), 
				(7, 'Acara Tahun Baru 2020', null, '2020-01-07 10:00:00', '2020-07-22 7:23:00', null, null), 
				(8, 'Acara Kampus Tahun Lalu', null, '2018-08-01 10:00:00', '2018-07-01 7:23:00', null, null), 
				(9, 'Acara Tahun Lama 2018', null, '2018-08-01 10:00:00', '2018-07-01 7:23:00', null, null),
				(10, 'Spongebob 1', null, '2020-01-06 10:00:00', '2019-08-15 7:23:00', null, null), 
				(11, 'Spongebob 2', null, '2020-01-07 10:00:00', '2020-07-22 7:23:00', null, null), 
				(12, 'Spongebob 3', null, '2018-01-08 10:00:00', '2018-07-01 7:23:00', null, null), 
				(13, 'Spongebob ep. 17', null, '2018-01-09 10:00:00', '2018-07-01 7:23:00', null, null),
				(14, 'Acara 17 agustus', null, '2020-01-10 10:00:00', '2019-08-15 7:23:00', null, null), 
				(15, 'Spongebob ep. 1', null, '2020-01-11 10:00:00', '2020-07-22 7:23:00', null, null), 
				(16, 'Mr.Krab Ep 1', null, '2018-08-12 10:00:00', '2018-07-01 7:23:00', null, null), 
				(17, 'Spongebob ep. 215', null, '2018-08-13 10:00:00', '2018-07-01 7:23:00', null, null),
				(18, 'Acara 17 agustus 1944', null, '2020-01-14 10:00:00', '2019-08-15 7:23:00', null, null), 
				(19, 'hello Tron 456456', null, '2020-01-15 10:00:00', '2020-07-22 7:23:00', null, null), 
				(20, 'Krabby Patty Ep 2', null, '2018-08-16 10:00:00', '2018-07-01 7:23:00', null, null), 
				(21, 'Patron ep. 12345', null, '2018-08-17 10:00:00', '2018-07-01 7:23:00', null, null),
				(22, 'Acara sunatan', null, '2020-01-14 10:00:00', '2019-08-15 7:23:00', null, null), 
				(23, 'Halo dunia 456456', null, '2020-01-15 10:00:00', '2020-07-22 7:23:00', null, null), 
				(24, 'Mr.Krab Ep 3', null, '2018-08-16 10:00:00', '2018-07-01 7:23:00', null, null), 
				(25, 'Spongetron ep. 12345', null, '2018-08-17 10:00:00', '2018-07-01 7:23:00', null, null);
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
