<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertFinishings extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
			INSERT INTO `finishings` (`id`, `name`, `shortname`, `info`, `status`, `mingram`, `maxgram`, `created_at`, `updated_at`) VALUES
				(1, 'Coating', 'Dilapis', 'Matte: permukaan tidak mengkilap (<b>lebih elegan</b>)<br>Glossy: permukaan mengkilap (<b>menarik perhatian</b>)', 1, 150, 350, '2019-06-09 03:46:20', '2019-06-09 03:46:20'),
				(2, 'Hot Stamp', 'Emboss / Deboss', 'Area yang dianggap penting dibuat 3 dimensi, sehingga lebih hidup dan indah ketika dilihat.<br><br>Note: sertakan juga file emboss secara terpisah dalam bentuk vector.', 1, 190, 350, '2019-06-09 03:46:20', '2019-06-09 03:46:20'),
				(3, 'Hot Foil', 'Poly', 'Dibuat mengkilap, sehingga lebih bersinar ketika dilihat.<br><br>Note: sertakan juga file poly secara terpisah dalam bentuk vector.', 1, 120, 350, '2019-06-09 03:46:20', '2019-06-09 03:46:20'),
				(4, 'Hole Punch', 'Lubang Filing', 'Untuk filing pada map file, kertas dilobangi bagian sebelah kiri.', 1, 80, 350, '2019-06-09 03:46:20', '2019-06-09 03:46:20'),
				(5, 'Hoek', 'Lengkung Sudut', 'Lengkung pada sudut menambah estetika pada beberapa cetakan Anda.', 1, 190, 310, '2019-06-09 03:46:20', '2019-06-09 03:46:20'),
				(6, 'Perforation', 'Perforasi', 'Dalam file harus diletakan garis perforasi dalam bentuk garis TITIK-TITIK (<b>dan dalam bentuk yang bisa diedit</b>) sehingga kami dapat menghilangkan garis tersebut, ketika pencetakan.', 1, 100, 150, '2019-06-09 03:46:20', '2019-06-09 03:46:20'),
				(7, 'Folding', 'Lipat', 'Dihitung dari jumlah lipatan ketika dibentangkan. Harga lipat, bisa berubah sewaktu-waktu dan kami akan memberitahu sesegera mungkin setelah pesanan dibuat.', 1, 70, 150, '2019-06-09 03:46:20', '2019-06-09 03:46:20'),
				(8, 'Cutting', 'Potong', 'Letakan file diecut secara terpisah dengan file cetak. <br><br>Garis SOLID: untuk potongan.<br>Garis TITIK-TITIK: untuk tekukan.', 1, 0, 0, '2019-06-09 03:46:20', '2019-06-09 03:46:20'),
				(9, 'Pacthing', 'Lem & Tempel', 'Sertakan keterangan tempel. Harga akan disesuaikan setelah kami mendownload file Anda.', 1, 0, 0, '2019-06-09 03:46:20', '2019-06-09 03:46:20'),
				(10, 'Inserting & Sorting', 'Sisip & Susun', 'Jasa penyusunan dan penyisipan lembaran ke cetakan lainnya.', 1, 0, 0, '2019-06-09 03:46:20', '2019-06-09 03:46:20'),
				(11, 'Numeration', 'Numerasi', 'File design wajib <b>terpisah</b> dengan nomor, dan buat numerasi pada excel.<br><br>Akan dicetak manual setelah pencetakan Offset selesai.', 1, 0, 0, '2019-06-09 03:46:20', '2019-06-09 03:46:20'),
				(12, 'Perfect Binding', 'Lem Panas + Jahit', 'Penyusunan buku disebaiknya ditanyakan dulu kepada pihak kami.', 1, 0, 0, '2019-06-09 03:46:20', '2019-06-09 03:46:20'),
				(13, 'Spiral Binding', 'Jilid Spiral Besi', 'Berbahan besi dan bisa dibuka hingga 360 derajat.', 1, 0, 0, '2019-06-09 03:46:20', '2019-06-09 03:46:20'),
				(14, 'Manual Binding (Glue)', 'Jilid Lem Manual', 'Lem pada salah satu sisi, memungkinkan untuk melepas kertasnya dengan mudah saat diperlukan.', 1, 0, 0, '2019-06-09 03:46:20', '2019-06-09 03:46:20'),
				(15, 'Coating', 'Dilapis', 'Matte: permukaan tidak mengkilap (<b>lebih elegan</b>)<br>Glossy: permukaan mengkilap (<b>menarik perhatian</b>)', 1, 0, 0, '2019-06-09 03:46:20', '2019-06-09 03:46:20'),
				(16, 'Hole Punch', 'Lubang Filing', 'Untuk filing pada map file, kertas dilobangi bagian sebelah kiri.', 1, 0, 0, '2019-06-09 03:46:20', '2019-06-09 03:46:20'),
				(17, 'Hoek', 'Lengkung Sudut', 'Lengkung pada sudut menambah estetika pada beberapa cetakan Anda.', 1, 0, 0, '2019-06-09 03:46:20', '2019-06-09 03:46:20'),
				(18, 'Perforation', 'Perforasi', 'Dalam file harus diletakan garis perforasi dalam bentuk garis TITIK-TITIK (<b>dan dalam bentuk yang bisa diedit</b>) sehingga kami dapat menghilangkan garis tersebut, ketika pencetakan.', 1, 0, 0, '2019-06-09 03:46:20', '2019-06-09 03:46:20'),
				(19, 'Folding', 'Lipat', 'Dihitung dari jumlah lipatan ketika dibentangkan. Harga lipat, bisa berubah sewaktu-waktu dan kami akan memberitahu sesegera mungkin setelah pesanan dibuat.', 1, 0, 0, '2019-06-09 03:46:20', '2019-06-09 03:46:20'),
				(20, 'Cutting', 'Potong', 'Letakan file diecut secara terpisah dengan file cetak. <br><br>Garis SOLID: untuk potongan.<br>Garis TITIK-TITIK: untuk tekukan.', 1, 0, 0, '2019-06-09 03:46:20', '2019-06-09 03:46:20'),
				(21, 'Pacthing', 'Lem & Tempel', 'Sertakan keterangan tempel. Harga akan disesuaikan setelah kami mendownload file Anda.', 1, 0, 0, '2019-06-09 03:46:20', '2019-06-09 03:46:20'),
				(22, 'Inserting & Sorting', 'Sisip & Susun', 'Jasa penyusunan dan penyisipan lembaran ke cetakan lainnya.', 1, 0, 0, '2019-06-09 03:46:20', '2019-06-09 03:46:20'),
				(23, 'Numeration Print', 'Numerasi Print', 'File design wajib <b>terpisah</b> dengan nomor, dan buat numerasi pada excel.<br><br>Akan disertakan dalam pencetakan, juga bisa dapat berupa nama atau alamat yang berbeda-beda.', 1, 0, 0, '2019-06-09 03:46:20', '2019-06-09 03:46:20'),
				(24, 'Spiral Binding', 'Jilid Spiral Besi', 'Jilid SPIRAL: berbahan besi dan bisa dibuka hingga 360 derajat.<br><br>Jilid KAWAT: dijilid dari bagian tengah buku.', 1, 0, 0, '2019-06-09 03:46:20', '2019-06-09 03:46:20'),
				(25, 'Manual Binding (Glue)', 'Jilid Lem Manual', 'Lem pada salah satu sisi, memungkinkan untuk melepas kertasnya dengan mudah saat diperlukan. Pada perforasi, kami akan melakukan penjahitan kawat pada sisi yang terjilid, memungkinkan Anda untuk menyobek kertas saat diperlukan.', 1, 0, 0, '2019-06-09 03:46:20', '2019-06-09 03:46:20'),
				(26, 'Coating', 'Dilapis', 'Matte: permukaan tidak mengkilap (<b>lebih elegan</b>)<br>Glossy: permukaan mengkilap (<b>menarik perhatian</b>)', 1, 0, 0, '2019-06-09 03:46:20', '2019-06-09 03:46:20'),
				(27, 'Cutting', 'Potong', 'Potongan banner pengaruh akan hasil akhir, mohon disertakan bila ada permintaan khusus.', 1, 0, 0, '2019-06-09 03:46:20', '2019-06-09 03:46:20'),
				(28, 'Standing', 'Kaki Banner', 'Simple untuk dilipat dan dijinjing untuk dibawa menuju pameran.', 1, 0, 0, '2019-06-09 03:46:20', '2019-06-09 03:46:20'),
				(29, 'Canvas Board + Stand', 'Papan Canvas + Kaki', 'Pilihan termasuk papan dan kaki canvas, permintaan khusus tolong disertakan pada kolom keterangan.', 1, 0, 0, '2019-06-09 03:46:20', '2019-06-09 03:46:20'),
				(30, 'Tripod Board', 'Papan Tripod', 'Pilihan untuk papan dibelakang sticker yang akan menyanggah diatas kaki tripod', 1, 0, 0, '2019-06-09 03:46:20', '2019-06-09 03:46:20'),
				(31, 'Poster Board', 'Papan Poster', 'Bahan mika seperti kaca untuk ditempel pada dinding. Tanpa lampu.', 0, 0, 0, '2019-06-09 03:46:20', '2019-06-09 03:46:20'),
				(32, 'Press', 'Press', 'Jasa pembuatan kartu standard.', 1, 0, 0, '2019-06-09 03:46:20', '2019-06-09 03:46:20'),
				(33, 'Numeration', 'Numerasi', 'Jasa penomoran kartu.', 0, 0, 0, '2019-06-09 03:46:20', '2019-06-09 03:46:20'),
				(34, 'Magnetic Stripe', 'Pita Magnetik', 'Jasa pembuatan kartu magnetik.', 0, 0, 0, '2019-06-09 03:46:20', '2019-06-09 03:46:20'),
				(35, 'Calendar Board', 'Kaki Kalender', 'Kaki kalender meja, berbentuk prisma dengan jilid spiral diatasnya.', 1, 0, 0, '2019-06-09 03:46:20', '2019-06-09 03:46:20'),
				(36, 'Stamp Color', 'Warna Tinta', 'Warna utama stempel', 1, 0, 0, '2019-06-09 03:46:20', '2019-06-09 03:46:20'),
				(37, 'Stamp Color 2', 'Warna Tinta 2', 'Warna kedua stempel', 1, 0, 0, '2019-06-09 03:46:20', '2019-06-09 03:46:20'),
				(38, 'Stamp Color 3', 'Warna Tinta 3', 'Warna ketiga stempel', 1, 0, 0, '2019-06-09 03:46:20', '2019-06-09 03:46:20'),
				(39, 'Tripod Stand', 'Kaki Tripod', 'Stand banner 90 derajat permukaan tanah, dengan kaki 3 yang memungkinkan dilihat pada kedua sisi.', 1, 0, 0, '2019-06-09 03:46:20', '2019-06-09 03:46:20'),
				(40, 'Thin Book Binding', 'Jilid Kawat', 'Dijilid dari bagian tengah buku, pada posisi terbuka.', 1, 0, 0, '2019-06-09 03:46:20', '2019-06-09 03:46:20'),
				(41, 'Thin Book Binding', 'Jilid Kawat', 'Dijilid dari bagian tengah buku, pada posisi terbuka.', 1, 0, 0, '2019-06-09 03:46:20', '2019-06-09 03:46:20'),
				(42, 'Plastik Kartu', 'Plastic', 'Plastik bungkus untuk kartu panitia, kartu anggota, atau kartu member. Plastik transparan, yang cukup tebal dan lentur. Note: hanya plastik belum termasuk tali.', 1, 0, 350, '2019-06-29 14:43:11', NULL),
				(43, 'Tali ID Card', 'Tali', 'Tali untuk dipasangkan ke plastik member card atau id card. Tali berbahan nylon cukup tebal. Note: hanya tali, belum termasuk plastik.', 1, 0, 350, '2019-06-29 14:45:32', NULL);
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
