<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePricelist extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
			CREATE TABLE pricelists (
				id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
				typeID INT UNSIGNED,
				title VARCHAR(32) NOT NULL,
				detail VARCHAR(128),
				price NUMERIC(10, 2) NOT NULL,
				created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
				updated_at TIMESTAMP NULL
			);


			INSERT INTO pricelists VALUES ('0', '1', 'BW', '', '4500', now(), now());
			INSERT INTO pricelists VALUES ('0', '2', 'VALVE HITAM', 'service', '750000', now(), now());
			INSERT INTO pricelists VALUES ('0', '2', 'VALVE KUNING', 'baru', '2200000', now(), now());
			INSERT INTO pricelists VALUES ('0', '4', 'KUNCI INGGRIS', '', '4500', now(), now());
			INSERT INTO pricelists VALUES ('0', '3', 'POWDER SM', '', '22500', now(), now());
		");
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('pricelists');
	}
}
