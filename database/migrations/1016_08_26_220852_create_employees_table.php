<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
			CREATE TABLE employees(
				id INT PRIMARY KEY AUTO_INCREMENT,
				name VARCHAR(32) NOT NULL,
				email VARCHAR(128) NOT NULL,
				password VARCHAR(64) NOT NULL,
				roleID INT UNSIGNED NOT NULL,
				remember_token VARCHAR(100) NULL,
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
		Schema::drop('employees');
	}
}