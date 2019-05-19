<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertCartfilesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
			INSERT INTO `cartfiles` (`fileID`, `cartID`, `created_at`, `updated_at`) VALUES ('1', '2', now(), now());
			INSERT INTO `cartfiles` (`fileID`, `cartID`, `created_at`, `updated_at`) VALUES ('2', '1', now(), now());
			INSERT INTO `cartfiles` (`fileID`, `cartID`, `created_at`, `updated_at`) VALUES ('3', '3', now(), now());
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
