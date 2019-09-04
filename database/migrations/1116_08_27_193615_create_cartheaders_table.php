q<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartheadersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
			CREATE TABLE cartheaders
			(
				id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
				customerID INT UNSIGNED NOT NULL,
				jobsubtypeID INT UNSIGNED NOT NULL,
				jobtitle VARCHAR (128) NOT NULL,
				quantity INT UNSIGNED NOT NULL,
				quantitytypename VARCHAR (16) NOT NULL,
				customernote VARCHAR (255) NOT NULL,
				itemdescription VARCHAR (255) NOT NULL,
				resellername VARCHAR(64) NOT NULL,
				resellerphone VARCHAR(32) NOT NULL,
				reselleraddress VARCHAR(255) NOT NULL,
				buyprice INT UNSIGNED NOT NULL,
				printprice INT UNSIGNED NOT NULL,
				deliveryprice INT UNSIGNED NOT NULL,
				discount INT UNSIGNED NOT NULL,
				processtype VARCHAR(16) NOT NULL,
				processtime INT UNSIGNED NOT NULL,
				deliveryID INT UNSIGNED NOT NULL,
				deliveryaddressID INT UNSIGNED NULL,
				deliverytime INT UNSIGNED NOT NULL,
				totalpackage INT UNSIGNED NOT NULL,
				totalweight INT UNSIGNED NOT NULL,
				filestatus TINYINT NOT NULL,
				created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
				updated_at TIMESTAMP NULL DEFAULT NULL,
				deleted_at TIMESTAMP NULL DEFAULT NULL
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
		DB::unprepared('DROP TABLE IF EXISTS cartheaders');
	}
}
