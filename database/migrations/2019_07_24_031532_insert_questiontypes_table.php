<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertQuestiontypesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
		INSERT INTO questiontypes(name, created_at, updated_at) VALUES('Upload File', now(), null);
		INSERT INTO questiontypes(name, created_at, updated_at) VALUES('Pembayaran', now(), null);
		INSERT INTO questiontypes(name, created_at, updated_at) VALUES('Jenis Cetakan', now(), null);
		INSERT INTO questiontypes(name, created_at, updated_at) VALUES('Bahan', now(), null);       
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
