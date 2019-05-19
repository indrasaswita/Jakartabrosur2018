<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertFilesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
			INSERT INTO `files` (`customerID`, `filename`, `size`, `detail`, `revision`, `preview`, `path`, `icon`, `created_at`, `updated_at`) VALUES ('1', 'background autumn', '2048', '', '1', '', 'images/original/background.jpg', 'images/icon/background.jpg', now(), now());
			INSERT INTO `files` (`customerID`, `filename`, `size`, `detail`, `revision`, `preview`, `path`, `icon`, `created_at`, `updated_at`) VALUES ('2', 'HAHAHA Hello World', '1029', '', '1', '', 'images/original/img-20160523-wa0004.jpg', 'images/icon/img-20160523-wa0004.jpg', now(), now());
			INSERT INTO `files` (`customerID`, `filename`, `size`, `detail`, `revision`, `preview`, `path`, `icon`, `created_at`, `updated_at`) VALUES ('1', 'Landak Kewong', '1298', '', '1', '', 'images/original/img20170619101804620.jpg', 'images/icon/img20170619101804620.jpg', now(), now());
			INSERT INTO `files` (`customerID`, `filename`, `size`, `detail`, `revision`, `preview`, `path`, `icon`, `created_at`, `updated_at`) VALUES ('1', 'Ultah September', '20', '', '1', '', 'images/original/img-20160527-wa0004.jpg', 'images/icon/img-20160527-wa0004.jpg', now(), now());
			INSERT INTO `files` (`customerID`, `filename`, `size`, `detail`, `revision`, `preview`, `path`, `icon`, `created_at`, `updated_at`) VALUES ('1', 'Buku Kuda Liar', '12000', '', '1', '', 'images/original/img20170502121948903.jpg', 'images/icon/img20170502121948903.jpg', now(), now());
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
