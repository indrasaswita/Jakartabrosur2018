<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertJobsubtypepapers extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
			INSERT INTO jobsubtypepapers VALUES ('0', '1', '1', '1', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '1', '1', '2', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '1', '1', '3', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '1', '1', '4', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '1', '1', '5', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '1', '1', '6', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '1', '1', '7', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '1', '1', '8', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '1', '1', '9', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '1', '1', '10', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '1', '1', '11', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '1', '1', '12', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '1', '2', '3', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '1', '2', '4', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '1', '2', '6', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '1', '2', '7', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '1', '2', '12', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '2', '1', '7', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '2', '1', '8', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '2', '1', '9', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '2', '1', '13', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '2', '1', '14', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '2', '2', '7', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '2', '2', '13', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '2', '2', '14', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '3', '1', '11', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '3', '1', '12', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '3', '1', '16', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '4', '1', '11', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '4', '1', '12', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '4', '2', '12', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '5', '1', '18', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '5', '1', '19', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '5', '1', '20', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '5', '1', '21', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '5', '1', '22', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '6', '1', '31', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '6', '2', '31', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '7', '1', '7', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '7', '1', '13', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '7', '1', '14', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '7', '2', '7', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '7', '2', '13', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '7', '2', '14', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '8', '1', '1', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '8', '1', '2', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '8', '1', '3', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '8', '1', '4', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '8', '1', '5', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '8', '1', '6', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '8', '1', '7', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '8', '1', '10', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '8', '1', '11', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '8', '1', '12', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '8', '1', '13', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '8', '1', '14', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '8', '2', '1', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '8', '2', '2', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '8', '2', '3', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '8', '2', '4', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '8', '2', '5', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '8', '2', '6', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '8', '2', '7', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '8', '2', '10', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '8', '2', '11', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '8', '2', '12', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '8', '2', '13', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '8', '2', '14', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '9', '2', '28', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '9', '2', '29', '1', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '9', '2', '30', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '10', '2', '28', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '10', '2', '29', '1', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '10', '2', '30', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '11', '2', '25', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '11', '2', '26', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '11', '2', '27', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '12', '2', '28', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '12', '2', '29', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '12', '2', '30', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '1', '1', '32', '1', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '1', '1', '34', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '1', '1', '36', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '1', '1', '37', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '1', '1', '38', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '1', '2', '32', '1', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '1', '2', '33', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '1', '2', '34', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '1', '2', '35', '0', now(), now());
			INSERT INTO jobsubtypepapers VALUES ('0', '1', '2', '37', '0', now(), now());
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
