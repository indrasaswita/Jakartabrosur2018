<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertCartdetailsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
			INSERT INTO cartdetails values('1','1','Main','DG','5','7','1','5','32','48','21','29.7','4','4','di lipet setelahnya','42','2','11','4','2','2','0','25','5','5','0','100000',now(),now());
			INSERT INTO cartdetails values('2','2','Main','OF','1','2','1','2','30.5','44','20.5','29.2','4','4','jangan lupa di sisir','2800','300','700','4','2','2','0','2','2','1','0','158000',now(),now());
			INSERT INTO cartdetails values('3','3','Cover','OF','1','2','1','2','30.5','44','29.2','41','4','4','laminating gloss','2800','300','700','4','2','2','0','1','1','1','0','400000',now(),now());
			INSERT INTO cartdetails values('4','3','Main','OF','1','5','1','2','30.5','44','29.2','41','4','4','susun anom, lipet anom bacok, jilid staples','2700','200','675','4','2','2','0','1','1','1','0','400000',now(),now());
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
