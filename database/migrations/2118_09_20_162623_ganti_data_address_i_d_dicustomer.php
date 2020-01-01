<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GantiDataAddressIDDicustomer extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared('
			ALTER TABLE companies
				DROP COLUMN cityID;	
			ALTER TABLE companies 
				DROP  COLUMN address;
			ALTER TABLE addresses
				DROP COLUMN customerID;
			ALTER TABLE addresses 
				DROP COLUMN receiver;
			ALTER TABLE vendors
				DROP COLUMN address;
			ALTER TABLE vendors
				ADD COLUMN addressID INT UNSIGNED AFTER phone2;
			CREATE TABLE customeraddresses (
				id INT AUTO_INCREMENT PRIMARY KEY,
				customerID INT UNSIGNED,
				addressID INT UNSIGNED,
				created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
				updated_at TIMESTAMP NULL
			);
			CREATE TABLE companyaddresses (
				id INT AUTO_INCREMENT PRIMARY KEY,
				companyID INT UNSIGNED,
				addressID INT UNSIGNED,
				created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
				updated_at TIMESTAMP NULL
			);
		');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('customeraddresses');
		Schema::dropIfExists('companyaddresses');
	}
}
