<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsubtypepapersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
			CREATE TABLE jobsubtypepapers(
				id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
				jobsubtypeID INT UNSIGNED NOT NULL,
				ofdg TINYINT UNSIGNED NOT NULL,
				paperID INT UNSIGNED NOT NULL,
				favourite TINYINT UNSIGNED NOT NULL,
				created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
				updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
				FOREIGN KEY (jobsubtypeID) REFERENCES jobsubtypes(id)
			);
		");
	}

	/**
	 * Reverse tphe migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::unprepared("DROP TABLE IF EXISTS jobsubtypepapers");
	}
}
