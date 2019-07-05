<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanybankaccsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		DB::unprepared("
			CREATE TABLE companybankaccs(
				id INT PRIMARY KEY AUTO_INCREMENT,
				bankID INT UNSIGNED NOT NULl,
				accname VARCHAR(32) NOT NULL,
				accno VARCHAR(32) NOT NULL,
				acclocation VARCHAR(32) NOT NULL DEFAULT '',
				userlogin VARCHAR(16) NULL,
				passlogin VARCHAR(32) NULL,
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
		Schema::drop('companybankaccs');
	}
}
