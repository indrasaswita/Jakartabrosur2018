<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomeronesignalsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
			CREATE TABLE customeronesignals(
				id INT PRIMARY KEY AUTO_INCREMENT,
				onesignalID INT UNSIGNED NOT NULL,
				customerID INT UNSIGNED NOT NULL,
				count INT UNSIGNED DEFAULT 0,
				app_token VARCHAR(64) NULL,
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
		Schema::dropIfExists('customeronesignals');
	}
}
