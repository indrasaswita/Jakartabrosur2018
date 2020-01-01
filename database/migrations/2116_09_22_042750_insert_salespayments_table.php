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
			'customeraccID'=>1,
			'companyaccID'=>1,
			'note'=>'on web',
			'ammount'=>1650000,
			'type'=>'TRANSFER',
			'paydate'=>Carbon::now(),
			'created_at'=>Carbon::now()
		]);
		DB::table('salespayments')->insert([
			'id'=>7,
			'salesID'=>1,
			'customeraccID'=>1,
			'companyaccID'=>2,
			'note'=>'on web',
			'ammount'=>150000,
			'type'=>'TRANSFER',
			'paydate'=>Carbon::now(),
			'created_at'=>Carbon::now()
		]);
		DB::table('salespayments')->insert([
			'id'=>2,
			'salesID'=>2,
			'customeraccID'=>4,
			'companyaccID'=>9,
			'note'=>'by system',
			'ammount'=>1340000,
			'type'=>'TRANSFER',
			'paydate'=>Carbon::now(),
			'created_at'=>Carbon::now()
		]);
		DB::table('salespayments')->insert([
			'id'=>3,
			'salesID'=>4,
			'customeraccID'=>6,
			'companyaccID'=>2,
			'note'=>'by system',
			'ammount'=>100000,
			'type'=>'TRANSFER',
			'paydate'=>Carbon::now(),
			'created_at'=>Carbon::now()
		]);
		DB::table('salespayments')->insert([
			'id'=>4,
			'salesID'=>4,
			'customeraccID'=>5,
			'companyaccID'=>9,
			'note'=>'by admin',
			'ammount'=>2000000,
			'type'=>'TRANSFER',
			'paydate'=>Carbon::now(),
			'created_at'=>Carbon::now()
		]);
		DB::table('salespayments')->insert([
			'id'=>5,
			'salesID'=>5,
			'customeraccID'=>8,
			'companyaccID'=>9,
			'note'=>'by system',
			'ammount'=>120000,
			'type'=>'TRANSFER',
			'paydate'=>Carbon::now(),
			'created_at'=>Carbon::now()
		]);
		DB::table('salespayments')->insert([
			'id'=>6,
			'salesID'=>6,
			'customeraccID'=>9,
			'companyaccID'=>9,
			'note'=>'by system',
			'ammount'=>724036,
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
