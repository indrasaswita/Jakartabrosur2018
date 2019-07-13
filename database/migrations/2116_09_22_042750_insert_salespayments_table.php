<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class InsertSalespaymentsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::table('salespayments')->insert([
			'id'=>1,
			'salesID'=>1,
			'customeraccID'=>2,
			'companyaccID'=>2,
			'note'=>'#job00001',
			'ammount'=>1650000,
			'type'=>'TRANSFER',
			'paydate'=>Carbon::now(),
			'created_at'=>Carbon::now()
		]);
		DB::table('salespayments')->insert([
			'id'=>2,
			'salesID'=>2,
			'customeraccID'=>2,
			'companyaccID'=>2,
			'note'=>'#job00001',
			'ammount'=>1340000,
			'type'=>'TRANSFER',
			'paydate'=>Carbon::now(),
			'created_at'=>Carbon::now()
		]);

		// DB::table('salespayments')->insert([
		// 	'id'=>1,
		// 	'salesID'=>3,
		// 	'customeraccID'=>2,
		// 	'companyaccID'=>2,
		// 	'note'=>'#job00001',
		// 	'ammount'=>1015000,
		// 	'type'=>'TRANSFER',
		// 	'paydate'=>Carbon::now()
		// ]);
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
