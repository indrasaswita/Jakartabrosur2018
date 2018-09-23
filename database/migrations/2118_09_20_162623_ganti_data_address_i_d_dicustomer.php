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
			ALTER TABLE customers 
				DROP address;					
			ALTER TABLE companies 
				DROP FOREIGN KEY cityID;
			ALTER TABLE companies
				DROP FOREIGN KEY cityID;	
			ALTER TABLE companies 
				DROP address;
			ALTER TABLE addresses 
				DROP FOREIGN KEY customerID;
			ALTER TABLE addresses
				DROP TABLE customerID;
			ALTER TABLE addresses 
				DROP receiver;
			ALTER TABLE vendors
				DROP FOREIGN KEY cityID;
			ALTER TABLE vendors
				DROP TABLE cityID;	
			ALTER TABLE vendors
				DROP address;
			ALTER TABLE vendors
				ADD COLUMN addressID INT UNSIGNED;
			CREATE TABLE customeraddresses (
				id INT AUTO_INCREMENT PRIMARY KEY,
				customerID INT UNSIGNED,
				addressID INT UNSIGNED,
				created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
				updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
			);
			CREATE TABLE companyaddresses (
				id INT AUTO_INCREMENT PRIMARY KEY,
				companyID INT UNSIGNED,
				addressID INT UNSIGNED,
				created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
				updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
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
		//
	}
}
