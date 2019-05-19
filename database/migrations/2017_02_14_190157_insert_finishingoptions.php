<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertFinishingoptions extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('1', '1', 'Matte Laminate', '0.22', 'cm', '200000', '25000', '1', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('2', '1', 'Matte Laminate 2 sisi', '0.44', 'cm', '200000', '25000', '1', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('3', '1', 'Glossy Laminate', '0.2', 'cm', '200000', '25000', '1', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('4', '1', 'Glossy Laminate 2 sisi', '0.4', 'cm', '200000', '25000', '1', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('5', '1', 'Varnish', '0.15', 'cm', '175000', '25000', '1', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('6', '1', 'Varnish 2 sisi', '0.3', 'cm', '175000', '25000', '1', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('7', '1', 'Spot Varnish & Matte Laminate', '0.55', 'cm', '500000', '150000', '2', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('8', '1', 'Spot Varnish & Matte Laminate 2 sisi', '0.77', 'cm', '500000', '150000', '2', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('9', '1', 'Spot Varnish 2 sisi & Matte Laminate 2 sisi', '1.1', 'cm', '500000', '150000', '2', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('10', '2', 'Emboss', '2.5', 'cm', '350000', '150000', '2', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('11', '2', 'Deboss', '2.5', 'cm', '350000', '150000', '2', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('12', '3', 'Gold Glossy 1 sisi', '3', 'cm', '400000', '200000', '2', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('13', '3', 'Gold Matte 1 sisi', '4', 'cm', '450000', '225000', '3', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('14', '3', 'Silver Glossy 1 sisi', '3', 'cm', '400000', '200000', '2', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('15', '4', '1 lubang sudut atas kiri kertas', '20', 'pcs', '75000', '10000', '1', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('16', '4', '2 lubang sejajar bagian kiri kertas', '30', 'pcs', '75000', '10000', '1', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('17', '4', '3 lubang sejajar bagian kiri kertas', '40', 'pcs', '75000', '10000', '1', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('18', '5', '1 sudut', '100', 'pcs', '0', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('19', '5', '2 sudut', '100', 'pcs', '0', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('20', '5', '3 sudut', '100', 'pcs', '0', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('21', '5', '4 sudut', '100', 'pcs', '0', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('22', '6', '1 garis lurus', '50', 'pcs', '75000', '10000', '1', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('23', '6', '2 garis lurus', '85', 'pcs', '75000', '10000', '1', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('24', '6', '3 garis lurus', '115', 'pcs', '75000', '10000', '1', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('25', '6', '4 garis lurus', '140', 'pcs', '75000', '10000', '1', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('26', '6', '5 garis lurus', '160', 'pcs', '75000', '10000', '1', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('27', '6', '6 garis lurus', '180', 'pcs', '75000', '10000', '1', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('28', '7', 'Lipat 1x', '15', 'pcs', '100000', '0', '1', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('29', '7', 'Lipat 2x (Bentuk Roll)', '25', 'pcs', '100000', '0', '1', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('30', '7', 'Lipat 2x (Bentuk Z)', '25', 'pcs', '100000', '0', '1', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('31', '7', 'Lipat 2x (Bentuk Jendela)', '35', 'pcs', '100000', '0', '1', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('32', '7', 'Lipat 3x', '45', 'pcs', '125000', '0', '1', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('33', '7', 'Lipat 4x', '55', 'pcs', '150000', '0', '1', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('34', '8', 'Lurus (Sudut siku)', '1200', 'kg', '50000', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('35', '8', 'Die Cut (Pon)', '150', 'pcs', '400000', '250000', '2', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('36', '9', 'Standard', '300', 'pcs', '75000', '0', '2', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('37', '10', 'Standard', '30', 'pcs', '75000', '0', '1', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('38', '11', '1 nomor (max 7 digit)', '20', 'pcs', '100000', '0', '1', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('39', '11', '2 nomor (max 7 digit)', '30', 'pcs', '100000', '0', '1', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('40', '11', '3 nomor (max 7 digit)', '40', 'pcs', '100000', '0', '1', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('41', '11', '4 nomor (max 7 digit)', '50', 'pcs', '100000', '0', '1', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('42', '12', 'Standard', '30', 'cm punggung', '-1', '0', '4', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('43', '13', 'Standard', '2500', 'cm punggung', '125000', '0', '1', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('44', '14', 'Manual', '3000', 'pcs', '75000', '0', '1', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('45', '15', 'Matte Laminate', '3500', 'pcs', '0', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('46', '15', 'Matte Laminate 2 sisi', '7000', 'pcs', '0', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('47', '15', 'Glossy Laminate', '3500', 'pcs', '0', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('48', '15', 'Glossy Laminate 2 sisi', '7000', 'pcs', '0', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('49', '16', '1 lubang sudut atas kiri kertas', '20', 'pcs', '50000', '10000', '1', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('50', '16', '2 lubang sejajar bagian kiri kertas', '30', 'pcs', '50000', '10000', '1', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('51', '16', '3 lubang sejajar bagian kiri kertas', '40', 'pcs', '50000', '10000', '1', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('52', '17', '1 sudut', '100', 'pcs', '0', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('53', '17', '2 sudut', '100', 'pcs', '0', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('54', '17', '3 sudut', '100', 'pcs', '0', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('55', '17', '4 sudut', '100', 'pcs', '0', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('56', '18', '1 garis lurus', '50', 'pcs', '75000', '30000', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('57', '18', '2 garis lurus', '85', 'pcs', '75000', '30000', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('58', '18', '3 garis lurus', '115', 'pcs', '75000', '30000', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('59', '19', 'Lipat 1x', '30', 'pcs', '150000', '0', '1', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('60', '19', 'Lipat 2x (Bentuk Surat)', '50', 'pcs', '150000', '0', '1', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('61', '19', 'Lipat 2x (Bentuk Z)', '50', 'pcs', '150000', '0', '1', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('62', '19', 'Lipat 2x (Bentuk Jendela)', '60', 'pcs', '150000', '0', '1', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('63', '19', 'Lipat 3x', '70', 'pcs', '150000', '0', '1', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('64', '20', 'Lurus (Sudut siku)', '2500', 'kg', '35000', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('65', '21', 'Standard', '300', 'pcs', '0', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('66', '22', 'Standard', '30', 'pcs', '0', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('67', '23', '1 nomor / alamat / nama', '20', 'pcs', '50000', '20000', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('68', '23', '2 nomor / alamat / nama', '30', 'pcs', '50000', '20000', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('69', '23', '3 nomor / alamat / nama', '40', 'pcs', '50000', '20000', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('70', '23', '4 nomor / alamat / nama', '50', 'pcs', '50000', '20000', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('71', '23', '5 nomor / alamat / nama', '60', 'pcs', '50000', '20000', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('72', '23', '6 nomor / alamat / nama', '70', 'pcs', '50000', '20000', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('73', '23', '7 nomor / alamat / nama', '80', 'pcs', '50000', '20000', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('74', '23', '>7 nomor / alamat / nama', '85', 'pcs', '50000', '20000', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('75', '24', 'Standard', '15000', 'pcs', '0', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('76', '25', 'Standard', '3000', 'pcs', '75000', '0', '1', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('77', '26', 'Matte Laminate', '50000', 'm', '100000', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('78', '26', 'Glossy Laminate', '50000', 'm', '100000', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('79', '27', 'Tepat Gambar', '0', 'pcs', '0', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('80', '27', 'Lebih 5cm dari gambar', '0', 'pcs', '0', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('81', '27', 'Mata Ayam: seluruh sisi', '0', 'pcs', '0', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('82', '27', 'Selongsong: atas bawah', '0', 'pcs', '0', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('83', '27', 'Selongsong: kiri kanan', '0', 'pcs', '0', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('84', '28', 'X Banner (Bagus)', '30000', 'pcs', '0', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('85', '28', 'Roll-up Banner (Stainless 60x160)', '145000', 'pcs', '0', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('86', '28', 'Roll-up Banner (Alumunium 60x160)', '135000', 'pcs', '0', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('87', '28', 'Roll-up Banner (Alumunium 85x200)', '145000', 'pcs', '0', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('88', '29', 'List Kayu', '50000', 'pcs', '0', '0', '1', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('89', '29', 'List Kayu + Triplek', '100000', 'pcs', '0', '0', '1', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('90', '29', 'List Kayu + Triplek + Kaki Tripod', '250000', 'pcs', '0', '0', '1', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('91', '30', 'Tempel ke Impraboard (recommended)', '185000', 'm', '0', '0', '1', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('92', '30', 'Tempel ke Foamboard', '235000', 'm', '0', '0', '1', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('93', '30', 'Selongsong: Atas bawah', '25000', 'pcs', '0', '0', '1', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('94', '31', '1 set Mika tebal', '999999', 'pcs', '-1', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('95', '32', 'Glossy', '0', 'pcs', '250000', '50000', '2', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('96', '33', 'Emboss', '0', 'pcs', '500000', '0', '2', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('97', '34', 'Hi-Co', '0', 'pcs', '500000', '0', '1', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('98', '35', 'Hardboard Lokal + Linen', '7000', 'pcs', '75000', '0', '2', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('99', '35', 'Hardboard Import + Linen', '9000', 'pcs', '75000', '0', '3', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('100', '35', 'Hardboard Import + Kertas Laminasi', '9500', 'pcs', '200000', '100000', '5', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('101', '36', 'Merah Tua', '0', 'pcs', '0', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('102', '36', 'Biru Tua', '0', 'pcs', '0', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('103', '36', 'Ungu', '0', 'pcs', '0', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('104', '36', 'Hijau Muda', '0', 'pcs', '0', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('105', '36', 'Pink', '0', 'pcs', '0', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('106', '36', 'Hitam', '0', 'pcs', '0', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('107', '36', 'Biru Muda', '0', 'pcs', '0', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('108', '37', 'Merah Tua', '35000', 'pcs', '0', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('109', '37', 'Biru Tua', '35000', 'pcs', '0', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('110', '37', 'Ungu', '35000', 'pcs', '0', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('111', '37', 'Hijau Muda', '35000', 'pcs', '0', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('112', '37', 'Pink', '35000', 'pcs', '0', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('113', '37', 'Hitam', '35000', 'pcs', '0', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('114', '37', 'Biru Muda', '35000', 'pcs', '0', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('115', '38', 'Merah Tua', '35000', 'pcs', '0', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('116', '38', 'Biru Tua', '35000', 'pcs', '0', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('117', '38', 'Ungu', '35000', 'pcs', '0', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('118', '38', 'Hijau Muda', '35000', 'pcs', '0', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('119', '38', 'Pink', '35000', 'pcs', '0', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('120', '38', 'Hitam', '35000', 'pcs', '0', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('121', '38', 'Biru Muda', '35000', 'pcs', '0', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('122', '39', '2-side Tripod', '150000', 'pcs', '0', '0', '0', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('123', '40', 'Standard', '190', 'pcs', '150000', '0', '1', '', now(), now());
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, processdays, info, created_at, updated_at) VALUES ('124', '41', 'Standard', '3000', 'pcs', '35000', '0', '0', '', now(), now());
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
