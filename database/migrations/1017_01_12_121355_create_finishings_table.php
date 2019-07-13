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
				info VARCHAR(512) NOT NULL,
				status TINYINT NOT NULL,
				mingram INT NOT NULL DEFAULT 0,
				maxgram INT NOT NULL DEFAULT 0,
				/*inschiet dihitung untuk total druct*/
				onesideinschietOF INT NOT NULL DEFAULT 0,
				twosideinschietOF INT NOT NULL DEFAULT 0,
				onesideinschietDG INT NOT NULL DEFAULT 0,
				twosideinschietDG INT NOT NULL DEFAULT 0,
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
