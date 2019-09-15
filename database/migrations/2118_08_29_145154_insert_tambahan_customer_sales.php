<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertTambahanCustomerSales extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
			INSERT INTO customers (companyID, email, password, name, type, title, address, postcode, cityID, phone1, phone2, news, balance, remember_token, created_at, updated_at) VALUES ('1', 'joko.widodo@gmail.com', '', 'Jokowi', 'personal', 'Mr.', 'Jl. Pembangunan II No. 52', '10291', '1', '021-6149101', '081112346567', '1', '0', null, null, null);
			INSERT INTO customers (companyID, email, password, name, type, title, address, postcode, cityID, phone1, phone2, news, balance, remember_token, created_at, updated_at) VALUES ('2', 'septiana.rd@gmail.com', '', 'Septiana Rahayu', 'personal', 'Ms.', 'Jl. Kebangkitan 52 No. 123', '19283', '2', '021-2354019', '', '0', '0', null, null, null);
			INSERT INTO customers (companyID, email, password, name, type, title, address, postcode, cityID, phone1, phone2, news, balance, remember_token, created_at, updated_at) VALUES ('1', 'rudisukradi83@gmail.com', '', 'Rudi Sukradi', 'personal', 'Mr.', 'Jl. Panjang A23 Blok B1 No. 2 RT01/RW02, Kedoya Selatan, Jakarta Barat 10621', '10621', '3', '021-66678900', '', '0', '0', null, null, null);
			INSERT INTO customers (companyID, email, password, name, type, title, address, postcode, cityID, phone1, phone2, news, balance, remember_token, created_at, updated_at) VALUES ('2', 'helloworld@gmail.com', '', 'Hello World', 'personal', 'Mrs.', 'Jl. Suka Suka 5a, Tanjung Priok, Jakarta Utara 10532', '10532', '2', '0813889889', '021-6491502', '1', '0', null, null, null);
			INSERT INTO customers (companyID, email, password, name, type, title, address, postcode, cityID, phone1, phone2, news, balance, remember_token, created_at, updated_at) VALUES ('1', 'iwansaswita53@gmail.com', '', 'Iwan Saswita', 'personal', 'Mr.', 'Jl. Kebagusan XVIII, Gg. 42 Dalam, Blok D11, Samping Gedung Biru, Tulisan ABC, Jakarta Utara 10289', '10289', '1', '081982919019', '021-6512199', '1', '0', null, null, null);
			INSERT INTO customers (companyID, email, password, name, type, title, address, postcode, cityID, phone1, phone2, news, balance, remember_token, created_at, updated_at) VALUES ('1', 'rahayu_printing@yahoo.co.id', '', 'Rahayu Percetakan Jayakarta', 'personal', 'Ms.', 'Jl. Pangeran Jayakarta 113, Sebelah POM Bensin, Sebelom Bank Artha Graha, Tulisan Rahayu, Mangga Dua Selatan, Sawah Besar, Jakarta Pusat 10730', '10730', '3', '088811110290', '', '1', '0', null, null, null);
			INSERT INTO customers (companyID, email, password, name, type, title, address, postcode, cityID, phone1, phone2, news, balance, remember_token, created_at, updated_at) VALUES ('3', 'indrasaswita@jakartabrosur.com', '', 'Indra JB', 'personal', 'Mr.', 'Jl. Danau Bisma Utara No. 12, Blok A, Masuk dari Blok B', '10731', '1', '081101920112', '', '0', '10000', null, null, null);
			INSERT INTO customers (companyID, email, password, name, type, title, address, postcode, cityID, phone1, phone2, news, balance, remember_token, created_at, updated_at) VALUES ('3', 'noreply@jakartabrosur.com', '', 'No Reply JB', 'personal', 'Mrs.', 'Jl. Heheh Hahah Hohoo', '10921', '4', '0819283192831', '', '0', '1000000', null, null, null);


			
			INSERT INTO salesheaders(customerID, tempo, estdate, companyname, created_at, updated_at, deleted_at) VALUES ('1', 'Flyer bekas', null, '2018-06-22 12:00:00', null, '2018-06-20 12:00:23', '2018-06-20 12:00:23', null);
			INSERT INTO salesheaders(customerID, tempo, estdate, companyname, created_at, updated_at, deleted_at) VALUES ('2', 'Sapphire Moonlight', null, '2018-06-23 12:00:00', null, '2018-06-21 17:05:00', '2018-06-21 17:05:00', null);
			INSERT INTO salesheaders(customerID, tempo, estdate, companyname, created_at, updated_at, deleted_at) VALUES ('3', 'It feel like oh-la-la..', null, '2018-06-24 12:00:00', null, '2018-06-21 16:00:09', '2018-06-21 16:00:09', null);
			INSERT INTO salesheaders(customerID, tempo, estdate, companyname, created_at, updated_at, deleted_at) VALUES ('4', 'Tequila Sunrise', null, '2018-06-25 12:00:00', null, '2018-06-22 18:23:24', '2018-06-22 18:23:24', null);
			INSERT INTO salesheaders(customerID, tempo, estdate, companyname, created_at, updated_at, deleted_at) VALUES ('5', 'Hello World 102', null, '2018-07-02 10:00:00', null, '2018-07-01 3:02:04', '2018-07-01 3:02:04', null);
			INSERT INTO salesheaders(customerID, tempo, estdate, companyname, created_at, updated_at, deleted_at) VALUES ('6', 'Hello World', null, '2018-08-01 10:00:00', null, '2018-07-01 7:23:00', '2018-07-01 7:23:00', null);


			
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
