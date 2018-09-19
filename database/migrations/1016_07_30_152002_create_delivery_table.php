<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
			CREATE TABLE deliveries(
				id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
				deliverytype VARCHAR(16) NOT NULL,
				deliveryname VARCHAR(16) NOT NULL,
				baseprice INT UNSIGNED NOT NULL,
				price INT UNSIGNED NOT NULL,
				priceper VARCHAR(16) NOT NULL,
				dayservice INT UNSIGNED NOT NULL,
				note VARCHAR(255) NOT NULL,
				locked TINYINT UNSIGNED NOT NULL,
				created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
				updated_at TIMESTAMP NULL DEFAULT NULL
			);
		");
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::unprepared("DROP TABLE deliveries");
	}
}
