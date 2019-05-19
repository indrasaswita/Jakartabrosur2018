<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSitemapTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
			CREATE TABLE sitemaps(
				id INT PRIMARY KEY AUTO_INCREMENT,
				name VARCHAR(128) NOT NULL,
				loc VARCHAR(255) NOT NULL,
				chfreq TINYINT DEFAULT 5 COMMENT '0:always,1:hourly,2:daily,3:weekly,4:monthly,5:yearly,6:never',
				prio TINYINT DEFAULT 0,
				created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
				updated_at TIMESTAMP NULL
			);

			INSERT INTO sitemaps VALUES ('0', 'Landing Page', '', '3', '10', now(), now());
			INSERT INTO sitemaps VALUES ('0', 'Order', 'orderlistcustomer', '4', '8', now(), now());
			INSERT INTO sitemaps VALUES ('0', 'Order Flyer', 'shop/flyer', '5', '6', now(), now());
			INSERT INTO sitemaps VALUES ('0', 'Order Business Card', 'shop/businesscard', '0', '6', now(), now());
			INSERT INTO sitemaps VALUES ('0', 'Order Letterhead', 'shop/letterhead', '0', '6', now(), now());
			INSERT INTO sitemaps VALUES ('0', 'Order X-Banner', 'shop/xbanner', '0', '6', now(), now());
			INSERT INTO sitemaps VALUES ('0', 'Order Roll-up Banner', 'shop/rollupbanner', '0', '6', now(), now());
			INSERT INTO sitemaps VALUES ('0', 'Order Indoor Banner', 'shop/simplebannerindoor', '0', '6', now(), now());
			INSERT INTO sitemaps VALUES ('0', 'Order Outdoor Banner', 'shop/simplebanneroutdoor', '0', '6', now(), now());
			INSERT INTO sitemaps VALUES ('0', 'Log-In', 'login', '6', '8', now(), now());
			INSERT INTO sitemaps VALUES ('0', 'Sign-Up', 'signup', '6', '8', now(), now());
		");
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('sitemaps');
	}
}
