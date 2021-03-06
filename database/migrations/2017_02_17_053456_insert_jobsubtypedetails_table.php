<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertJobsubtypedetailsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
			INSERT INTO jobsubtypedetails (id, jobsubtypeID, detailname, sizetype, sisicetak, warnacetak, defaultmultip, lockdetailmultip, stepmultip, minmultip, maxmultip, created_at, updated_at) VALUES ('4', '14', 'Cover', '3', '0', '0', '1', '0', '1', '0', '1', now(), now());
			INSERT INTO jobsubtypedetails (id, jobsubtypeID, detailname, sizetype, sisicetak, warnacetak, defaultmultip, lockdetailmultip, stepmultip, minmultip, maxmultip, created_at, updated_at) VALUES ('5', '14', 'Isi', '3', '0', '0', '2', '0', '1', '1', '100', now(), now());
			INSERT INTO jobsubtypedetails (id, jobsubtypeID, detailname, sizetype, sisicetak, warnacetak, defaultmultip, lockdetailmultip, stepmultip, minmultip, maxmultip, created_at, updated_at) VALUES ('6', '14', '', '3', '0', '0', '1', '0', '1', '1', '100', now(), now());
			INSERT INTO jobsubtypedetails (id, jobsubtypeID, detailname, sizetype, sisicetak, warnacetak, defaultmultip, lockdetailmultip, stepmultip, minmultip, maxmultip, created_at, updated_at) VALUES ('1', '19', 'Cover', '3', '0', '0', '1', '0', '1', '0', '1', now(), now());
			INSERT INTO jobsubtypedetails (id, jobsubtypeID, detailname, sizetype, sisicetak, warnacetak, defaultmultip, lockdetailmultip, stepmultip, minmultip, maxmultip, created_at, updated_at) VALUES ('2', '19', 'Isi', '3', '0', '0', '2', '0', '1', '1', '100', now(), now());
			INSERT INTO jobsubtypedetails (id, jobsubtypeID, detailname, sizetype, sisicetak, warnacetak, defaultmultip, lockdetailmultip, stepmultip, minmultip, maxmultip, created_at, updated_at) VALUES ('3', '19', '', '3', '0', '0', '1', '0', '1', '1', '100', now(), now());
			INSERT INTO jobsubtypedetails (id, jobsubtypeID, detailname, sizetype, sisicetak, warnacetak, defaultmultip, lockdetailmultip, stepmultip, minmultip, maxmultip, created_at, updated_at) VALUES ('7', '20', 'Cover', '3', '0', '0', '1', '1', '0', '1', '1', now(), now());
			INSERT INTO jobsubtypedetails (id, jobsubtypeID, detailname, sizetype, sisicetak, warnacetak, defaultmultip, lockdetailmultip, stepmultip, minmultip, maxmultip, created_at, updated_at) VALUES ('8', '20', 'Notes', '3', '0', '0', '100', '0', '1', '2', '1000', now(), now());
			INSERT INTO jobsubtypedetails (id, jobsubtypeID, detailname, sizetype, sisicetak, warnacetak, defaultmultip, lockdetailmultip, stepmultip, minmultip, maxmultip, created_at, updated_at) VALUES ('9', '20', '', '3', '0', '0', '1', '0', '1', '1', '1000', now(), now());
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
