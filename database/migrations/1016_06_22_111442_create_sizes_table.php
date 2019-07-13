<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSizesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
			CREATE TABLE sizes(
				id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
				name VARCHAR(32),
				shortname VARCHAR(8),
				width DECIMAL(5, 2),
				length DECIMAL(5, 2),
				created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
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
		DB::unprepared("DROP TABLE IF EXISTS sizes");
	}
}
