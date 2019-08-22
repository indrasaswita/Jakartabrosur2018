<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertCartheadersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
			INSERT INTO cartheaders VALUES ('1', '1', '2', 'ClubMed', '10', 'box', 'nanti diambil setelah makan siang', 'file 1 untuk sisi belakang, file 2 untuk sisi depan, nama di excel', '', '', '', '200000', '250000', '0', '0', 'std', '2', '1', '', '0', '1', '5', '1', now(), now(), null);
			INSERT INTO cartheaders VALUES ('2', '2', '1', 'ClubMed HSBC', '2500', 'lembar', 'dibungkus dengan plastik', '', '', '', '', '1500000', '1800000', '35000', '0', 'exp', '3', '2', 'Jl. Karang Anyar 1', '0', '5', '20', '0', now(), now(), null);
			INSERT INTO cartheaders VALUES ('3', '1', '1', 'Booklet KIA', '2500', 'lembar', 'jilid staples 2 mata', '', '', '', '', '5000000', '6000000', '135000', '100000', 'std', '7', '2', 'Jl. Karang Anyar 1', '1', '40', '100', '1', now(), now(), null);
			INSERT INTO cartheaders VALUES ('4', '1', '2', 'Booklet KIA Ramadhan Biru Kuning', '2050500', 'lembar', 'jilid staples 2 mata', '', '', '', '', '50000000', '60000000', '1350000', '100000', 'std', '7', '2', 'Jl. Karang Anyar 1', '1', '40', '100', '1', now(), now(), null);
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
