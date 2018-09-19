<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertJobsubtypedetailpapersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
			INSERT INTO jobsubtypedetailpapers VALUES('1', '1', '1', '3', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('2', '1', '1', '4', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('3', '1', '1', '5', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('4', '1', '1', '6', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('5', '1', '1', '7', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('6', '1', '1', '8', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('7', '1', '1', '9', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('8', '1', '1', '12', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('9', '1', '1', '13', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('10', '1', '1', '14', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('11', '1', '1', '17', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('12', '2', '1', '1', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('13', '2', '1', '2', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('14', '2', '1', '3', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('15', '2', '1', '4', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('16', '2', '1', '10', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('17', '2', '1', '11', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('18', '2', '1', '12', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('19', '2', '1', '15', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('20', '2', '1', '16', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('21', '2', '1', '23', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('22', '2', '1', '24', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('23', '3', '1', '1', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('24', '3', '1', '2', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('25', '3', '1', '3', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('26', '3', '1', '4', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('27', '3', '1', '5', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('28', '3', '1', '6', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('29', '3', '1', '7', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('30', '3', '1', '8', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('31', '3', '1', '9', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('32', '3', '1', '10', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('33', '3', '1', '11', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('34', '3', '1', '12', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('35', '3', '1', '13', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('36', '3', '1', '14', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('37', '3', '1', '15', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('38', '3', '1', '16', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('39', '3', '1', '17', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('40', '3', '1', '23', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('41', '3', '1', '24', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('42', '1', '2', '3', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('43', '1', '2', '4', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('44', '1', '2', '7', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('45', '1', '2', '12', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('46', '1', '2', '13', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('47', '1', '2', '14', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('48', '2', '2', '2', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('49', '2', '2', '3', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('50', '2', '2', '4', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('51', '2', '2', '12', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('52', '2', '2', '13', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('53', '2', '2', '14', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('54', '2', '2', '23', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('55', '2', '2', '24', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('56', '3', '2', '2', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('57', '3', '2', '3', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('58', '3', '2', '4', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('59', '3', '2', '12', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('60', '3', '2', '13', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('61', '3', '2', '14', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('62', '3', '2', '23', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('63', '3', '2', '24', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('64', '4', '1', '5', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('65', '4', '1', '6', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('66', '4', '1', '7', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('67', '4', '1', '8', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('68', '4', '1', '9', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('69', '4', '1', '13', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('70', '4', '1', '14', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('71', '5', '1', '5', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('72', '5', '1', '6', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('73', '5', '1', '7', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('74', '5', '1', '8', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('75', '5', '1', '9', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('76', '5', '1', '13', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('77', '5', '1', '14', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('78', '6', '1', '1', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('79', '6', '1', '2', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('80', '6', '1', '3', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('81', '6', '1', '4', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('82', '6', '1', '5', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('83', '6', '1', '6', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('84', '6', '1', '7', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('85', '6', '1', '8', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('86', '6', '1', '9', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('87', '6', '1', '10', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('88', '6', '1', '11', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('89', '6', '1', '12', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('90', '6', '1', '13', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('91', '6', '1', '14', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('92', '6', '1', '15', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('93', '6', '1', '16', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('94', '6', '1', '23', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('95', '6', '1', '24', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('96', '4', '2', '4', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('97', '4', '2', '7', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('98', '4', '2', '13', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('99', '4', '2', '14', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('100', '5', '2', '4', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('101', '5', '2', '7', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('102', '5', '2', '13', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('103', '5', '2', '14', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('104', '6', '2', '2', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('105', '6', '2', '3', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('106', '6', '2', '4', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('107', '6', '2', '7', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('108', '6', '2', '13', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('109', '6', '2', '14', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('110', '6', '2', '12', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('111', '7', '1', '7', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('112', '8', '1', '12', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('113', '9', '1', '10', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('114', '9', '1', '11', now(), now());
			INSERT INTO jobsubtypedetailpapers VALUES('115', '9', '1', '12', now(), now());
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
