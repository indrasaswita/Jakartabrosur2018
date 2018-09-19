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
			INSERT INTO finishings(name, shortname, info, status, side) VALUES ('Laminasi', 'Laminating', 'Note: Tidak bisa digabung dengan varnish.<br><br>Matte: permukaan tidak mengkilap (<b>lebih elegan</b>)<br>Glossy: permukaan mengkilap (<b>menarik perhatian</b>)', '1', '0');
			INSERT INTO finishings(name, shortname, info, status, side) VALUES ('Perforasi', 'Cacah', 'Dalam file harus diletakan garis perforasi dalam bentuk garis TITIK-TITIK (<b>dan dalam bentuk yang bisa diedit</b>) sehingga kami dapat menghilangkan garis tersebut, ketika pencetakan.', '1', '-1');
			INSERT INTO finishings(name, shortname, info, status, side) VALUES ('Numerasi', 'Numerator', 'File design wajib <b>terpisah</b> dengan nomor, dan buat numerasi pada excel.<br><br>Digital: akan disertakan dalam pencetakan.<br>Offset: akan dicetak manual setelah pencetakan Offset selesai.', '1', '-1');
			INSERT INTO finishings(name, shortname, info, status, side) VALUES ('Varnish', 'UV Varnish', 'Bahan untuk varnish, hanya bahan coating (ArtCarton dan ArtPaper) saja.<br><br>UV Varnish: dilapisi cairan mengkilap pada keseluruhan permukaan.<br>Spot UV: dilapisi cairan mengkilap <b>hanya pada bagian tertentu</b> saja.', '1', '0');
			INSERT INTO finishings(name, shortname, info, status, side) VALUES ('Lipat', 'Lipat', 'Dihitung dari jumlah lipatan ketika dibentangkan. Harga lipat, bisa berubah sewaktu-waktu dan kami akan memberitahu sesegera mungkin setelah pesanan dibuat.', '1', '-1');
			INSERT INTO finishings(name, shortname, info, status, side) VALUES ('Potong', 'Potong', 'Dipotong sesuai kris potong.<br><br>Note: Anda harus meletakan bleed (lebihan gambar) sebesar 2mm pada setiap sisinya.', '1', '-1');
			INSERT INTO finishings(name, shortname, info, status, side) VALUES ('Jilid', 'Jilid', 'Jilid SPIRAL: berbahan besi dan bisa dibuka hingga 360 derajat.<br><br>Jilid KAWAT: dijilid dari bagian tengah buku.', '1', '-1');
			INSERT INTO finishings(name, shortname, info, status, side) VALUES ('Die Cut', 'Pon', 'Letakan file diecut secara terpisah dengan file cetak. <br><br>Garis SOLID: untuk potongan.<br>Garis TITIK-TITIK: untuk tekukan.', '1', '-1');
			INSERT INTO finishings(name, shortname, info, status, side) VALUES ('Numerasi Emboss', 'Numerator Emas', '<span style=\'color:red;\'>Belum tersedia. Silahkan cek di hari esok.</span>', '0', '-1');
			INSERT INTO finishings(name, shortname, info, status, side) VALUES ('Laminasi Press', 'Press', 'Saat ini kami baru menyediakan finishing <b>glossy</b> (mengkilap), untuk finishing lainnya silahkan hubungi kami lebih lanjut.<br><br>Note: Dibuat dengan laminasi hidrolik, membuat kartu sangat solid dan kuat.', '1', '-1');
			INSERT INTO finishings(name, shortname, info, status, side) VALUES ('Eyelet (Kancing Banner)', 'Mata Ayam', 'Standard mata ayam kami adalah per 1 meter, jika ada kebutuhan khusus silahkan sertakan dideskripsi cetakan.<br><br>Note: Jika ada penambahan biaya, kami akan beritahu sebelum pencetakan.', '1', '-1');
			INSERT INTO finishings(name, shortname, info, status, side) VALUES ('Standing Banner', 'Kaki Roll-Up', 'Roll-up Banner lebih disarankan untuk diganti beserta kakinya, karena sering terjadi kegagalan.<br><br>Note: Kami tidak menerima pemasangan kaki banner jika tidak ada pemesanan beserta kakinya.', '1', '-1');
			INSERT INTO finishings(name, shortname, info, status, side) VALUES ('Hot Stamp', 'Poly', 'Dibuat mengkilap, sehingga lebih bersinar ketika dilihat.<br><br>Note: sertakan juga file poly secara terpisah dalam bentuk vector.', '1', '-1');
			INSERT INTO finishings(name, shortname, info, status, side) VALUES ('Embossing', 'Emboss', 'Area yang dianggap penting dibuat 3 dimensi, sehingga lebih hidup dan indah ketika dilihat.<br><br>Note: sertakan juga file emboss secara terpisah dalam bentuk vector.', '1', '-1');
			INSERT INTO finishings(name, shortname, info, status, side) VALUES ('Spot Varnish', 'Spot UV', 'Bahan untuk varnish, hanya bahan coating (ArtCarton dan ArtPaper) saja.<br><br>Note: Untuk Spot UV harus menggunakan tambahan laminasi doff.', '1', '0');
			INSERT INTO finishings(name, shortname, info, status, side) VALUES ('Potong', 'Gunting Banner', 'Dipotong sesuai permintaan, bila ada permintaan tambahan <u>sertakan</u> pada deskripsi cetakan.<br><br><b>Potong Tepat Gambar</b>: dipotong pas gambar, tanpa lebihan.<br><b>Lipatan Setiap Sisi</b>: dipotong diluar gambar, untuk ditekuk agar tidak mudah sobek atau pecah.<br><b>Selongsong</b>: silahkan berikan keterangan lebar bambu selongsongnya pada deskripsi cetakan.', '1', '-1');
			INSERT INTO finishings(name, shortname, info, status, side) VALUES ('Laminasi', 'Laminating Banner', 'Ini adalah laminasi dingin, akan lebih tebal dan tahan lama dibanding laminasi panas.<br><br>Laminasi pada spanduk hanya dilakukan pada 1 sisi permukaan (<b>depan doang</b>)', '1', '1');
			INSERT INTO finishings(name, shortname, info, status, side) VALUES ('Standing Banner', 'Kaki X-Banner', 'Sangat mudah memasang kaki x-banner.', '1', '-1');
			INSERT INTO finishings(name, shortname, info, status, side) VALUES ('Standing Calendar', 'Kaki Kalender', 'Standard karton, 1.5mm', '1', '-1');
			INSERT INTO finishings(name, shortname, info, status, side) VALUES ('Spiral', 'Jilid Spiral Kalender', 'Bahan Spiral = Kawat besi', '1', '-1');
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
