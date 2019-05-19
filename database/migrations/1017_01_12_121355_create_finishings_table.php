<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinishingsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
			CREATE TABLE finishings(
				id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
				name VARCHAR(32) NOT NULL,
				shortname VARCHAR(32) NOT NULL,
				ofdg TINYINT NOT NULL COMMENT '1: offset, 2: digital, 3: plotter, 4: pvc, 5: lain-lain',
				info VARCHAR(512) NOT NULL,
				status TINYINT NOT NULL,
				mingram INT NOT NULL,
				maxgram INT NOT NULL,
				created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
				updated_at TIMESTAMP NULL DEFAULT NULL
			);
		");

		//GA DI MASUKIN SIDE KE DALAM SINI, soalnya dipisahin sidenya dari optionnya.
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::unprepared("DROP TABLE IF EXISTS finishings");
	}
}
