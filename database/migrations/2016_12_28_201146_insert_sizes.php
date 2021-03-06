<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertSizes extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
			INSERT INTO `sizes` (`id`, `name`, `shortname`, `width`, `length`, `created_at`, `updated_at`) VALUES
				(1, 'A4', NULL, '21.00', '29.70', '2019-06-02 23:59:00', NULL),
				(2, 'A3', NULL, '29.70', '42.00', '2019-06-02 23:59:00', NULL),
				(3, 'A2', NULL, '42.00', '60.00', '2019-06-02 23:59:00', NULL),
				(4, 'A4 eco', NULL, '20.20', '28.60', '2019-06-02 23:59:00', NULL),
				(5, 'A5', NULL, '14.80', '21.00', '2019-06-02 23:59:00', NULL),
				(6, 'A6', NULL, '10.50', '14.80', '2019-06-02 23:59:00', NULL),
				(7, 'F4', NULL, '21.50', '33.00', '2019-06-02 23:59:00', NULL),
				(8, 'B2', NULL, '50.00', '70.70', '2019-06-02 23:59:00', NULL),
				(9, 'B3', NULL, '35.30', '50.00', '2019-06-02 23:59:00', NULL),
				(10, 'B4', NULL, '25.00', '35.30', '2019-06-02 23:59:00', NULL),
				(11, 'sepertiga A4', NULL, '10.00', '21.00', '2019-06-02 23:59:00', NULL),
				(12, 'KN (standard)', NULL, '5.50', '9.00', '2019-06-02 23:59:00', NULL),
				(13, 'KN (kecil)', NULL, '5.00', '9.00', '2019-06-02 23:59:00', NULL),
				(14, 'KN (eu)', NULL, '5.00', '8.50', '2019-06-02 23:59:00', NULL),
				(15, 'ID (standard)', NULL, '5.40', '8.56', '2019-06-02 23:59:00', NULL),
				(16, 'Banner 60', NULL, '60.00', '160.00', '2019-06-02 23:59:00', NULL),
				(17, 'Banner 80', NULL, '80.00', '180.00', '2019-06-02 23:59:00', NULL),
				(18, 'Banner 85', NULL, '85.00', '200.00', '2019-06-02 23:59:00', NULL),
				(19, 'A5 Landscape', NULL, '20.50', '14.50', '2019-06-02 23:59:00', NULL),
				(20, 'A5 Portrait', NULL, '14.50', '20.50', '2019-06-02 23:59:00', NULL),
				(21, 'Square', NULL, '20.00', '20.00', '2019-06-02 23:59:00', NULL),
				(22, 'Double F4', '', '43.00', '33.00', '2019-06-02 17:06:07', '2019-06-02 17:06:07'),
				(23, 'Canvas Tripod: Kecil', '', '40.00', '60.00', '2019-06-02 17:09:26', '2019-06-02 17:09:26'),
				(24, 'Amplop DL (1/3 A4)', '', '11.00', '22.00', '2019-06-02 17:19:34', '2019-06-02 17:19:34'),
				(25, 'Amplop C5 (A5)', '', '11.40', '22.90', '2019-06-02 17:19:34', '2019-06-02 17:19:34'),
				(26, 'Amplop C4 (A4)', '', '22.90', '32.40', '2019-06-02 17:19:34', '2019-06-02 17:19:34'),
				(27, 'Jaya 90', '', '11.00', '23.00', '2019-06-02 17:19:34', '2019-06-02 17:19:34'),
				(28, 'Jaya 110', '', '11.40', '16.20', '2019-06-02 17:19:34', '2019-06-02 17:19:34'),
				(29, 'Jaya 104', '', '9.50', '15.20', '2019-06-02 17:19:34', '2019-06-02 17:19:34'),
				(30, 'Plastik Panitia Sedang (9x13cm)', '', '9.00', '13.00', '2019-06-27 17:19:34', '2019-06-02 17:19:34'),
				(31, 'Plastik Panitia Besar (11x15cm)', '', '11.00', '15.00', '2019-06-27 17:19:34', '2019-06-02 17:19:34'),
				(32, 'Canvas Tripod: Sedang', '', '60.00', '90.00', '2019-07-06 09:25:31', '2019-07-06 09:25:31'),
				(33, 'Canvas Tripod: Besar', '', '90.00', '120.00', '2019-07-06 10:05:48', '2019-07-06 10:05:48'),
				(34, 'Canvas Non-Tripod', '', '120.00', '180.00', '2019-07-06 10:05:48', '2019-07-06 10:05:48');

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
