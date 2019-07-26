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
			INSERT INTO faquestions(title, favourite, description, questiontypeID, linkheader, linkurl, employeeID, created_at, updated_at) VALUES('Syarat dan Ketentuan Pembayaran via BCA Virtual Account', 1, 'Berikut ini syarat dan ketentuan pembayaran via BCA Virtual Account:
				Minimum pembayaran Rp10.000,- (Sepuluh ribu
				rupiah) maksimum pembayaran Seratus juta rupiah', 1, '', '', 1, now(), null);
				INSERT INTO faquestions(title, favourite, description, questiontypeID, linkheader, linkurl, employeeID, created_at, updated_at) VALUES('ABSyarat dan Ketentuan Pembayaran via BCA Virtual Account', 0, 'Berikut ini syarat dan ketentuan pembayaran via BCA Virtual Account:
				Minimum pembayaran Rp10.000,- (Sepuluh ribu
				rupiah) maksimum pembayaran Seratus juta rupiah', 1, '', '', 1, now(), null);
				INSERT INTO faquestions(title, favourite, description, questiontypeID, linkheader, linkurl, employeeID, created_at, updated_at) VALUES('ANJING Syarat dan Ketentuan Pembayaran via BCA Virtual Account', 0, 'Berikut ini syarat dan ketentuan pembayaran via BCA Virtual Account:
				Minimum pembayaran Rp10.000,- (Sepuluh ribu
				rupiah) maksimum pembayaran Seratus juta rupiah', 1, '', '', 1, now(), null);
				INSERT INTO faquestions(title, favourite, description, questiontypeID, linkheader, linkurl, employeeID, created_at, updated_at) VALUES('KUTU Syarat dan Ketentuan Pembayaran via BCA Virtual Account', 0, 'Berikut ini syarat dan ketentuan pembayaran via BCA Virtual Account:
				Minimum pembayaran Rp10.000,- (Sepuluh ribu
				rupiah) maksimum pembayaran Seratus juta rupiah', 1, '', '', 1, now(), null);
				INSERT INTO faquestions(title, favourite, description, questiontypeID, linkheader, linkurl, employeeID, created_at, updated_at) VALUES('Syarat dan Ketentuan Pembayaran via BCA Virtual Account', 1, 'Berikut ini syarat dan ketentuan pembayaran via BCA Virtual Account:
				Minimum pembayaran Rp10.000,- (Sepuluh ribu
				rupiah) maksimum pembayaran Seratus juta rupiah', 2, '', '', 1, now(), null);
				INSERT INTO faquestions(title, favourite, description, questiontypeID, linkheader, linkurl, employeeID, created_at, updated_at) VALUES('HAHA Syarat dan Ketentuan Pembayaran via BCA Virtual Account', 0, 'Berikut ini syarat dan ketentuan pembayaran via BCA Virtual Account:
				Minimum pembayaran Rp10.000,- (Sepuluh ribu
				rupiah) maksimum pembayaran Seratus juta rupiah', 2, '', '', 1, now(), null);
				INSERT INTO faquestions(title, favourite, description, questiontypeID, linkheader, linkurl, employeeID, created_at, updated_at) VALUES('QWER Syarat dan Ketentuan Pembayaran via BCA Virtual Account', 0, 'Berikut ini syarat dan ketentuan pembayaran via BCA Virtual Account:
				Minimum pembayaran Rp10.000,- (Sepuluh ribu
				rupiah) maksimum pembayaran Seratus juta rupiah', 2, '', '', 1, now(), null);
				INSERT INTO faquestions(title, favourite, description, questiontypeID, linkheader, linkurl, employeeID, created_at, updated_at) VALUES('BIJI Syarat dan Ketentuan Pembayaran via BCA Virtual Account', 0, 'Berikut ini syarat dan ketentuan pembayaran via BCA Virtual Account:
				Minimum pembayaran Rp10.000,- (Sepuluh ribu
				rupiah) maksimum pembayaran Seratus juta rupiah', 2, '', '', 1, now(), null);
				INSERT INTO faquestions(title, favourite, description, questiontypeID, linkheader, linkurl, employeeID, created_at, updated_at) VALUES('ASDASD Syarat dan Ketentuan Pembayaran via BCA Virtual Account', 1, 'Berikut ini syarat dan ketentuan pembayaran via BCA Virtual Account:
				Minimum pembayaran Rp10.000,- (Sepuluh ribu
				rupiah) maksimum pembayaran Seratus juta rupiah', 3, '', '', 1, now(), null);
				INSERT INTO faquestions(title, favourite, description, questiontypeID, linkheader, linkurl, employeeID, created_at, updated_at) VALUES('UUUUU Syarat dan Ketentuan Pembayaran via BCA Virtual Account', 1, 'Berikut ini syarat dan ketentuan pembayaran via BCA Virtual Account:
				Minimum pembayaran Rp10.000,- (Sepuluh ribu
				rupiah) maksimum pembayaran Seratus juta rupiah', 4, '', '', 1, now(), null);
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
