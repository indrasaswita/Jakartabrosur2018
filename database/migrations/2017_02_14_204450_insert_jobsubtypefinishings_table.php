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
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('1', '1', '1', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('1', '1', '8', '1', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('2', '1', '1', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('2', '1', '8', '1', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('2', '1', '7', '1', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('3', '1', '1', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('3', '1', '8', '1', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('3', '1', '6', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('3', '1', '11', '1', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('1', '2', '15', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('1', '2', '20', '1', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('2', '2', '15', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('2', '2', '20', '1', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('2', '2', '19', '1', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('3', '2', '15', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('3', '2', '20', '1', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('3', '2', '18', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('3', '2', '23', '1', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('4', '1', '1', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('4', '1', '3', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('4', '1', '8', '1', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('4', '1', '9', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('4', '2', '15', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('4', '2', '21', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('4', '2', '20', '1', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('5', '2', '20', '1', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('6', '2', '20', '1', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('6', '2', '15', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('6', '2', '23', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('7', '1', '1', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('7', '1', '5', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('7', '1', '8', '1', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('7', '2', '15', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('7', '2', '20', '1', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('7', '2', '23', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('7', '2', '17', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('8', '2', '15', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('8', '2', '17', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('8', '2', '18', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('8', '2', '20', '1', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('8', '2', '23', '1', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('9', '1', '1', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('9', '1', '2', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('9', '1', '3', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('9', '1', '8', '1', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('9', '1', '9', '1', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('10', '1', '3', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('10', '1', '4', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('10', '1', '7', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('10', '1', '8', '1', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('10', '2', '19', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('10', '2', '20', '1', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('10', '2', '16', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('11', '1', '6', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('11', '1', '11', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('11', '1', '14', '1', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('12', '1', '1', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('12', '1', '2', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('12', '1', '3', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('12', '1', '6', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('12', '1', '8', '1', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('12', '1', '11', '1', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('12', '1', '14', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('12', '2', '15', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('12', '2', '18', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('12', '2', '20', '1', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('12', '2', '23', '1', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('12', '2', '25', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('13', '1', '32', '1', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('13', '1', '33', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('13', '1', '34', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('13', '2', '32', '1', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('14', '1', '13', '1', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('14', '1', '10', '1', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('14', '1', '35', '1', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('14', '2', '24', '1', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('14', '2', '22', '1', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('14', '2', '35', '1', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('15', '2', '36', '1', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('15', '2', '37', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('15', '2', '38', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('16', '2', '26', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('16', '2', '27', '1', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('16', '2', '28', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('17', '2', '29', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('18', '2', '26', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('18', '2', '30', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('18', '2', '39', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('19', '2', '27', '1', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('20', '2', '26', '0', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('20', '2', '27', '1', now(), now());
			INSERT INTO jobsubtypefinishings (jobsubtypeID, ofdg, finishingID, mustdo, created_at, updated_at) VALUES ('20', '2', '31', '0', now(), now());
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
