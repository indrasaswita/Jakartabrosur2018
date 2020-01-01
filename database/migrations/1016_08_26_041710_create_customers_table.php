<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		DB::unprepared("
			CREATE TABLE customers(
				id INT PRIMARY KEY AUTO_INCREMENT,
				companyID INT UNSIGNED NULL,
				email VARCHAR(255) NOT NULL,
				password VARCHAR(64) NOT NULL DEFAULT '',
				name VARCHAR(64) NOT NULL,
				type VARCHAR(32) NOT NULL,
				title VARCHAR(8) NOT NULL,
				phone1 VARCHAR(16) NULL,
				phone2 VARCHAR(16) NULL,
				phone3 VARCHAR(16) NULL,
				news TINYINT NOT NULL,
				balance DECIMAL(10,2) NOT NULL,
				remember_token VARCHAR(100) NOT NULL,
				verify_token VARCHAR(100) NOT NULL,
				verified TINYINT NOT NULL DEFAULT 0,
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
		Schema::drop('customers');
	}
}
