<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesheadersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		DB::unprepared("
			CREATE TABLE salesheaders(
				id INT PRIMARY KEY AUTO_INCREMENT,
				customerID INT UNSIGNED NOT NULL,
				name VARCHAR(255) NOT NULL,
				tempo DATE NULL,
				estdate DATE NULL,
				created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
				updated_at TIMESTAMP NULL,
				deleted_at TIMESTAMP NULL
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
		Schema::drop('salesheaders');
	}
}
