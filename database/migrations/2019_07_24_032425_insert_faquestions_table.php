<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertFaquestionsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
			INSERT INTO faquestions(title, favourite, description, questiontypeID, linkheader, linkurl, employeeID, created_at, updated_at) VALUES('Bagaimana cara upload file?', '1', 'Silahkan masuk ke <b>Halaman \'Login\' <i class=\'far fa-chevron-right fa-fw\'></i> Halaman \'Pesan\' <i class=\'far fa-chevron-right fa-fw\'></i> Pilih Jenis Cetakan <i class=\'far fa-chevron-right fa-fw\'></i> Tab \'<i class=\'fal fa-copy fa-fw\'></i>File\' <i class=\'far fa-chevron-right fa-fw\'></i> Silahkan pilih cara upload</b>.', '1', '', '', '1', now(), null);
			INSERT INTO faquestions(title, favourite, description, questiontypeID, linkheader, linkurl, employeeID, created_at, updated_at) VALUES('Bagaimana cara upload file ukuran besar?', '0', 'Jika file melebihi 25 MB, silahkan upload file anda ke online storage (OneDrive, Google Drive, Dropbox, WeTransfer) dan copy file yang sudah di share. <br><br><b>Halaman \'Login\' <i class=\'far fa-chevron-right fa-fw\'></i> Halaman \'Pesan\' <i class=\'far fa-chevron-right fa-fw\'></i> Pilih Jenis Cetakan <i class=\'far fa-chevron-right fa-fw\'></i> Tab \'<i class=\'fal fa-copy fa-fw\'></i>File\' <i class=\'far fa-chevron-right fa-fw\'></i> Pilih \'Insert URL\' <i class=\'far fa-chevron-right fa-fw\'></i> Copy dan Paste \'Shared URL\' <i class=\'far fa-chevron-right fa-fw\'></i> Klik \'Save\'</b>. Dan pastikan link yang Anda masukkan dibagikan secara Public.', '1', '', '', '1', now(), null);
			INSERT INTO faquestions(title, favourite, description, questiontypeID, linkheader, linkurl, employeeID, created_at, updated_at) VALUES('Apakah saya bisa kirim file lewat email?', '0', 'Tentu. Setelah Anda melakukan pemesanan, silahkan kirimkan ke <span class=\'highlight\'>rahayuprinting113@gmail.com</span> dan lakukan konfirmasi ke 0813 1551 9889 (WA/Telp).', '1', '', '', '1', now(), null);
			INSERT INTO faquestions(title, favourite, description, questiontypeID, linkheader, linkurl, employeeID, created_at, updated_at) VALUES('Bagaimana cara melakukan pembayaran?', '1', 'Pembayaran dilakukan secara transfer dan konfirmasi melalu web atau dipandu oleh pihak kami di 0813 1551 9889.', '2', '', '', '1', now(), null);
			INSERT INTO faquestions(title, favourite, description, questiontypeID, linkheader, linkurl, employeeID, created_at, updated_at) VALUES('Apakah pembayaran bisa Cash?', '0', 'Tidak bisa. Untuk pemesan melalui JakartaBrosur dilakukan secara Transfer, pembayaran secara Cash hanya dapat dilakukan di Percetakan Rahayu Offline.', '2', '', '', '1', now(), null);
			INSERT INTO faquestions(title, favourite, description, questiontypeID, linkheader, linkurl, employeeID, created_at, updated_at) VALUES('Apakah bisa COD?', '0', 'Tidak bisa. Untuk pemesan melalui JakartaBrosur dilakukan secara Transfer, pembayaran selain Transfer hanya dapat dilakukan di Percetakan Rahayu Offline.', '2', '', '', '1', now(), null);
			INSERT INTO faquestions(title, favourite, description, questiontypeID, linkheader, linkurl, employeeID, created_at, updated_at) VALUES('Apakah saya bisa pesan buku?', '1', 'Bisa. Pesanan yang tidak dicantumkan di web, silahkan hubungi 0813 1551 9889.', '3', '', '', '1', now(), null);
			INSERT INTO faquestions(title, favourite, description, questiontypeID, linkheader, linkurl, employeeID, created_at, updated_at) VALUES('Apakah saya bisa pesan yang tidak ada di web?', '0', 'Bisa. Tanyakan langsung ke 0813 1551 9889. Kami melayani pencetakan untuk Offset, Digital Offset, Digital Large Format, PVC Card dan Souvenir.', '3', '', '', '1', now(), null);
			INSERT INTO faquestions(title, favourite, description, questiontypeID, linkheader, linkurl, employeeID, created_at, updated_at) VALUES('Apakah sedia jasa sablon?', '0', 'Tidak ada. Kami tidak menyediakan jasa sablon.', '3', '', '', '1', now(), null);
			INSERT INTO faquestions(title, favourite, description, questiontypeID, linkheader, linkurl, employeeID, created_at, updated_at) VALUES('Berapa lama proses pesanan saya?', '0', 'Pesanan digital dapat diproses dalam hitungan menit. Untuk pesanan yang lebih sulit, prosesnya 1 hari atau lebih (dapat dilihat di bagian pesanan).', '3', '', '', '1', now(), null);
			INSERT INTO faquestions(title, favourite, description, questiontypeID, linkheader, linkurl, employeeID, created_at, updated_at) VALUES('Bagaimana jika butuh sangat cepat?', '0', 'Untuk pesanan yang sangat cepat, silahkan pesan, dan konfirmasi untuk dilakukan percepatan proses ke 0813 1551 9889.', '3', '', '', '1', now(), null);
			INSERT INTO faquestions(title, favourite, description, questiontypeID, linkheader, linkurl, employeeID, created_at, updated_at) VALUES('Apakah dapat menggunakan Instant Courier?', '0', 'Untuk GoJek dan Grab Instant yang dipesan oleh Anda, silahkan pilih \'Pick-up\' delivery. Atau kami akan melakukan penghitungan ulang untuk biaya GoJek dan Grab Instant setelah pesanan Anda kami cek.', '3', '', '', '1', now(), null);
			INSERT INTO faquestions(title, favourite, description, questiontypeID, linkheader, linkurl, employeeID, created_at, updated_at) VALUES('Apakah saya bisa melihat contoh bahan?', '1', 'Contoh bahan diberikan secara gratis. Silahkan hubungi ke 0813 1551 9889 untuk permintaan contoh.', '4', '', '', '1', now(), null);
			INSERT INTO faquestions(title, favourite, description, questiontypeID, linkheader, linkurl, employeeID, created_at, updated_at) VALUES('Apakah saya dapat melihat hasil cetakan sebelumnya?', '0', 'Hasil cetakan sebelumnya dapat dilihat di workshop kami. Jika tidak sempat datang, Anda dapat meminta foto katalog lewat customer service kami.', '4', '', '', '1', now(), null);
			INSERT INTO faquestions(title, favourite, description, questiontypeID, linkheader, linkurl, employeeID, created_at, updated_at) VALUES('Bagaimana saya menentukan bahan yang cocok?', '0', 'Silahkan hubungi kami di 0813 1551 9889. Dengan senang hati kami akan memandu pesanan Anda.', '4', '', '', '1', now(), null);
		");
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists("faquestions");
	}
}
