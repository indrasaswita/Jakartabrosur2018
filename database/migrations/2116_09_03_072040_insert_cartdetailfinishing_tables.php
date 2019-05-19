<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertCartdetailfinishingTables extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
			INSERT INTO cartdetailfinishings(cartdetailID, finishingID, optionID, quantity, buyprice, sellprice, side, created_at, updated_at) VALUES('1', '1', '1', '1000', '125000', '350000', '1', now(), now());
			INSERT INTO cartdetailfinishings(cartdetailID, finishingID, optionID, quantity, buyprice, sellprice, side, created_at, updated_at) VALUES('2', '3', '10', '200', '150000', '400000', '2', now(), now());
			INSERT INTO cartdetailfinishings(cartdetailID, finishingID, optionID, quantity, buyprice, sellprice, side, created_at, updated_at) VALUES('3', '11', '20', '300', '305000', '500000', '2', now(), now());
			INSERT INTO cartdetailfinishings(cartdetailID, finishingID, optionID, quantity, buyprice, sellprice, side, created_at, updated_at) VALUES('4', '7', '11', '50', '701000', '800000', '1', now(), now());
			INSERT INTO cartdetailfinishings(cartdetailID, finishingID, optionID, quantity, buyprice, sellprice, side, created_at, updated_at) VALUES('1', '6', '32', '650', '540000', '900000', '1', now(), now());
			INSERT INTO cartdetailfinishings(cartdetailID, finishingID, optionID, quantity, buyprice, sellprice, side, created_at, updated_at) VALUES('1', '4', '28', '800', '300000', '1000000', '1', now(), now());
			INSERT INTO cartdetailfinishings(cartdetailID, finishingID, optionID, quantity, buyprice, sellprice, side, created_at, updated_at) VALUES('2', '5', '7', '25', '1250000', '1600000', '1', now(), now());
			INSERT INTO cartdetailfinishings(cartdetailID, finishingID, optionID, quantity, buyprice, sellprice, side, created_at, updated_at) VALUES('1', '8', '19', '35', '8907500', '10000000', '1', now(), now());
			INSERT INTO cartdetailfinishings(cartdetailID, finishingID, optionID, quantity, buyprice, sellprice, side, created_at, updated_at) VALUES('3', '9', '15', '34', '1234567', '12000000', '2', now(), now());
			INSERT INTO cartdetailfinishings(cartdetailID, finishingID, optionID, quantity, buyprice, sellprice, side, created_at, updated_at) VALUES('4', '2', '7', '2', '10000000', '150000000', '1', now(), now());
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
