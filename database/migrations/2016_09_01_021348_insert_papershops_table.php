<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertPapershopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            INSERT INTO vendors VALUES('0', 'Indo Jaya', '02142879120', '', 'Jl. Kali Baru Timur VI No.6A, RT.1/RW.9, Bungur, Kemayoran, Jakarta Pusat, Jakarta 10650', '', 'paper', now(), now());
            INSERT INTO vendors VALUES('0', 'Suryapalace Jaya', '0216249122', '0216249121', 'Jl. K.H. Moh. Mansyur No.208, RT.1/RW.7, Tanah Sereal, Tambora, Jakarta Barat, Jakarta 11210', 'Rahma', 'paper', now(), now());
            INSERT INTO vendors VALUES('0', 'Paperina', '02165300085', '02165832530', 'Jl. Sunter Agung Utara D7 No.19, RT.5/RW.18, Sunter Agung, Tj. Priok, Jakarta Utara, Jakarta 14350', '', 'paper', now(), now());
            INSERT INTO vendors VALUES('0', 'Fortuna Fancy', '02165310617', '02165310620', 'Rukan Puri Mutiara Blok A No.126, Sunter Griya, Tanjung Priok, RT.2/RW.5, Sunter Agung, Jakarta Utara, Jakarta 15155', '', 'paper', now(), now());
            INSERT INTO vendors VALUES('0', 'Embossindo Toko 3', '0216900256', '0216900258', 'Jl. Toko Tiga No.28, RT.7/RW.3, Roa Malaka, Tambora, Jakarta Barat, Jakarta 11230', '', 'paper', now(), now());
            INSERT INTO vendors VALUES('0', 'Kemenangan Senen', '0214219400', '0214210125', 'Jl. Gunung Sahari Raya No.98, RT.11/RW.8, Gn. Sahari Sel., Kemayoran, Jakarta Pusat, Jakarta 10610', '', 'paper', now(), now());
            INSERT INTO vendors VALUES('0', 'Kemenangan Kebayoran', '0217205524', '02156940448', 'Jalan Baru No.3, RT.10/RW.3, Kebayoran Lama Utara, Kebayoran Lama, Jakarta Selatan, Jakarta 12240', '', 'paper', now(), now());
            INSERT INTO vendors VALUES('0', 'Bintang Timur Bungur', '', '', 'Jl. Bungur Besar Raya No.41, Gn. Sahari Sel., Kemayoran, Jakarta Pusat, Jakarta 10610', '', 'paper', now(), now());
            INSERT INTO vendors VALUES('0', 'Bintang Timur Senen', '0214224442', '0214219236', '', '', 'paper', now(), now());
            INSERT INTO vendors VALUES('0', 'Tropi', '0214256143', '0214256963', 'Jl. Kalibaru Barat No. 158 RT012/RW001, Kebon Kosong, Kemayoran, Jakarta Pusat, Jakarta 10630', '', 'paper', now(), now());
            INSERT INTO vendors VALUES('0', 'Pentamapan Cemerlang', '0213800070', '0213858292', 'Jl. Batu Tulis XIII No. 25, Kebon Kelapa, Gambir, Jakarta Pusat, Jakarta 10120', '', 'paper', now(), now());
            INSERT INTO vendors VALUES('0', 'Paper Gallery', '02166673015', '', 'Ruko CBD Pluit Blok C No. 2, Jl. Pluit Selatan Raya, RT.21/RW.8, Penjaringan, Jakarta Utara, Jakarta 14450', '', 'paper', now(), now());
            INSERT INTO vendors VALUES('0', 'Mobile Display', '081316366279', '02166602288', '', 'Kartini', 'banner', now(), now());
            INSERT INTO vendors VALUES('0', 'Multiviscomindo', '08111932333', '0217376530', 'Jl. Deplu Raya No.7, RT.1/RW.3, Bintaro, Pesanggrahan, Jakarta Selatan, Jakarta 12330', 'Enif', 'banner', now(), now());
            INSERT INTO vendors VALUES('0', 'Sanserita Jaya', '081514246479', '0213861857', '', 'Catur', 'finishing', now(), now());
            INSERT INTO vendors VALUES('0', 'Wonder Bind Indonesia', '087880881930', '081286534600', '', 'Rudy', 'finishing', now(), now());
            INSERT INTO vendors VALUES('0', 'Quantac', '08551110888', '02129236020', '', 'Denny', 'paper', now(), now());
            INSERT INTO vendors VALUES('0', 'Edi Efendi', '081281113658', '081617101694', '', '', 'finishing', now(), now());
            INSERT INTO vendors VALUES('0', 'Asah Pisau Polar', '0215413639', '', '', '', 'finishing', now(), now());
            INSERT INTO vendors VALUES('0', 'Andy Solusi Grafika', '0818860014', '081319192304', '', '', 'sparepart', now(), now());
            INSERT INTO vendors VALUES('0', 'Cutting Sticker Shop', '', '', '', '', 'paper', now(), now());
            INSERT INTO vendors VALUES('0', 'Sanyo Stempel', '087877707702', '', '', '', 'paper', now(), now());
            INSERT INTO vendors VALUES('0', 'Taufik Montir SM', '081381885287', '', '', '', 'sparepart', now(), now());
            INSERT INTO vendors VALUES('0', 'Sumantri Montir Valve', '081288949599', '', '', '', 'sparepart', now(), now());
            INSERT INTO vendors VALUES('0', 'Printmate Bahan', '089520124807', '', '', 'Reni', 'sparepart', now(), now());
            INSERT INTO vendors VALUES('0', 'Rahayu PVC', '', '', '', 'PVC', 'paper', now(), now());
            INSERT INTO vendors VALUES('0', 'Shopping Bag Pasar Pagi Enci Beni', '087871302880', '', '', '', 'Paper Bag', now(), now());
            INSERT INTO vendors VALUES('0', 'Tas Belanja Indonesia', '089661460390', '', '', '', 'Paper Bag', now(), now());
            INSERT INTO vendors VALUES('0', 'Shopping Bag', '02154353085', '081315632029', 'Tangerang', 'Agustus Adiwirya', 'Paper Bag', now(), now());
            INSERT INTO vendors VALUES('0', 'Maman Pulpen', '081399163231', '', 'Pasar Pagi', 'Maman', 'ballpoint', now(), now());
            INSERT INTO vendors VALUES('0', 'Anugrah Jaya', '08988003365', '082114041381', 'Pasar Pagi', 'Wandi', 'ballpoint', now(), now());
            INSERT INTO vendors VALUES('0', 'Cemerlang Abadi', '081258038989', '', 'Pasar Pagi', '', 'ballpoint + pin', now(), now());
            INSERT INTO vendors VALUES('0', 'Armada Printing', '081311222566', '', 'Manggarai', 'Pak Rian', 'PVC Supplier', now(), now());
            INSERT INTO vendors VALUES('0', 'Puma Printing', '0818676887', '', 'Teluk Gong', '', 'Standing Tripod', now(), now());
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
