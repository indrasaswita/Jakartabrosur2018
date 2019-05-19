<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertDeliveryTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
			INSERT INTO deliveries VALUES('1', 'exp', 'Pick-Up', '0', '0', '', '0', 'Dapat diambil di workshop kami di Rahayu Printing', '1', now(), now());
			INSERT INTO deliveries VALUES('2', 'exp', 'GO-JEK', '25000', '0', 'kg', '0', 'Harga tersebut hanya merupakan harga awal<br><br>Kami akan segera mengupdate harga pengiriman setelah kami melakukan pengecekan', '0', now(), now());
			INSERT INTO deliveries VALUES('3', 'std', 'JNE Regular', '0', '9000', 'kg', '3', 'Harga ini adalah harga perkiraan yang berlaku untuk area Jabodetabek<br><br>Kami akan segera mengupdate harga pengiriman setelah kami melakukan pengecekan', '0', now(), now());
			INSERT INTO deliveries VALUES('4', 'exp', 'JNE YES', '0', '18000', 'kg', '2', 'Harga ini adalah harga perkiraan yang berlaku untuk area Jabodetabek<br><br>Kami akan segera mengupdate harga pengiriman setelah kami melakukan pengecekan', '0', now(), now());
			INSERT INTO deliveries VALUES('5', 'std', 'Pos Indonesia', '0', '10000', 'kg', '4', 'Harga ini adalah harga perkiraan yang berlaku untuk area Jabodetabek<br><br>Kami akan segera mengupdate harga pengiriman setelah kami melakukan pengecekan', '0', now(), now());
			INSERT INTO deliveries VALUES('6', 'std', 'Mex Berlian', '50000', '0', 'kg', '2', 'Harga ini adalah harga perkiraan yang berlaku untuk area Jabodetabek<br><br>Kami akan segera mengupdate harga pengiriman setelah kami melakukan pengecekan', '0', now(), now());
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
