<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertSalesdeliveriesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
			INSERT INTO `salesdeliveries` (`id`, `salesID`, `deliveryID`, `employeeID`, `addressID`, `receiver`, `customernote`, `employeenote`, `suratimage`, `suratno`, `arrivedtime`, `created_at`, `updated_at`) VALUES ('1', '1', '1', '1', '1', 'Ujang', NULL, NULL, NULL, NULL, '2019-09-01 10:00:00', CURRENT_TIME(), NULL);
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
