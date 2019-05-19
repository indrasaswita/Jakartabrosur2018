<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinishingoptions extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
			CREATE TABLE finishingoptions(
				id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
				finishingID INT UNSIGNED NOT NULL,
				optionname VARCHAR(64) NOT NULL,
				price NUMERIC(10, 2) NOT NULL,
				priceper VARCHAR(16) NOT NULL,
				priceminim INT NOT NULL,
				pricebase INT NOT NULL,
				processdays TINYINT UNSIGNED NOT NULL DEFAULT 1,
				info VARCHAR(255), 
				created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
				updated_at TIMESTAMP NULL,
				FOREIGN KEY (finishingID) REFERENCES finishings(id) ON UPDATE CASCADE ON DELETE CASCADE
			);
		");
		//TIDAK PAKE SIDE YA
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::unprepared("DROP TABLE finishingoptions");
	}
}
