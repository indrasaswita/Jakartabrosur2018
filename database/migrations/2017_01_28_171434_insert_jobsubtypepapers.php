<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertJobsubtypepapers extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
			INSERT INTO `jobsubtypepapers` (`id`, `jobsubtypeID`, `ofdg`, `paperID`, `favourite`, `created_at`, `updated_at`) VALUES
			(1, 1, 1, 1, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(2, 1, 1, 2, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(3, 1, 1, 3, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(4, 1, 1, 4, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(5, 1, 1, 5, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(6, 1, 1, 6, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(7, 1, 1, 7, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(8, 1, 1, 8, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(9, 1, 1, 9, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(10, 1, 1, 10, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(11, 1, 1, 11, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(12, 1, 1, 12, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(13, 1, 2, 3, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(14, 1, 2, 4, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(15, 1, 2, 6, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(16, 1, 2, 7, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(17, 1, 2, 12, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(18, 2, 1, 7, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(19, 2, 1, 8, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(20, 2, 1, 9, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(21, 2, 1, 13, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(22, 2, 1, 14, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(23, 2, 2, 7, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(24, 2, 2, 13, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(25, 2, 2, 14, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(26, 3, 1, 11, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(27, 3, 1, 12, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(28, 3, 1, 16, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(29, 10, 1, 11, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(30, 10, 1, 12, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(31, 10, 2, 12, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(32, 11, 1, 18, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(33, 11, 1, 19, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(34, 11, 1, 20, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(35, 11, 1, 21, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(36, 11, 1, 22, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(37, 13, 1, 31, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(38, 13, 2, 31, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(39, 7, 1, 7, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(40, 7, 1, 13, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(41, 7, 1, 14, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(42, 7, 2, 7, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(43, 7, 2, 13, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(44, 7, 2, 14, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(59, 8, 2, 3, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(60, 8, 2, 4, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(63, 8, 2, 7, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(72, 18, 2, 28, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(73, 18, 2, 29, 1, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(74, 18, 2, 30, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(75, 17, 2, 25, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(76, 17, 2, 26, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(77, 17, 2, 27, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(78, 15, 2, 28, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(79, 15, 2, 29, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(80, 15, 2, 30, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(81, 4, 1, 32, 1, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(82, 4, 1, 34, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(83, 4, 1, 36, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(84, 4, 1, 37, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(85, 4, 1, 38, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(86, 4, 2, 32, 1, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(87, 4, 2, 33, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(89, 4, 2, 35, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(90, 4, 2, 37, 0, '2019-05-22 22:35:14', '2019-05-22 22:35:14'),
			(96, 6, 2, 32, 0, '2019-05-23 00:27:26', '2019-05-23 00:27:26'),
			(100, 9, 1, 10, 0, '2019-05-23 00:30:19', '2019-05-23 00:30:19'),
			(101, 9, 1, 11, 0, '2019-05-23 00:30:19', '2019-05-23 00:30:19'),
			(102, 9, 1, 12, 0, '2019-05-23 00:30:19', '2019-05-23 00:30:19'),
			(103, 7, 1, 5, 0, '2019-05-23 00:31:07', '2019-05-23 00:31:07'),
			(104, 7, 1, 6, 0, '2019-05-23 00:31:07', '2019-05-23 00:31:07'),
			(114, 12, 1, 11, 0, '2019-05-23 15:04:37', '2019-05-23 15:04:37'),
			(115, 12, 1, 12, 0, '2019-05-23 15:04:37', '2019-05-23 15:04:37'),
			(117, 12, 1, 16, 0, '2019-05-23 15:04:37', '2019-05-23 15:04:37'),
			(118, 12, 2, 2, 1, '2019-05-23 15:04:37', '2019-06-03 22:09:07'),
			(119, 12, 2, 3, 0, '2019-05-23 15:04:37', '2019-06-03 22:09:06'),
			(120, 12, 2, 12, 0, '2019-05-23 15:04:37', '2019-05-23 15:04:37'),
			(122, 24, 1, 7, 0, '2019-05-23 15:07:39', '2019-05-23 15:07:39'),
			(123, 24, 1, 8, 0, '2019-05-23 15:07:39', '2019-05-23 15:07:39'),
			(124, 24, 1, 17, 0, '2019-05-23 15:07:39', '2019-05-23 15:07:39'),
			(125, 12, 2, 4, 0, '2019-06-04 05:14:42', '2019-06-04 05:14:42'),
			(126, 12, 2, 7, 0, '2019-06-04 05:14:42', '2019-06-04 05:14:42'),
			(127, 12, 2, 13, 0, '2019-06-04 05:14:42', '2019-06-04 05:14:42'),
			(128, 12, 2, 14, 0, '2019-06-04 05:14:42', '2019-06-04 05:14:42'),
			(129, 3, 1, 1, 0, '2019-06-04 05:17:58', '2019-06-04 05:17:58'),
			(130, 3, 1, 2, 0, '2019-06-04 05:17:58', '2019-06-04 05:17:58'),
			(131, 3, 1, 3, 0, '2019-06-04 05:17:58', '2019-06-04 05:17:58'),
			(132, 3, 2, 2, 0, '2019-06-04 05:17:58', '2019-06-04 05:17:58'),
			(133, 3, 2, 3, 0, '2019-06-04 05:17:58', '2019-06-04 05:17:58'),
			(134, 3, 2, 12, 0, '2019-06-04 05:17:58', '2019-06-04 05:17:58'),
			(135, 5, 2, 39, 0, '2019-06-04 06:18:18', '2019-06-04 06:18:18'),
			(136, 5, 2, 40, 0, '2019-06-04 06:18:18', '2019-06-04 06:18:18'),
			(137, 6, 2, 37, 0, '2019-06-29 13:25:25', NULL),
			(138, 23, 2, 47, 0, '2019-06-29 13:28:18', NULL),
			(139, 23, 2, 48, 0, '2019-06-29 13:28:18', NULL),
			(140, 23, 2, 49, 0, '2019-06-29 13:28:18', NULL),
			(141, 21, 2, 41, 0, '2019-06-29 13:28:47', NULL),
			(142, 21, 2, 42, 0, '2019-06-29 13:28:47', NULL),
			(143, 21, 2, 43, 0, '2019-06-29 13:28:47', NULL),
			(144, 21, 2, 44, 0, '2019-06-29 13:28:47', NULL),
			(145, 21, 2, 45, 0, '2019-06-29 13:28:47', NULL),
			(146, 21, 2, 46, 0, '2019-06-29 13:28:47', NULL);
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
