<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertJobsubtypequantitiesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("    
			INSERT INTO jobsubtypequantities VALUES ('0', '1', '1', '500', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '1', '1', '5000', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '1', '1', '10000', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '1', '1', '50000', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '1', '1', '100000', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '1', '1', '150000', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '1', '1', '200000', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '1', '2', '10', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '1', '2', '20', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '1', '2', '50', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '1', '2', '100', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '1', '2', '200', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '1', '2', '500', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '1', '2', '1000', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '2', '1', '30', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '2', '1', '50', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '2', '1', '100', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '2', '1', '150', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '2', '1', '200', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '2', '2', '1', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '2', '2', '5', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '2', '2', '10', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '2', '2', '50', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '2', '2', '100', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '2', '2', '200', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '3', '1', '100', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '3', '1', '500', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '3', '1', '1000', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '3', '1', '2000', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '3', '1', '5000', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '3', '1', '10000', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '3', '1', '20000', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '4', '1', '500', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '4', '1', '5000', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '4', '1', '10000', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '4', '1', '50000', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '4', '2', '1', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '4', '2', '10', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '4', '2', '50', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '4', '2', '100', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '4', '2', '150', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '4', '2', '250', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '4', '2', '500', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '5', '1', '20', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '5', '1', '50', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '5', '1', '100', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '5', '1', '200', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '5', '1', '500', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '5', '1', '1000', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '6', '1', '500', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '6', '1', '1000', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '6', '1', '2000', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '6', '1', '5000', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '6', '1', '10000', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '6', '1', '20000', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '6', '1', '50000', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '6', '2', '50', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '6', '2', '100', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '6', '2', '500', now(), now());
			INSERT INTO jobsubtypequantities VALUES ('0', '6', '2', '1000', now(), now());
		");
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
