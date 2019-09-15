<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertSalesdeliverydetailsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
			INSERT INTO `salesdeliverydetails` (`id`, `salesdeliveryID`, `salesdetailID`, `actualprice`, `quantity`, `weight`, `totalpackage`, `status`, `created_at`, `updated_at`) VALUES ('1', '1', '1', '10000', '100', '0.1', '1', '1', CURRENT_TIME(), NULL), ('2', '1', '1', '10000', '800', '0.8', '8', '1', CURRENT_TIME(), NULL);
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
