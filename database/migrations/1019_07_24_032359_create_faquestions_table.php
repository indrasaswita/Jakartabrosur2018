<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaquestionsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
			CREATE TABLE faquestions(
				id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
				title VARCHAR(100),
				favourite TINYINT NOT NULL DEFAULT 0,
				description VARCHAR(4000),
				questiontypeID INT UNSIGNED NOT NULL,
				linkheader VARCHAR(255) NOT NULL DEFAULT '',
				linkurl VARCHAR(255) NOT NULL DEFAULT '',
				employeeID int UNSIGNED NOT NULL,
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
		Schema::dropIfExists('faquestions');
	}
}
