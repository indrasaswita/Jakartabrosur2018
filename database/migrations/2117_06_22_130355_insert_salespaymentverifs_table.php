<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class InsertSalespaymentverifsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::table('salespaymentverifs')->insert([
			'id'=>1,
			'paymentID'=>1,
			'note'=>'#job00001',
			'employeeID'=>'1',
			'veriftime'=>Carbon::now()
		]);
		DB::table('salespaymentverifs')->insert([
			'id'=>2,
			'paymentID'=>2,
			'note'=>'#job00001',
			'employeeID'=>'1',
			'veriftime'=>Carbon::now()
		]);
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
