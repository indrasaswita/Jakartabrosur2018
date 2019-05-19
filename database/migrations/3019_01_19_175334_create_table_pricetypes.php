<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePricetypes extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
			CREATE TABLE pricetypes (
				id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
				name VARCHAR(32) NOT NULL,
				created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
				updated_at TIMESTAMP NULL
			);


			INSERT INTO pricetypes VALUES ('1', 'KERTAS', now(), now());
			INSERT INTO pricetypes VALUES ('2', 'SPAREPART', now(), now());
			INSERT INTO pricetypes VALUES ('3', 'PERLENGKAPAN', now(), now());
			INSERT INTO pricetypes VALUES ('4', 'ALAT-ALAT', now(), now());
			INSERT INTO pricetypes VALUES ('5', 'ONGKOS', now(), now());
		");
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('pricetypes');
	}
}
