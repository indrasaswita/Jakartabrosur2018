<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsubtypesizesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
			CREATE TABLE jobsubtypesizes(
				id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
				jobsubtypeID INT UNSIGNED NOT NULL,
				ofdg TINYINT UNSIGNED NOT NULL,
				sizeID INT UNSIGNED NOT NULL,
				favourite TINYINT NOT NULL,
				created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
				updated_at TIMESTAMP NULL
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
		DB::unprepared("DROP TABLE IF EXISTS jobsubtypesizes");
	}
}
