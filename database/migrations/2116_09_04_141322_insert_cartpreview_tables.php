<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertCartpreviewTables extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
			INSERT INTO `cartpreviews` (`cartID`, `fileID`, `commit`, comment, `created_at`, `updated_at`, deleted_at) VALUES ('1', '4', '0', '', now(), now(), null);
			INSERT INTO `cartpreviews` (`cartID`, `fileID`, `commit`, comment, `created_at`, `updated_at`, deleted_at) VALUES ('2', '5', '1', 'ada revisi lagi bentar', now(), now(), now());
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
