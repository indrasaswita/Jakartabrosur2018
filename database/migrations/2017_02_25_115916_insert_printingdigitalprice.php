<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertPrintingdigitalprice extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
			INSERT INTO printingdigitalprices VALUES('1', '5', '1', '6000', now(), now());
			INSERT INTO printingdigitalprices VALUES('2', '5', '10', '5500', now(), now());
			INSERT INTO printingdigitalprices VALUES('3', '5', '20', '5000', now(), now());
			INSERT INTO printingdigitalprices VALUES('4', '5', '30', '4500', now(), now());
			INSERT INTO printingdigitalprices VALUES('5', '5', '50', '4000', now(), now());
			INSERT INTO printingdigitalprices VALUES('6', '5', '100', '3500', now(), now());
			INSERT INTO printingdigitalprices VALUES('7', '5', '150', '3000', now(), now());
			INSERT INTO printingdigitalprices VALUES('8', '5', '200', '2500', now(), now());
			INSERT INTO printingdigitalprices VALUES('9', '5', '250', '2000', now(), now());
			INSERT INTO printingdigitalprices VALUES('10', '8', '1', '60000', now(), now());
			INSERT INTO printingdigitalprices VALUES('11', '8', '8', '50000', now(), now());
			INSERT INTO printingdigitalprices VALUES('12', '8', '15', '40000', now(), now());
			INSERT INTO printingdigitalprices VALUES('13', '8', '30', '30000', now(), now());
			INSERT INTO printingdigitalprices VALUES('14', '8', '80', '25000', now(), now());
			INSERT INTO printingdigitalprices VALUES('15', '9', '1', '5000', now(), now());
			INSERT INTO printingdigitalprices VALUES('16', '9', '5', '3800', now(), now());
			INSERT INTO printingdigitalprices VALUES('17', '9', '10', '3400', now(), now());
			/*INSERT INTO printingdigitalprices VALUES('18', '9', '20', '5000', now(), now());
			INSERT INTO printingdigitalprices VALUES('19', '9', '30', '4500', now(), now());
			INSERT INTO printingdigitalprices VALUES('30', '9', '40', '4000', now(), now());
			INSERT INTO printingdigitalprices VALUES('31', '9', '70', '3800', now(), now());*/
			INSERT INTO printingdigitalprices VALUES('20', '10', '1', '20', now(), now());
			INSERT INTO printingdigitalprices VALUES('21', '10', '40', '15', now(), now());
			INSERT INTO printingdigitalprices VALUES('22', '10', '100', '10', now(), now());
			INSERT INTO printingdigitalprices VALUES('23', '10', '200', '5', now(), now());
			INSERT INTO printingdigitalprices VALUES('24', '10', '500', '2', now(), now());
			INSERT INTO printingdigitalprices VALUES('25', '11', '1', '22000', now(), now());
			INSERT INTO printingdigitalprices VALUES('26', '11', '5', '18000', now(), now());
			INSERT INTO printingdigitalprices VALUES('27', '11', '10', '15000', now(), now());
			INSERT INTO printingdigitalprices VALUES('28', '11', '20', '12000', now(), now());
			INSERT INTO printingdigitalprices VALUES('29', '11', '50', '10000', now(), now());
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
