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
			INSERT INTO finishings(name, shortname, ofdg, info, status, mingram, maxgram, created_at, updated_at) VALUES ('Coating', 'Dilapis', '1', 'Matte: permukaan tidak mengkilap (<b>lebih elegan</b>)<br>Glossy: permukaan mengkilap (<b>menarik perhatian</b>)', '1', '150', '350', now(), now());
			INSERT INTO finishings(name, shortname, ofdg, info, status, mingram, maxgram, created_at, updated_at) VALUES ('Hot Stamp', 'Emboss / Deboss', '1', 'Area yang dianggap penting dibuat 3 dimensi, sehingga lebih hidup dan indah ketika dilihat.<br><br>Note: sertakan juga file emboss secara terpisah dalam bentuk vector.', '1', '190', '350', now(), now());
			INSERT INTO finishings(name, shortname, ofdg, info, status, mingram, maxgram, created_at, updated_at) VALUES ('Hot Foil', 'Poly', '1', 'Dibuat mengkilap, sehingga lebih bersinar ketika dilihat.<br><br>Note: sertakan juga file poly secara terpisah dalam bentuk vector.', '1', '120', '350', now(), now());
			INSERT INTO finishings(name, shortname, ofdg, info, status, mingram, maxgram, created_at, updated_at) VALUES ('Hole Punch', 'Lubang Filing', '1', 'Untuk filing pada map file, kertas dilobangi bagian sebelah kiri.', '1', '80', '350', now(), now());
			INSERT INTO finishings(name, shortname, ofdg, info, status, mingram, maxgram, created_at, updated_at) VALUES ('Hoek', 'Lengkung Sudut', '1', 'Lengkung pada sudut menambah estetika pada beberapa cetakan Anda.', '1', '190', '310', now(), now());
			INSERT INTO finishings(name, shortname, ofdg, info, status, mingram, maxgram, created_at, updated_at) VALUES ('Perforation', 'Perforasi', '1', 'Dalam file harus diletakan garis perforasi dalam bentuk garis TITIK-TITIK (<b>dan dalam bentuk yang bisa diedit</b>) sehingga kami dapat menghilangkan garis tersebut, ketika pencetakan.', '1', '100', '150', now(), now());
			INSERT INTO finishings(name, shortname, ofdg, info, status, mingram, maxgram, created_at, updated_at) VALUES ('Folding', 'Lipat', '1', 'Dihitung dari jumlah lipatan ketika dibentangkan. Harga lipat, bisa berubah sewaktu-waktu dan kami akan memberitahu sesegera mungkin setelah pesanan dibuat.', '1', '70', '150', now(), now());
			INSERT INTO finishings(name, shortname, ofdg, info, status, mingram, maxgram, created_at, updated_at) VALUES ('Cutting', 'Potong', '1', 'Letakan file diecut secara terpisah dengan file cetak. <br><br>Garis SOLID: untuk potongan.<br>Garis TITIK-TITIK: untuk tekukan.', '1', '0', '0', now(), now());
			INSERT INTO finishings(name, shortname, ofdg, info, status, mingram, maxgram, created_at, updated_at) VALUES ('Pacthing', 'Lem & Tempel', '1', 'Sertakan keterangan tempel. Harga akan disesuaikan setelah kami mendownload file Anda.', '1', '0', '0', now(), now());
			INSERT INTO finishings(name, shortname, ofdg, info, status, mingram, maxgram, created_at, updated_at) VALUES ('Inserting & Sorting', 'Sisip & Susun', '1', 'Jasa penyusunan dan penyisipan lembaran ke cetakan lainnya.', '1', '0', '0', now(), now());
			INSERT INTO finishings(name, shortname, ofdg, info, status, mingram, maxgram, created_at, updated_at) VALUES ('Numeration', 'Numerasi', '1', 'File design wajib <b>terpisah</b> dengan nomor, dan buat numerasi pada excel.<br><br>Akan dicetak manual setelah pencetakan Offset selesai.', '1', '0', '0', now(), now());
			INSERT INTO finishings(name, shortname, ofdg, info, status, mingram, maxgram, created_at, updated_at) VALUES ('Perfect Binding', 'Lem Panas + Jahit', '1', 'Penyusunan buku disebaiknya ditanyakan dulu kepada pihak kami.', '1', '0', '0', now(), now());
			INSERT INTO finishings(name, shortname, ofdg, info, status, mingram, maxgram, created_at, updated_at) VALUES ('Spiral Binding', 'Jilid Spiral Besi', '1', 'Berbahan besi dan bisa dibuka hingga 360 derajat.', '1', '0', '0', now(), now());
			INSERT INTO finishings(name, shortname, ofdg, info, status, mingram, maxgram, created_at, updated_at) VALUES ('Manual Binding (Glue)', 'Jilid Lem Manual', '1', 'Lem pada salah satu sisi, memungkinkan untuk melepas kertasnya dengan mudah saat diperlukan.', '1', '0', '0', now(), now());
			INSERT INTO finishings(name, shortname, ofdg, info, status, mingram, maxgram, created_at, updated_at) VALUES ('Coating', 'Dilapis', '2', 'Matte: permukaan tidak mengkilap (<b>lebih elegan</b>)<br>Glossy: permukaan mengkilap (<b>menarik perhatian</b>)', '1', '0', '0', now(), now());
			INSERT INTO finishings(name, shortname, ofdg, info, status, mingram, maxgram, created_at, updated_at) VALUES ('Hole Punch', 'Lubang Filing', '2', 'Untuk filing pada map file, kertas dilobangi bagian sebelah kiri.', '1', '0', '0', now(), now());
			INSERT INTO finishings(name, shortname, ofdg, info, status, mingram, maxgram, created_at, updated_at) VALUES ('Hoek', 'Lengkung Sudut', '2', 'Lengkung pada sudut menambah estetika pada beberapa cetakan Anda.', '1', '0', '0', now(), now());
			INSERT INTO finishings(name, shortname, ofdg, info, status, mingram, maxgram, created_at, updated_at) VALUES ('Perforation', 'Perforasi', '2', 'Dalam file harus diletakan garis perforasi dalam bentuk garis TITIK-TITIK (<b>dan dalam bentuk yang bisa diedit</b>) sehingga kami dapat menghilangkan garis tersebut, ketika pencetakan.', '1', '0', '0', now(), now());
			INSERT INTO finishings(name, shortname, ofdg, info, status, mingram, maxgram, created_at, updated_at) VALUES ('Folding', 'Lipat', '2', 'Dihitung dari jumlah lipatan ketika dibentangkan. Harga lipat, bisa berubah sewaktu-waktu dan kami akan memberitahu sesegera mungkin setelah pesanan dibuat.', '1', '0', '0', now(), now());
			INSERT INTO finishings(name, shortname, ofdg, info, status, mingram, maxgram, created_at, updated_at) VALUES ('Cutting', 'Potong', '2', 'Letakan file diecut secara terpisah dengan file cetak. <br><br>Garis SOLID: untuk potongan.<br>Garis TITIK-TITIK: untuk tekukan.', '1', '0', '0', now(), now());
			INSERT INTO finishings(name, shortname, ofdg, info, status, mingram, maxgram, created_at, updated_at) VALUES ('Pacthing', 'Lem & Tempel', '2', 'Sertakan keterangan tempel. Harga akan disesuaikan setelah kami mendownload file Anda.', '1', '0', '0', now(), now());
			INSERT INTO finishings(name, shortname, ofdg, info, status, mingram, maxgram, created_at, updated_at) VALUES ('Inserting & Sorting', 'Sisip & Susun', '2', 'Jasa penyusunan dan penyisipan lembaran ke cetakan lainnya.', '1', '0', '0', now(), now());
			INSERT INTO finishings(name, shortname, ofdg, info, status, mingram, maxgram, created_at, updated_at) VALUES ('Numeration Print', 'Numerasi Print', '2', 'File design wajib <b>terpisah</b> dengan nomor, dan buat numerasi pada excel.<br><br>Akan disertakan dalam pencetakan, juga bisa dapat berupa nama atau alamat yang berbeda-beda.', '1', '0', '0', now(), now());
			INSERT INTO finishings(name, shortname, ofdg, info, status, mingram, maxgram, created_at, updated_at) VALUES ('Spiral Binding', 'Jilid Spiral Besi', '2', 'Jilid SPIRAL: berbahan besi dan bisa dibuka hingga 360 derajat.<br><br>Jilid KAWAT: dijilid dari bagian tengah buku.', '1', '0', '0', now(), now());
			INSERT INTO finishings(name, shortname, ofdg, info, status, mingram, maxgram, created_at, updated_at) VALUES ('Manual Binding (Glue)', 'Jilid Lem Manual', '2', 'Lem pada salah satu sisi, memungkinkan untuk melepas kertasnya dengan mudah saat diperlukan. Pada perforasi, kami akan melakukan penjahitan kawat pada sisi yang terjilid, memungkinkan Anda untuk menyobek kertas saat diperlukan.', '1', '0', '0', now(), now());
			INSERT INTO finishings(name, shortname, ofdg, info, status, mingram, maxgram, created_at, updated_at) VALUES ('Coating', 'Dilapis', '3', 'Matte: permukaan tidak mengkilap (<b>lebih elegan</b>)<br>Glossy: permukaan mengkilap (<b>menarik perhatian</b>)', '1', '0', '0', now(), now());
			INSERT INTO finishings(name, shortname, ofdg, info, status, mingram, maxgram, created_at, updated_at) VALUES ('Cutting', 'Potong', '3', 'Potongan banner pengaruh akan hasil akhir, mohon disertakan bila ada permintaan khusus.', '1', '0', '0', now(), now());
			INSERT INTO finishings(name, shortname, ofdg, info, status, mingram, maxgram, created_at, updated_at) VALUES ('Standing', 'Kaki Banner', '3', 'Simple untuk dilipat dan dijinjing untuk dibawa menuju pameran.', '1', '0', '0', now(), now());
			INSERT INTO finishings(name, shortname, ofdg, info, status, mingram, maxgram, created_at, updated_at) VALUES ('Canvas Board + Stand', 'Papan Canvas + Kaki', '3', 'Pilihan termasuk papan dan kaki canvas, permintaan khusus tolong disertakan pada kolom keterangan.', '1', '0', '0', now(), now());
			INSERT INTO finishings(name, shortname, ofdg, info, status, mingram, maxgram, created_at, updated_at) VALUES ('Tripod Board', 'Papan Tripod', '3', 'Pilihan untuk papan dibelakang sticker yang akan menyanggah diatas kaki tripod', '1', '0', '0', now(), now());
			INSERT INTO finishings(name, shortname, ofdg, info, status, mingram, maxgram, created_at, updated_at) VALUES ('Poster Board', 'Papan Poster', '3', 'Bahan mika seperti kaca untuk ditempel pada dinding. Tanpa lampu.', '0', '0', '0', now(), now());
			INSERT INTO finishings(name, shortname, ofdg, info, status, mingram, maxgram, created_at, updated_at) VALUES ('Press', 'Press', '4', 'Jasa pembuatan kartu standard.', '1', '0', '0', now(), now());
			INSERT INTO finishings(name, shortname, ofdg, info, status, mingram, maxgram, created_at, updated_at) VALUES ('Numeration', 'Numerasi', '4', 'Jasa penomoran kartu.', '0', '0', '0', now(), now());
			INSERT INTO finishings(name, shortname, ofdg, info, status, mingram, maxgram, created_at, updated_at) VALUES ('Magnetic Stripe', 'Pita Magnetik', '4', 'Jasa pembuatan kartu magnetik.', '0', '0', '0', now(), now());
			INSERT INTO finishings(name, shortname, ofdg, info, status, mingram, maxgram, created_at, updated_at) VALUES ('Calendar Board', 'Kaki Kalender', '5', 'Kaki kalender meja, berbentuk prisma dengan jilid spiral diatasnya.', '1', '0', '0', now(), now());
			INSERT INTO finishings(name, shortname, ofdg, info, status, mingram, maxgram, created_at, updated_at) VALUES ('Stamp Color', 'Warna Tinta', '5', 'Warna utama stempel', '1', '0', '0', now(), now());
			INSERT INTO finishings(name, shortname, ofdg, info, status, mingram, maxgram, created_at, updated_at) VALUES ('Stamp Color 2', 'Warna Tinta 2', '5', 'Warna kedua stempel', '1', '0', '0', now(), now());
			INSERT INTO finishings(name, shortname, ofdg, info, status, mingram, maxgram, created_at, updated_at) VALUES ('Stamp Color 3', 'Warna Tinta 3', '5', 'Warna ketiga stempel', '1', '0', '0', now(), now());
			INSERT INTO finishings(name, shortname, ofdg, info, status, mingram, maxgram, created_at, updated_at) VALUES ('Tripod Stand', 'Kaki Tripod', '3', 'Stand banner 90 derajat permukaan tanah, dengan kaki 3 yang memungkinkan dilihat pada kedua sisi.', '1', '0', '0', now(), now());
			INSERT INTO finishings(name, shortname, ofdg, info, status, mingram, maxgram, created_at, updated_at) VALUES ('Thin Book Binding', 'Jilid Kawat', '1', 'Dijilid dari bagian tengah buku, pada posisi terbuka.', '1', '0', '0', now(), now());
			INSERT INTO finishings(name, shortname, ofdg, info, status, mingram, maxgram, created_at, updated_at) VALUES ('Thin Book Binding', 'Jilid Kawat', '2', 'Dijilid dari bagian tengah buku, pada posisi terbuka.', '1', '0', '0', now(), now());
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
