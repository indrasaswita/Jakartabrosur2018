<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsubtypesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
			CREATE TABLE jobsubtypes (
				id INT UNSIGNED AUTO_INCREMENT,
				jobtypeID INT UNSIGNED,
				name VARCHAR(32),
				printtype VARCHAR(8),
				subname VARCHAR(64),
				description VARCHAR(255),
				link VARCHAR(32),
				digitaloffset TINYINT,
				minoffset INT,
				maxoffset INT,
				stepoffset INT,
				defaultoffset INT,
				mindigital INT,
				maxdigital INT,
				stepdigital INT,
				defaultdigital INT,
				satuan VARCHAR(32),
				infoqty VARCHAR(511),
				infosize VARCHAR(511),
				infomaterial VARCHAR(511),
				infosisicetak VARCHAR(511),
				infowarnacetak VARCHAR(511),
				infoproses VARCHAR(511),
				infodelivery VARCHAR(511),
				infoperbungkus VARCHAR(511),
				inforeseller VARCHAR(511),
				infosponsor VARCHAR(511),
				qtyoffsettype TINYINT,
				qtydigitaltype TINYINT,
				sizetype TINYINT,
				sisicetak TINYINT,
				warnacetak TINYINT,
				stdoffset TINYINT,
				expoffset TINYINT,
				stddigital TINYINT,
				expdigital TINYINT,
				numerator TINYINT,
				idcard TINYINT,
				rangkap TINYINT,
				active TINYINT,
				icon VARCHAR(128) DEFAULT '',
				sicon1 VARCHAR(128) DEFAULT '',
				sicon2 VARCHAR(128) DEFAULT '',
				printerIDoffset INT UNSIGNED NOT NULL,
				printerIDdigital INT UNSIGNED NOT NULL,
				created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
				updated_at TIMESTAMP NULL,
				PRIMARY KEY (id)
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
		DB::unprepared("		
			DROP TABLE IF EXISTS jobsubtypes;
		");
	}
}
