<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertPlayerIDOnesignal extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
			CREATE TABLE onesignals(
				id INT PRIMARY KEY AUTO_INCREMENT,
				ownertype VARCHAR(8) NOT NULL DEFAULT 'CU',
				ownerID INT UNSIGNED NOT NULL,
				player_id VARCHAR(128) NOT NULL,
				active TINYINT NOT NULL DEFAULT 0,
				created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
				updated_at TIMESTAMP NULL
			);

			INSERT INTO onesignals (ownertype, ownerID, player_id, active, created_at) VALUES ('EM', '2', '62ac6021-7853-43ba-aaaa-15471162f173', 1, now());

			ALTER TABLE employees
				ADD COLUMN app_token VARCHAR(64) NULL AFTER remember_token;

			ALTER TABLE customers
				ADD COLUMN app_token VARCHAR(64) NULL AFTER verify_token;

		");
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists("onesignals");
	}
}
