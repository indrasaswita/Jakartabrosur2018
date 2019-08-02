<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertOnesignalsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
			INSERT INTO onesignals (id, devicename, player_id, active, created_at, updated_at) VALUES (1, 'BBB100-7 (7.1.1)', '7e9a4edb-5567-4505-9cbe-435cbeabce86', 1, now(), null),
				(2, 'A51w (5.1.1)', '699af28f-ae7c-4132-9b54-8cf86d6b0c5e', 1, now(), null), 
				(3, 'Redmi 4x (7.1.2)', '62ac6021-7853-43ba-aaaa-15471162f173', 1, now(), null);
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
