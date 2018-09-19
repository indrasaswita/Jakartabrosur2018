<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartpreviewTables extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
			CREATE TABLE cartpreviews (
				id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
				cartID INT UNSIGNED NOT NULL,
				fileID INT UNSIGNED NOT NULL,
				commit TINYINT NOT NULL DEFAULT 0,
				comment VARCHAR(255),
				created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
				updated_at TIMESTAMP NULL,
				deleted_at TIMESTAMP NULL
			)
		");
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('cartpreviews');
	}
}
