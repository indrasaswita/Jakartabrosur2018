<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrintingdigitalprice extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
			CREATE TABLE printingdigitalprices(
				id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
				machineID INT UNSIGNED NOT NULL,
				minqty INT UNSIGNED NOT NULL,
				unitprice INT UNSIGNED NOT NULL,
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
		DB::unprepared("DROP TABLE printingdigitalprices");
	}
}
