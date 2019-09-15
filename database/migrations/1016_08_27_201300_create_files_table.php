<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
			CREATE TABLE files(
				id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
				customerID INT UNSIGNED DEFAULT NULL,
				filename VARCHAR(100) NOT NULL,
				size NUMERIC(10,2) NOT NULL DEFAULT 0,
				detail VARCHAR(500) NOT NULL DEFAULT '',
				revision TINYINT NOT NULL DEFAULT 0,
				preview VARCHAR(128),
				path VARCHAR(128),
				icon VARCHAR(128),
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
		Schema::drop('files');
	}
}
