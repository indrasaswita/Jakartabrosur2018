<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertJobsubtypesizesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
			INSERT INTO jobsubtypesizes VALUES ('0', '1', '1', '1', '1', now(), now());
			INSERT INTO jobsubtypesizes VALUES ('0', '1', '1', '2', '0', now(), now());
			INSERT INTO jobsubtypesizes VALUES ('0', '1', '1', '4', '1', now(), now());
			INSERT INTO jobsubtypesizes VALUES ('0', '1', '1', '5', '0', now(), now());
			INSERT INTO jobsubtypesizes VALUES ('0', '1', '1', '6', '0', now(), now());
			INSERT INTO jobsubtypesizes VALUES ('0', '1', '2', '7', '0', now(), now());
			INSERT INTO jobsubtypesizes VALUES ('0', '1', '2', '1', '1', now(), now());
			INSERT INTO jobsubtypesizes VALUES ('0', '1', '2', '2', '1', now(), now());
			INSERT INTO jobsubtypesizes VALUES ('0', '1', '2', '5', '0', now(), now());
			INSERT INTO jobsubtypesizes VALUES ('0', '1', '2', '6', '0', now(), now());
			INSERT INTO jobsubtypesizes VALUES ('0', '2', '1', '12', '1', now(), now());
			INSERT INTO jobsubtypesizes VALUES ('0', '2', '1', '13', '0', now(), now());
			INSERT INTO jobsubtypesizes VALUES ('0', '2', '1', '14', '0', now(), now());
			INSERT INTO jobsubtypesizes VALUES ('0', '2', '2', '12', '1', now(), now());
			INSERT INTO jobsubtypesizes VALUES ('0', '2', '2', '13', '0', now(), now());
			INSERT INTO jobsubtypesizes VALUES ('0', '2', '2', '14', '0', now(), now());
			INSERT INTO jobsubtypesizes VALUES ('0', '4', '1', '1', '1', now(), now());
			INSERT INTO jobsubtypesizes VALUES ('0', '4', '2', '1', '1', now(), now());
			INSERT INTO jobsubtypesizes VALUES ('0', '4', '2', '4', '0', now(), now());
			INSERT INTO jobsubtypesizes VALUES ('0', '5', '1', '7', '1', now(), now());
			INSERT INTO jobsubtypesizes VALUES ('0', '6', '1', '15', '1', now(), now());
			INSERT INTO jobsubtypesizes VALUES ('0', '6', '2', '15', '1', now(), now());
			INSERT INTO jobsubtypesizes VALUES ('0', '10', '2', '16', '1', now(), now());
			INSERT INTO jobsubtypesizes VALUES ('0', '10', '2', '18', '1', now(), now());
			INSERT INTO jobsubtypesizes VALUES ('0', '9', '2', '16', '1', now(), now());
			INSERT INTO jobsubtypesizes VALUES ('0', '9', '2', '17', '1', now(), now());
			INSERT INTO jobsubtypesizes VALUES ('0', '7', '1', '19', '1', now(), now());
			INSERT INTO jobsubtypesizes VALUES ('0', '7', '1', '20', '1', now(), now());
			INSERT INTO jobsubtypesizes VALUES ('0', '7', '1', '21', '1', now(), now());
			INSERT INTO jobsubtypesizes VALUES ('0', '7', '2', '19', '1', now(), now());
			INSERT INTO jobsubtypesizes VALUES ('0', '7', '2', '20', '1', now(), now());
			INSERT INTO jobsubtypesizes VALUES ('0', '7', '2', '21', '1', now(), now());
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
