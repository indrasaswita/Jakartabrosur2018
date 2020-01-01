<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePapersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
			CREATE TABLE papers (
				id INT PRIMARY KEY AUTO_INCREMENT,
				papertypeID INT UNSIGNED NOT NULL,
				name VARCHAR(64) NOT NULL,
				color VARCHAR(16) NOT NULL,
				gramature SMALLINT NOT NULL,
				bothsideprint TINYINT NOT NULL DEFAULT 1,
				texture TINYINT NOT NULL DEFAULT 0,
				numerator TINYINT NOT NULL DEFAULT 0,
				varnish TINYINT NOT NULL DEFAULT 0,
				spotuv TINYINT NOT NULL DEFAULT 0,
				laminating TINYINT NOT NULL DEFAULT 0,
				folding TINYINT NOT NULL DEFAULT 0,
				perforation TINYINT NOT NULL DEFAULT 0,
				coatingtypeID INT UNSIGNED NOT NULL DEFAULT 1,
				diecut TINYINT NOT NULL DEFAULT 0,
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
		Schema::drop('papers');
	}
}
