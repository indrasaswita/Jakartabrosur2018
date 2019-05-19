<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertJobtypesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
			INSERT INTO jobtypes VALUES( '1', 'Business Equipment', 'Keperluan Kantor', '#5599ff', now(), now() );
			INSERT INTO jobtypes VALUES( '2', 'Promotion Supply', 'Keperluan Pemasaran', '#ff00aa', now(), now() );
			INSERT INTO jobtypes VALUES( '3', 'Promotion Banner', 'Spanduk dan Cetak Ukuran Besar', '#88cc44', now(), now() );
			INSERT INTO jobtypes VALUES( '4', 'Packaging', 'Keperluan Pengemasan', '#00aaaa', now(), now() );
			INSERT INTO jobtypes VALUES( '5', 'Souvenir', 'Cetak Suvenir', '#ff9944', now(), now() );
			INSERT INTO jobtypes VALUES( '6', 'PVC Material & Print', 'Cetak & Bahan PVC', '#aa99bb', now(), now() );
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
