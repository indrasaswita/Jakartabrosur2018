<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class InsertPapersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
			INSERT INTO `papers` (`id`, `papertypeID`, `name`, `color`, `gramature`, `bothsideprint`, `texture`, `numerator`, `varnish`, `spotuv`, `laminating`, `folding`, `perforation`, `coatingtypeID`, `diecut`, `created_at`, `updated_at`) VALUES
			(1, 1, 'ArtPaper', 'Putih', 100, 0, 1, 0, 0, 0, 0, 1, 1, 1, 0, '2019-07-05 19:14:13', NULL),
			(2, 1, 'ArtPaper', 'Putih', 120, 0, 1, 0, 0, 0, 0, 1, 1, 1, 0, '2019-07-05 19:14:13', NULL),
			(3, 1, 'ArtPaper', 'Putih', 150, 0, 1, 0, 0, 0, 0, 1, 1, 1, 0, '2019-07-05 19:14:13', NULL),
			(4, 2, 'ArtCarton', 'Putih', 190, 0, 1, 0, 1, 1, 1, 1, 1, 1, 0, '2019-07-05 19:14:13', NULL),
			(5, 2, 'ArtCarton', 'Putih', 210, 0, 1, 0, 1, 1, 1, 1, 1, 1, 0, '2019-07-05 19:14:13', NULL),
			(6, 2, 'ArtCarton', 'Putih', 230, 0, 1, 0, 1, 1, 1, 1, 1, 1, 0, '2019-07-05 19:14:13', NULL),
			(7, 2, 'ArtCarton', 'Putih', 260, 0, 1, 0, 1, 1, 1, 1, 1, 1, 0, '2019-07-05 19:14:13', NULL),
			(8, 2, 'ArtCarton', 'Putih', 310, 0, 1, 0, 1, 1, 1, 1, 1, 1, 0, '2019-07-05 19:14:13', NULL),
			(9, 2, 'ArtCarton', 'Putih', 350, 0, 1, 0, 1, 1, 1, 1, 1, 1, 0, '2019-07-05 19:14:13', NULL),
			(10, 3, 'Kertas HVS', 'Putih', 70, 0, 2, 1, 0, 0, 0, 1, 0, 1, 0, '2019-07-05 19:14:13', NULL),
			(11, 3, 'Kertas HVS', 'Putih', 80, 0, 2, 1, 0, 0, 0, 1, 0, 1, 0, '2019-07-05 19:14:13', NULL),
			(12, 3, 'Kertas HVS', 'Putih', 100, 0, 2, 1, 0, 0, 0, 1, 1, 1, 0, '2019-07-05 19:14:13', NULL),
			(13, 4, 'Bluish White (BW)', 'Putih', 250, 0, 0, 0, 0, 1, 1, 0, 0, 1, 0, '2019-07-05 19:14:13', NULL),
			(14, 4, 'Linen', 'Putih', 250, 0, 0, 0, 0, 1, 1, 0, 0, 1, 0, '2019-07-05 19:14:13', NULL),
			(15, 5, 'Samson Kraft Lokal', 'Coklat Tua', 70, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, '2019-07-05 19:14:13', NULL),
			(16, 5, 'Samson Kraft Lokal', 'Coklat Tua', 80, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, '2019-07-05 19:14:13', NULL),
			(17, 5, 'Samson Kraft Lokal', 'Coklat Tua', 280, 0, 0, 0, 0, 1, 1, 0, 0, 1, 0, '2019-07-05 19:14:13', NULL),
			(18, 6, 'Kertas HVS NCR', 'Putih', 60, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, '2019-07-05 19:14:13', NULL),
			(19, 6, 'Kertas HVS NCR', 'Merah', 60, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, '2019-07-05 19:14:13', NULL),
			(20, 6, 'Kertas HVS NCR', 'Kuning', 60, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, '2019-07-05 19:14:13', NULL),
			(21, 6, 'Kertas HVS NCR', 'Biru', 60, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, '2019-07-05 19:14:13', NULL),
			(22, 6, 'Kertas HVS NCR', 'Hijau', 60, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, '2019-07-05 19:14:13', NULL),
			(23, 3, 'Concorde', 'Putih', 90, 0, 2, 1, 0, 0, 0, 1, 0, 1, 0, '2019-07-05 19:14:13', NULL),
			(24, 3, 'Concorde', 'Ivory', 90, 0, 2, 1, 0, 0, 0, 1, 0, 1, 0, '2019-07-05 19:14:13', NULL),
			(25, 7, 'Flexy China Murni, Ketebalan: Sedang', 'Putih', 300, 1, 3, 0, 0, 1, 1, 0, 0, 1, 0, '2019-11-16 02:45:08', '2019-06-07 22:00:25'),
			(26, 7, 'Flexy China Murni, Ketebalan: Tipis', 'Putih', 270, 1, 3, 0, 0, 1, 1, 0, 0, 1, 0, '2019-11-16 02:45:08', '2019-06-07 22:00:21'),
			(27, 7, 'Flexy Korea 440g Haleed', 'Putih', 0, 1, 3, 0, 0, 0, 0, 0, 0, 1, 0, '2019-11-16 02:45:08', '2019-06-07 22:00:17'),
			(28, 9, 'Albatros', 'Putih', 0, 1, 2, 0, 0, 0, 0, 0, 0, 1, 0, '2019-11-16 02:45:08', '2019-06-07 22:00:13'),
			(29, 9, 'Luster', 'Putih', 0, 1, 3, 0, 0, 0, 0, 0, 0, 1, 0, '2019-11-16 02:45:08', '2019-06-07 22:00:06'),
			(30, 9, 'Flexy Korea 330g Grayback', 'Putih', 0, 1, 3, 0, 0, 0, 0, 0, 0, 1, 0, '2019-11-16 02:45:08', '2019-06-07 22:00:04'),
			(31, 8, 'PVC Plastic 0.8mm', 'Putih', 0, 0, 1, 0, 0, 0, 0, 0, 0, 1, 0, '2019-11-16 02:45:08', '2019-06-07 21:59:57'),
			(32, 10, 'Sticker Cromo', 'Putih', 403, 1, 1, 0, 0, 1, 1, 0, 0, 1, 0, '2019-11-16 02:45:08', '2019-06-07 21:59:53'),
			(33, 10, 'Sticker Vinyl Digital', 'Putih', 463, 1, 1, 0, 0, 1, 1, 0, 0, 1, 0, '2019-11-16 02:45:08', '2019-06-07 21:59:42'),
			(34, 10, 'Sticker Vinyl Premium', 'Putih', 0, 1, 1, 0, 0, 0, 0, 0, 0, 1, 0, '2019-11-16 02:45:08', '2019-06-07 21:59:40'),
			(35, 10, 'Sticker Transp Digital', 'Transparent', 488, 1, 1, 0, 0, 1, 1, 0, 0, 1, 0, '2019-11-16 02:45:08', '2019-06-07 21:59:39'),
			(36, 10, 'Sticker Transp Premium', 'Transparent', 0, 1, 1, 0, 0, 0, 0, 0, 0, 1, 0, '2019-11-16 02:45:08', '2019-06-07 21:59:37'),
			(37, 10, 'Sticker HVS', 'Putih', 325, 1, 2, 0, 0, 1, 1, 0, 0, 1, 0, '2019-11-16 02:45:08', '2019-06-07 21:59:28'),
			(38, 10, 'Sticker Cromo Premium', '', 420, 1, 1, 0, 0, 1, 1, 0, 0, 1, 0, '2019-11-16 02:45:08', '2019-06-07 21:59:25'),
			(39, 10, 'Sticker Cutting Non-Reflective', '', 420, 1, 1, 0, 0, 1, 1, 0, 0, 1, 0, '2019-11-16 02:45:08', '2019-06-07 21:59:12'),
			(40, 10, 'Sticker Cutting Reflective', '', 420, 1, 1, 0, 0, 1, 1, 0, 0, 1, 0, '2019-11-16 02:45:08', '2019-06-07 21:59:10'),
			(41, 11, 'Pulpen Kapsul', 'Custom', 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, '2019-06-07 21:43:19', '2019-06-07 21:44:55'),
			(42, 11, 'Pulpen Bertutup Dengan Tali', 'Custom', 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, '2019-06-07 21:43:20', '2019-06-07 21:44:58'),
			(43, 11, 'Pulpen Bertutup Tanpa Tali', 'Custom', 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, '2019-06-07 21:43:21', '2019-06-07 21:45:00'),
			(44, 11, 'Pulpen Click Panjang Plastik', 'Custom', 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, '2019-06-07 21:43:22', '2019-06-07 21:45:02'),
			(45, 11, 'Pulpen Click Pendek Dengan Tali', 'Custom', 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, '2019-06-07 21:43:24', '2019-06-07 21:45:05'),
			(46, 11, 'Pulpen Click Pendek Tanpa Tali', 'Custom', 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, '2019-06-07 21:43:25', '2019-06-07 21:45:08'),
			(47, 11, 'Bulat Plastik + Pembuka Botol', 'Custom', 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, '2019-06-07 21:54:38', '2019-06-07 21:58:33'),
			(48, 11, 'Bulat Plastik 2 sisi', 'Custom', 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, '2019-06-07 21:54:41', '2019-06-07 21:58:36'),
			(49, 11, 'Bulat Plastik + Cermin', 'Custom', 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, '2019-06-07 21:54:43', '2019-06-07 21:58:40'),
			(50, 3, 'Amplop Jaya 90', 'Putih', 0, 1, 2, 1, 0, 0, 0, 1, 0, 1, 0, '2019-06-07 21:58:17', '2019-06-07 21:58:58'),
			(51, 3, 'Amplop Jaya 104', 'Putih', 0, 1, 2, 1, 0, 0, 0, 1, 0, 1, 0, '2019-06-07 21:58:18', '2019-06-07 21:58:59'),
			(52, 3, 'Amplop Jaya 110', 'Putih', 0, 1, 2, 1, 0, 0, 0, 1, 0, 1, 0, '2019-06-07 21:58:19', '2019-06-07 21:59:01'),
			(53, 12, 'Otomatis Tanpa Bak Tinta', 'Custom', 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, '2019-06-07 21:58:19', '2019-06-07 21:59:01'),
			(54, 9, 'Canvas Premium Ecosolvent', 'Ivory', 450, 1, 1, 0, 0, 1, 1, 0, 0, 1, 0, '2019-07-05 12:17:48', '2019-07-05 12:18:04'),
			(55, 9, 'Satin Economy Ecosolvent', 'Putih', 250, 1, 1, 0, 0, 1, 1, 0, 0, 1, 0, '2019-07-05 12:20:27', '2019-07-05 12:20:36'),
			(56, 7, 'Flexy China Murni, Ketebalan: Tebal', 'Putih', 340, 1, 3, 0, 0, 1, 1, 0, 0, 1, 0, '2019-11-16 02:45:08', '2019-06-07 22:00:21'),
			(57, 7, 'Flexy China KW, Ketebalan: Tipis', 'Putih', 280, 1, 3, 0, 0, 1, 1, 0, 0, 1, 0, '2019-11-16 02:45:08', '2019-06-07 22:00:21'),
			(58, 1, 'e-money blank card', 'white', 0, 2, 1, 0, 0, 0, 0, 1, 1, 1, 0, '2019-11-09 12:20:22', '2019-11-09 12:20:36'),
			(59, 1, 'flazz blank card', 'white', 0, 1, 1, 0, 0, 0, 0, 1, 1, 1, 0, '2019-11-09 12:20:23', '2019-11-09 12:20:37'),
			(60, 1, 'brizzi blank card', 'white', 0, 2, 1, 0, 0, 0, 0, 1, 1, 1, 0, '2019-11-09 12:20:23', '2019-11-09 12:20:38');

			UPDATE papers
				SET numerator = 1
				WHERE papertypeID = 3;

			UPDATE papers
				SET folding = 1
				WHERE papertypeID <= 3;

			UPDATE papers
				SET laminating = 1
				WHERE gramature > 150;

			UPDATE papers
				SET spotuv = 1
				WHERE laminating = 1;

			UPDATE papers
				SET varnish = 1
				WHERE papertypeID = 2;

			UPDATE papers
				SET texture = 1
				WHERE papertypeID <= 2;

			UPDATE papers
				SET texture = 2
				WHERE papertypeID = 3;

			UPDATE papers
				SET perforation = 1
				WHERE papertypeID = 3 AND gramature = 100;

			UPDATE papers
				SET perforation = 1
				WHERE papertypeID = 2 OR papertypeID = 1;
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
