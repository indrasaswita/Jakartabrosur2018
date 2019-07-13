<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsubtypetemplatesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('jobsubtypetemplates', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name', 32);
			$table->string('fullname', 128);
			$table->string('description', 191);
			$table->integer('jobsubtypeID')->unsigned();
			$table->tinyinteger('ofdg');
			$table->integer('paperID')->unsigned();
			$table->integer('sizeID')->unsigned();
			$table->tinyinteger('sideprint');
			$table->string('preview', 64)->nullable();
			$table->string('color', 8)->nullable();
			
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('jobsubtypetemplates');
	}
}
