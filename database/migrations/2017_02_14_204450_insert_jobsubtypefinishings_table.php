<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertJobsubtypefinishingsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
			INSERT INTO jobsubtypefinishings VALUES ('0', '1', '1', '1', now(), now());
			INSERT INTO jobsubtypefinishings VALUES ('0', '1', '1', '2', now(), now());
			INSERT INTO jobsubtypefinishings VALUES ('0', '1', '1', '3', now(), now());
			INSERT INTO jobsubtypefinishings VALUES ('0', '1', '1', '4', now(), now());
			INSERT INTO jobsubtypefinishings VALUES ('0', '1', '1', '5', now(), now());
			INSERT INTO jobsubtypefinishings VALUES ('0', '1', '1', '6', now(), now());
			INSERT INTO jobsubtypefinishings VALUES ('0', '1', '1', '8', now(), now());
			INSERT INTO jobsubtypefinishings VALUES ('0', '1', '1', '15', now(), now());
			INSERT INTO jobsubtypefinishings VALUES ('0', '2', '1', '13', now(), now());
			INSERT INTO jobsubtypefinishings VALUES ('0', '2', '1', '14', now(), now());
			INSERT INTO jobsubtypefinishings VALUES ('0', '2', '1', '15', now(), now());
			INSERT INTO jobsubtypefinishings VALUES ('0', '1', '2', '1', now(), now());
			INSERT INTO jobsubtypefinishings VALUES ('0', '1', '2', '3', now(), now());
			INSERT INTO jobsubtypefinishings VALUES ('0', '1', '2', '5', now(), now());
			INSERT INTO jobsubtypefinishings VALUES ('0', '1', '2', '6', now(), now());
			INSERT INTO jobsubtypefinishings VALUES ('0', '2', '1', '1', now(), now());
			INSERT INTO jobsubtypefinishings VALUES ('0', '2', '1', '6', now(), now());
			INSERT INTO jobsubtypefinishings VALUES ('0', '2', '1', '8', now(), now());
			INSERT INTO jobsubtypefinishings VALUES ('0', '2', '2', '1', now(), now());
			INSERT INTO jobsubtypefinishings VALUES ('0', '2', '2', '6', now(), now());
			INSERT INTO jobsubtypefinishings VALUES ('0', '3', '1', '8', now(), now());
			INSERT INTO jobsubtypefinishings VALUES ('0', '4', '1', '13', now(), now());
			INSERT INTO jobsubtypefinishings VALUES ('0', '4', '1', '14', now(), now());
			INSERT INTO jobsubtypefinishings VALUES ('0', '4', '1', '6', now(), now());
			INSERT INTO jobsubtypefinishings VALUES ('0', '4', '1', '8', now(), now());
			INSERT INTO jobsubtypefinishings VALUES ('0', '4', '2', '6', now(), now());
			INSERT INTO jobsubtypefinishings VALUES ('0', '5', '1', '2', now(), now());
			INSERT INTO jobsubtypefinishings VALUES ('0', '5', '1', '3', now(), now());
			INSERT INTO jobsubtypefinishings VALUES ('0', '5', '1', '6', now(), now());
			INSERT INTO jobsubtypefinishings VALUES ('0', '5', '1', '7', now(), now());
			INSERT INTO jobsubtypefinishings VALUES ('0', '6', '1', '8', now(), now());
			INSERT INTO jobsubtypefinishings VALUES ('0', '6', '1', '9', now(), now());
			INSERT INTO jobsubtypefinishings VALUES ('0', '6', '1', '10', now(), now());
			INSERT INTO jobsubtypefinishings VALUES ('0', '6', '2', '3', now(), now());
			INSERT INTO jobsubtypefinishings VALUES ('0', '6', '2', '8', now(), now());
			INSERT INTO jobsubtypefinishings VALUES ('0', '6', '2', '9', now(), now());
			INSERT INTO jobsubtypefinishings VALUES ('0', '6', '2', '10', now(), now());
			INSERT INTO jobsubtypefinishings VALUES ('0', '10', '2', '17', now(), now());
			INSERT INTO jobsubtypefinishings VALUES ('0', '10', '2', '12', now(), now());
			INSERT INTO jobsubtypefinishings VALUES ('0', '9', '2', '17', now(), now());
			INSERT INTO jobsubtypefinishings VALUES ('0', '9', '2', '18', now(), now());
			INSERT INTO jobsubtypefinishings VALUES ('0', '11', '2', '16', now(), now());
			INSERT INTO jobsubtypefinishings VALUES ('0', '12', '2', '16', now(), now());
			INSERT INTO jobsubtypefinishings VALUES ('0', '12', '2', '17', now(), now());
			INSERT INTO jobsubtypefinishings VALUES ('0', '7', '1', '19', now(), now());
			INSERT INTO jobsubtypefinishings VALUES ('0', '7', '1', '20', now(), now());
			INSERT INTO jobsubtypefinishings VALUES ('0', '7', '2', '19', now(), now());
			INSERT INTO jobsubtypefinishings VALUES ('0', '7', '2', '20', now(), now());
			INSERT INTO jobsubtypefinishings VALUES ('0', '13', '1', '7', now(), now());
			INSERT INTO jobsubtypefinishings VALUES ('0', '13', '2', '7', now(), now());
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
