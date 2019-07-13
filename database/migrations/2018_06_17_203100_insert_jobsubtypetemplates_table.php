d<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertJobsubtypetemplatesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
			INSERT INTO jobsubtypetemplates (name, fullname, description, jobsubtypeID, ofdg, paperID, sizeID, sideprint, preview, color, created_at) values ('Ekonomis', 'Ekonomis', 'Harga yang ekonomis serta cetakan 2 sisi menjadikan info yang disampaikan cukup berisi', '1', '1', '2', '5', '2', '', '#777', now());
			INSERT INTO jobsubtypetemplates (name, fullname, description, jobsubtypeID, ofdg, paperID, sizeID, sideprint, preview, color, created_at) values ('Premium', 'Premium', 'Menggunakan kertas mengkilap tebal, memberikan warna dan sensasi premium saat dipandang', '1', '1', '3', '4', '2', '', '#5a9', now());
			INSERT INTO jobsubtypetemplates (name, fullname, description, jobsubtypeID, ofdg, paperID, sizeID, sideprint, preview, color, created_at) values ('Go-Green', 'Ramah Lingkungan', 'Menggunakan kertas daur ulang, biasa digunakan untuk menambahkan kemewahan', '1', '1', '12', '4', '2', '', '#0f0', now());
			INSERT INTO jobsubtypetemplates (name, fullname, description, jobsubtypeID, ofdg, paperID, sizeID, sideprint, preview, color, created_at) values ('Lipat Prem.', 'Lipat Premium', 'Brosur A4 dengan 4 halaman, menambahkan kemewahan dan detail info produk Anda', '1', '1', '3', '4', '2', '', '#5a9', now());
			INSERT INTO jobsubtypetemplates (name, fullname, description, jobsubtypeID, ofdg, paperID, sizeID, sideprint, preview, color, created_at) values ('Lipat Eco.', 'Lipat Ekonomis', 'Brosur A5 dengan 4 halaman, dibutuhkan bila informasi yang disampaikan cukup banyak', '1', '1', '2', '5', '2', '', '#777', now());
			INSERT INTO jobsubtypetemplates (name, fullname, description, jobsubtypeID, ofdg, paperID, sizeID, sideprint, preview, color, created_at) values ('Ekonomis', 'Ekonomis', 'Harga yang ekonomis serta cetakan 2 sisi menjadikan info yang disampaikan cukup berisi', '1', '2', '2', '5', '1', '', '#777', now());
			INSERT INTO jobsubtypetemplates (name, fullname, description, jobsubtypeID, ofdg, paperID, sizeID, sideprint, preview, color, created_at) values ('Premium', 'Premium', 'Kertas mewah menjadi andalannya, ditambah ketebalan yang cukup menjadikan elegan', '1', '2', '13', '4', '2', '', '#5a9', now());
			INSERT INTO jobsubtypetemplates (name, fullname, description, jobsubtypeID, ofdg, paperID, sizeID, sideprint, preview, color, created_at) values ('Go-Green', 'Go-Green', 'Menggunakan kertas daur ulang, biasa digunakan untuk menambahkan kemewahan', '1', '2', '12', '4', '1', '', '#0f0', now());
			INSERT INTO jobsubtypetemplates (name, fullname, description, jobsubtypeID, ofdg, paperID, sizeID, sideprint, preview, color, created_at) values ('Recycle', 'Daur Ulang', 'Menggunakan kertas coklat yang dicetak dengan tinta hitam', '1', '2', '16', '4', '1', '', '#8B4513', now());
			INSERT INTO jobsubtypetemplates (name, fullname, description, jobsubtypeID, ofdg, paperID, sizeID, sideprint, preview, color, created_at) values ('Lipat Eco.', 'Lipat Ekonomis', 'Brosur A5 dengan 4 halaman, dibutuhkan bila informasi yang disampaikan cukup banyak', '1', '2', '2', '5', '2', '', '#777', now());
			INSERT INTO jobsubtypetemplates (name, fullname, description, jobsubtypeID, ofdg, paperID, sizeID, sideprint, preview, color, created_at) values ('Standard', 'Standard', 'Karton dengan ketebalan standar, cocok dipakai untuk di kelas kartu nama', '2', '1', '7', '12', '2', '', '#777', now());
			INSERT INTO jobsubtypetemplates (name, fullname, description, jobsubtypeID, ofdg, paperID, sizeID, sideprint, preview, color, created_at) values ('Recycle', 'Daur Ulang', 'Menggunakan kertas coklat yang dicetak dengan tinta hitam', '2', '1', '16', '12', '1', '', '#8B4513', now());
			INSERT INTO jobsubtypetemplates (name, fullname, description, jobsubtypeID, ofdg, paperID, sizeID, sideprint, preview, color, created_at) values ('Ekonomis', 'Ekonomis', 'Karton dengan ketebalan standar, cocok dipakai untuk di kelas kartu nama', '2', '2', '7', '12', '1', '', '#777', now());
			INSERT INTO jobsubtypetemplates (name, fullname, description, jobsubtypeID, ofdg, paperID, sizeID, sideprint, preview, color, created_at) values ('Premium', 'Premium', 'Berbahan karton dilapisi plastik tipis, memberikan kesan matte saat disentuh', '2', '2', '7', '12', '2', '', '#5a9', now());
			INSERT INTO jobsubtypetemplates (name, fullname, description, jobsubtypeID, ofdg, paperID, sizeID, sideprint, preview, color, created_at) values ('Go-Green', 'Ramah Lingkungan', 'Menggunakan kertas daur ulang, biasa digunakan untuk menambahkan kemewahan', '2', '2', '13', '12', '2', '', '#0f0', now());
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
