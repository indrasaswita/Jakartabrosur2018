<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertJobsubtypedetailfinishingsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
			INSERT INTO jobsubtypedetailfinishings (jobsubtypedetailID, ofdg, finishingID, created_at, updated_at) VALUES ('1', '1', '1', now(), now());
			INSERT INTO jobsubtypedetailfinishings (jobsubtypedetailID, ofdg, finishingID, created_at, updated_at) VALUES ('1', '1', '4', now(), now());
			INSERT INTO jobsubtypedetailfinishings (jobsubtypedetailID, ofdg, finishingID, created_at, updated_at) VALUES ('1', '1', '8', now(), now());
			INSERT INTO jobsubtypedetailfinishings (jobsubtypedetailID, ofdg, finishingID, created_at, updated_at) VALUES ('1', '1', '13', now(), now());
			INSERT INTO jobsubtypedetailfinishings (jobsubtypedetailID, ofdg, finishingID, created_at, updated_at) VALUES ('1', '1', '14', now(), now());
			INSERT INTO jobsubtypedetailfinishings (jobsubtypedetailID, ofdg, finishingID, created_at, updated_at) VALUES ('1', '1', '15', now(), now());
			INSERT INTO jobsubtypedetailfinishings (jobsubtypedetailID, ofdg, finishingID, created_at, updated_at) VALUES ('1', '2', '1', now(), now());
			INSERT INTO jobsubtypedetailfinishings (jobsubtypedetailID, ofdg, finishingID, created_at, updated_at) VALUES ('2', '2', '1', now(), now());
			INSERT INTO jobsubtypedetailfinishings (jobsubtypedetailID, ofdg, finishingID, created_at, updated_at) VALUES ('2', '1', '1', now(), now());
			INSERT INTO jobsubtypedetailfinishings (jobsubtypedetailID, ofdg, finishingID, created_at, updated_at) VALUES ('2', '1', '4', now(), now());
			INSERT INTO jobsubtypedetailfinishings (jobsubtypedetailID, ofdg, finishingID, created_at, updated_at) VALUES ('2', '1', '8', now(), now());
			INSERT INTO jobsubtypedetailfinishings (jobsubtypedetailID, ofdg, finishingID, created_at, updated_at) VALUES ('2', '1', '15', now(), now());
			INSERT INTO jobsubtypedetailfinishings (jobsubtypedetailID, ofdg, finishingID, created_at, updated_at) VALUES ('3', '2', '1', now(), now());
			INSERT INTO jobsubtypedetailfinishings (jobsubtypedetailID, ofdg, finishingID, created_at, updated_at) VALUES ('3', '1', '1', now(), now());
			INSERT INTO jobsubtypedetailfinishings (jobsubtypedetailID, ofdg, finishingID, created_at, updated_at) VALUES ('3', '1', '4', now(), now());
			INSERT INTO jobsubtypedetailfinishings (jobsubtypedetailID, ofdg, finishingID, created_at, updated_at) VALUES ('3', '1', '8', now(), now());
			INSERT INTO jobsubtypedetailfinishings (jobsubtypedetailID, ofdg, finishingID, created_at, updated_at) VALUES ('3', '1', '13', now(), now());
			INSERT INTO jobsubtypedetailfinishings (jobsubtypedetailID, ofdg, finishingID, created_at, updated_at) VALUES ('3', '1', '14', now(), now());
			INSERT INTO jobsubtypedetailfinishings (jobsubtypedetailID, ofdg, finishingID, created_at, updated_at) VALUES ('3', '1', '15', now(), now());
			INSERT INTO jobsubtypedetailfinishings (jobsubtypedetailID, ofdg, finishingID, created_at, updated_at) VALUES ('4', '1', '1', now(), now());
			INSERT INTO jobsubtypedetailfinishings (jobsubtypedetailID, ofdg, finishingID, created_at, updated_at) VALUES ('4', '1', '3', now(), now());
			INSERT INTO jobsubtypedetailfinishings (jobsubtypedetailID, ofdg, finishingID, created_at, updated_at) VALUES ('4', '1', '4', now(), now());
			INSERT INTO jobsubtypedetailfinishings (jobsubtypedetailID, ofdg, finishingID, created_at, updated_at) VALUES ('4', '1', '8', now(), now());
			INSERT INTO jobsubtypedetailfinishings (jobsubtypedetailID, ofdg, finishingID, created_at, updated_at) VALUES ('4', '1', '13', now(), now());
			INSERT INTO jobsubtypedetailfinishings (jobsubtypedetailID, ofdg, finishingID, created_at, updated_at) VALUES ('4', '1', '14', now(), now());
			INSERT INTO jobsubtypedetailfinishings (jobsubtypedetailID, ofdg, finishingID, created_at, updated_at) VALUES ('4', '1', '15', now(), now());
			INSERT INTO jobsubtypedetailfinishings (jobsubtypedetailID, ofdg, finishingID, created_at, updated_at) VALUES ('5', '1', '1', now(), now());
			INSERT INTO jobsubtypedetailfinishings (jobsubtypedetailID, ofdg, finishingID, created_at, updated_at) VALUES ('5', '1', '3', now(), now());
			INSERT INTO jobsubtypedetailfinishings (jobsubtypedetailID, ofdg, finishingID, created_at, updated_at) VALUES ('5', '1', '4', now(), now());
			INSERT INTO jobsubtypedetailfinishings (jobsubtypedetailID, ofdg, finishingID, created_at, updated_at) VALUES ('5', '1', '8', now(), now());
			INSERT INTO jobsubtypedetailfinishings (jobsubtypedetailID, ofdg, finishingID, created_at, updated_at) VALUES ('5', '1', '13', now(), now());
			INSERT INTO jobsubtypedetailfinishings (jobsubtypedetailID, ofdg, finishingID, created_at, updated_at) VALUES ('5', '1', '14', now(), now());
			INSERT INTO jobsubtypedetailfinishings (jobsubtypedetailID, ofdg, finishingID, created_at, updated_at) VALUES ('5', '1', '15', now(), now());
			INSERT INTO jobsubtypedetailfinishings (jobsubtypedetailID, ofdg, finishingID, created_at, updated_at) VALUES ('6', '1', '1', now(), now());
			INSERT INTO jobsubtypedetailfinishings (jobsubtypedetailID, ofdg, finishingID, created_at, updated_at) VALUES ('6', '1', '3', now(), now());
			INSERT INTO jobsubtypedetailfinishings (jobsubtypedetailID, ofdg, finishingID, created_at, updated_at) VALUES ('6', '1', '4', now(), now());
			INSERT INTO jobsubtypedetailfinishings (jobsubtypedetailID, ofdg, finishingID, created_at, updated_at) VALUES ('6', '1', '8', now(), now());
			INSERT INTO jobsubtypedetailfinishings (jobsubtypedetailID, ofdg, finishingID, created_at, updated_at) VALUES ('6', '1', '13', now(), now());
			INSERT INTO jobsubtypedetailfinishings (jobsubtypedetailID, ofdg, finishingID, created_at, updated_at) VALUES ('6', '1', '14', now(), now());
			INSERT INTO jobsubtypedetailfinishings (jobsubtypedetailID, ofdg, finishingID, created_at, updated_at) VALUES ('6', '1', '15', now(), now());
			INSERT INTO jobsubtypedetailfinishings (jobsubtypedetailID, ofdg, finishingID, created_at, updated_at) VALUES ('4', '2', '1', now(), now());
			INSERT INTO jobsubtypedetailfinishings (jobsubtypedetailID, ofdg, finishingID, created_at, updated_at) VALUES ('5', '2', '1', now(), now());
			INSERT INTO jobsubtypedetailfinishings (jobsubtypedetailID, ofdg, finishingID, created_at, updated_at) VALUES ('6', '2', '1', now(), now());
			INSERT INTO jobsubtypedetailfinishings (jobsubtypedetailID, ofdg, finishingID, created_at, updated_at) VALUES ('7', '1', '1', now(), now());
			INSERT INTO jobsubtypedetailfinishings (jobsubtypedetailID, ofdg, finishingID, created_at, updated_at) VALUES ('7', '1', '1', now(), now());
			INSERT INTO jobsubtypedetailfinishings (jobsubtypedetailID, ofdg, finishingID, created_at, updated_at) VALUES ('7', '1', '4', now(), now());
			INSERT INTO jobsubtypedetailfinishings (jobsubtypedetailID, ofdg, finishingID, created_at, updated_at) VALUES ('7', '1', '13', now(), now());
			INSERT INTO jobsubtypedetailfinishings (jobsubtypedetailID, ofdg, finishingID, created_at, updated_at) VALUES ('7', '1', '14', now(), now());
			INSERT INTO jobsubtypedetailfinishings (jobsubtypedetailID, ofdg, finishingID, created_at, updated_at) VALUES ('7', '1', '15', now(), now());
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
