<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertAddressesTables extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//UPDATE 3.02


		DB::unprepared("
			ALTER TABLE cities
				ADD COLUMN island VARCHAR(64) NOT NULL DEFAULT '' AFTER name;

			ALTER TABLE addresses
				DROP FOREIGN KEY addresses_cityid_foreign;

			TRUNCATE TABLE cities;

			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Denpasar', 'Bali', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Bandung', 'Java', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Batu', 'Java', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Bekasi', 'Java', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Blitar', 'Java', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Bogor', 'Java', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Cianjur', 'Java', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Cilegon', 'Java', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Cimahi', 'Java', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Cirebon', 'Java', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Depok', 'Java', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Jakarta', 'Java', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Madiun', 'Java', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Magelang', 'Java', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Malang', 'Java', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Mojokerto', 'Java', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Pasuruan', 'Java', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Pekalongan', 'Java', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Probolinggo', 'Java', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Salatiga', 'Java', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Semarang', 'Java', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('South Tangerang', 'Java', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Sukabumi', 'Java', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Surabaya', 'Java', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Surakarta', 'Java', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Tasikmalaya', 'Java', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Tangerang', 'Java', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Tegal', 'Java', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Yogyakarta', 'Java', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Kediri', 'Java', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Serang', 'Java', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Purwokerto', 'Java', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Balikpapan', 'Kalimantan', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Banjarbaru', 'Kalimantan', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Banjarmasin', 'Kalimantan', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Bontang', 'Kalimantan', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Palangkaraya', 'Kalimantan', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Pontianak', 'Kalimantan', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Samarinda', 'Kalimantan', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Singkawang', 'Kalimantan', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Tarakan', 'Kalimantan', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Tenggarong', 'Kalimantan', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Ambon', 'Maluku', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Tual', 'Maluku', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Ternate', 'Maluku', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Tidore', 'Maluku', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Bima', 'Nusa Tenggara', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Mataram', 'Nusa Tenggara', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Kupang', 'Nusa Tenggara', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Jayapura', 'Papua', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Merauke', 'Papua', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Kota Sorong', 'Papua Barat', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Manokwari', 'Papua Barat', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Bau-Bau', 'Sulawesi', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Bitung', 'Sulawesi', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Gorontalo', 'Sulawesi', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Kendari', 'Sulawesi', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Makassar', 'Sulawesi', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Manado', 'Sulawesi', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Palu', 'Sulawesi', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Pare-Pare', 'Sulawesi', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Palopo', 'Sulawesi', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Tomohon', 'Sulawesi', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Banda Aceh', 'Sumatra', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Bandar Lampung', 'Sumatra', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Batam', 'Sumatra', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Bengkulu', 'Sumatra', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Blangkejeren', 'Sumatra', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Binjai', 'Sumatra', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Bireuen', 'Sumatra', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Bukittinggi', 'Sumatra', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Dumai', 'Sumatra', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Jambi', 'Sumatra', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Langsa', 'Sumatra', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Lhokseumawe', 'Sumatra', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Lubuklinggau', 'Sumatra', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Meulaboh', 'Sumatra', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Medan', 'Sumatra', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Metro', 'Sumatra', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Padang', 'Sumatra', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Padang Panjang', 'Sumatra', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Padang Sidempuan', 'Sumatra', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Pagar Alam', 'Sumatra', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Palembang', 'Sumatra', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Pangkal Pinang', 'Sumatra', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Pariaman', 'Sumatra', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Payakumbuh', 'Sumatra', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Pekanbaru', 'Sumatra', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Pematang Siantar', 'Sumatra', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Prabumulih', 'Sumatra', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Sigli', 'Sumatra', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Redelong (Simpang Tiga Redelong)', 'Sumatra', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Sabang', 'Sumatra', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Sawah Lunto', 'Sumatra', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Sibolga', 'Sumatra', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Singkil', 'Sumatra', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Solok', 'Sumatra', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Takengon', 'Sumatra', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Tapaktuan', 'Sumatra', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Tanjung Balai', 'Sumatra', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Tanjung Pinang', 'Sumatra', now(), now());
			INSERT INTO cities (name, island, created_at, updated_at) VALUES ('Tebing Tinggi', 'Sumatra', now(), now());

			INSERT INTO addresses (cityID, name, address, addressnotes, created_at, updated_at) VALUES ('12', 'Rumah', 'Jl. Jalan Blok-198 No. 17', 'Kalo uda sampe kabarin sy di 08121029811', now(), now());
			INSERT INTO addresses (cityID, name, address, addressnotes, created_at, updated_at) VALUES ('12', 'Rumah', 'Jl. Jalan Blok-226 No. 15', 'Jangan bel, nanti berisik', now(), now());
			INSERT INTO addresses (cityID, name, address, addressnotes, created_at, updated_at) VALUES ('71', 'Office', 'Jl. Jalan Blok-421 No. 8', 'Jangan di taruh d depan, di hati sy aja', now(), now());
			INSERT INTO addresses (cityID, name, address, addressnotes, created_at, updated_at) VALUES ('12', 'Kost', 'Jl. Jalan Blok-555 No. 20', 'Jangan jangan ada tuyulnya', now(), now());
			INSERT INTO addresses (cityID, name, address, addressnotes, created_at, updated_at) VALUES ('90', 'Kantor', 'Jl. Jalan Blok-393 No. 9', 'Jangan itu pedes woi', now(), now());
			INSERT INTO addresses (cityID, name, address, addressnotes, created_at, updated_at) VALUES ('20', 'Rumah', 'Jl. Jalan Blok-142 No. 12', 'Jangan di luar aja, masa cuma melotot', now(), now());
			INSERT INTO addresses (cityID, name, address, addressnotes, created_at, updated_at) VALUES ('12', 'Home', 'Jl. Jalan Blok-234 No. 13', '', now(), now());
			INSERT INTO addresses (cityID, name, address, addressnotes, created_at, updated_at) VALUES ('79', 'Kost', 'Jl. Jalan Blok-270 No. 6', '', now(), now());
			INSERT INTO addresses (cityID, name, address, addressnotes, created_at, updated_at) VALUES ('22', 'Home', 'Jl. Jalan Blok-209 No. 7', '', now(), now());
			INSERT INTO addresses (cityID, name, address, addressnotes, created_at, updated_at) VALUES ('12', 'Villa', 'Jl. Jalan Blok-324 No. 8', '', now(), now());
			INSERT INTO addresses (cityID, name, address, addressnotes, created_at, updated_at) VALUES ('23', 'Rumah A', 'Jl. Jalan Blok-242 No. 8', '', now(), now());
			INSERT INTO addresses (cityID, name, address, addressnotes, created_at, updated_at) VALUES ('10', 'Rumah B', 'Jl. Jalan Blok-148 No. 1', '', now(), now());
			INSERT INTO addresses (cityID, name, address, addressnotes, created_at, updated_at) VALUES ('26', 'Kost A', 'Jl. Jalan Blok-147 No. 10', '', now(), now());
			INSERT INTO addresses (cityID, name, address, addressnotes, created_at, updated_at) VALUES ('64', 'Kost B', 'Jl. Jalan Blok-648 No. 9', '', now(), now());
			INSERT INTO addresses (cityID, name, address, addressnotes, created_at, updated_at) VALUES ('3', 'Office A', 'Jl. Jalan Blok-973 No. 11', '', now(), now());
			INSERT INTO addresses (cityID, name, address, addressnotes, created_at, updated_at) VALUES ('12', 'Office B', 'Jl. Jalan Blok-810 No. 8', '', now(), now());
			INSERT INTO addresses (cityID, name, address, addressnotes, created_at, updated_at) VALUES ('12', 'Apt.', 'Jl. Jalan Blok-852 No. 14', '', now(), now());
			INSERT INTO addresses (cityID, name, address, addressnotes, created_at, updated_at) VALUES ('66', 'Rahayu Printing', 'Jl. Jalan Blok-808 No. 6', '', now(), now());
			INSERT INTO addresses (cityID, name, address, addressnotes, created_at, updated_at) VALUES ('92', 'POM Bensin', 'Jl. Jalan Blok-790 No. 2', '', now(), now());
			INSERT INTO addresses (cityID, name, address, addressnotes, created_at, updated_at) VALUES ('12', 'Panca Warna', 'Jl. Jalan Blok-756 No. 1', '', now(), now());

			INSERT INTO customeraddresses (customerID, addressID, created_at, updated_at) VALUES ('1', '1', now(), now());
			INSERT INTO customeraddresses (customerID, addressID, created_at, updated_at) VALUES ('1', '2', now(), now());
			INSERT INTO customeraddresses (customerID, addressID, created_at, updated_at) VALUES ('1', '3', now(), now());
			INSERT INTO customeraddresses (customerID, addressID, created_at, updated_at) VALUES ('2', '1', now(), now());
			INSERT INTO customeraddresses (customerID, addressID, created_at, updated_at) VALUES ('3', '3', now(), now());
			INSERT INTO customeraddresses (customerID, addressID, created_at, updated_at) VALUES ('4', '3', now(), now());

			INSERT INTO companyaddresses (companyID, addressID, created_at, updated_at) VALUES ('1', '1', now(), now());
			INSERT INTO companyaddresses (companyID, addressID, created_at, updated_at) VALUES ('1', '2', now(), now());
			INSERT INTO companyaddresses (companyID, addressID, created_at, updated_at) VALUES ('1', '3', now(), now());
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
