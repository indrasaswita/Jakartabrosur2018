<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestiontypesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
		 	CREATE TABLE questiontypes(
				 id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
				 name VARCHAR(100) NOT NULL,
				 created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
				 updated_at TIMESTAMP NULL 
			);
		");
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists("questiontypes");
	}
}
