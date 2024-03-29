<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartdetailsTable extends Migration
{
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up()
		{
			DB::unprepared("
				CREATE TABLE cartdetails(
					id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
					cartID INT UNSIGNED NOT NULL,
					cartname VARCHAR(32) NOT NULL,
					jobtype VARCHAR(16) NOT NULL,
					printerID INT UNSIGNED NULL,
					paperID INT UNSIGNED NULL,
					vendorID INT UNSIGNED NULL,
					planoID INT UNSIGNED NULL,
					printwidth NUMERIC(5,2) UNSIGNED NOT NULL,
					printlength NUMERIC(5,2) UNSIGNED NOT NULL,
					imagewidth NUMERIC(5,2) UNSIGNED NOT NULL,
					imagelength NUMERIC(5,2) UNSIGNED NOT NULL,
					side1 TINYINT NOT NULL,
					side2 TINYINT NOT NULL,
					employeenote VARCHAR(255) NOT NULL,
					totaldruct INT UNSIGNED NOT NULL,
					inschiet INT UNSIGNED NOT NULL,
					totalplano INT UNSIGNED NOT NULL,
					totalinplano SMALLINT UNSIGNED NOT NULL,
					totalinplanox SMALLINT UNSIGNED NOT NULL,
					totalinplanoy SMALLINT UNSIGNED NOT NULL,
					totalinplanorest SMALLINT UNSIGNED NOT NULL DEFAULT 0,
					totalinprint SMALLINT UNSIGNED NOT NULL,
					totalinprintx SMALLINT UNSIGNED NOT NULL,
					totalinprinty SMALLINT UNSIGNED NOT NULL,
					totalinprintrest SMALLINT UNSIGNED NOT NULL DEFAULT 0,
					totalpaperprice INT UNSIGNED NOT NULL,
					created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
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
				Schema::drop('cartdetails'); 
		}
}
