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
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('1', '1', 'Matte (doff) 1 sisi', '0.22', 'cm', '200000', '0', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('2', '1', 'Matte (doff) 2 sisi', '0.44', 'cm', '200000', '0', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('3', '1', 'Glossy 1 sisi', '0.2', 'cm', '200000', '0', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('4', '1', 'Glossy 2 sisi', '0.4', 'cm', '200000', '0', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('5', '2', '1 garis', '50', 'pcs', '125000', '50000', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('6', '2', '2 garis', '85', 'pcs', '125000', '50000', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('7', '2', 'custom', '150', 'pcs', '350000', '150000', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('8', '3', '1 mata', '10', 'pcs', '150000', '25000', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('9', '3', '2 mata', '20', 'pcs', '150000', '25000', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('10', '3', '3 mata', '30', 'pcs', '150000', '25000', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('11', '3', '4 mata', '40', 'pcs', '150000', '25000', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('12', '3', '5 mata', '50', 'pcs', '150000', '25000', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('13', '3', '6 mata', '60', 'pcs', '150000', '25000', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('14', '4', 'Varnish Glossy', '0.15', 'cm', '150000', '25000', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('15', '5', '1x Lipat', '15', 'pcs', '150000', '0', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('16', '5', '2x Lipat Sejajar (Z)', '25', 'pcs', '150000', '0', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('17', '5', '2x Lipat Sejajar (Roll)', '25', 'pcs', '150000', '0', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('18', '5', '2x Lipat Sejajar (Jendela)', '30', 'pcs', '150000', '0', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('19', '5', '3x Lipat ', '40', 'pcs', '150000', '0', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('20', '5', '4x Lipat', '50', 'pcs', '150000', '0', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('21', '6', 'Standard', '1000', 'kg', '35000', '10000', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('22', '7', 'Staples', '200', 'pcs', '100000', '25000', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('23', '7', 'Spiral Kawat', '50', 'cm', '150000', '0', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('24', '7', 'Lem Panas', '30', 'cm', '400000', '50000', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('25', '8', 'Standard', '100', 'pcs', '350000', '200000', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('26', '9', 'Standard', '200', 'pcs', '250000', '25000', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('27', '10', 'Glossy 2 sisi', '250', 'pcs', '150000', '0', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('28', '11', 'Permeter', '0', 'pcs', '0', '0', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('29', '11', 'Per-stengah meter', '250', 'm', '0', '0', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('30', '12', 'Rollup Aluminium 60x160', '100000', 'pcs', '0', '0', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('31', '12', 'Rollup Aluminium 85x200', '115000', 'pcs', '0', '0', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('32', '12', 'Rollup Stainless 60x160', '110000', 'pcs', '0', '0', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('33', '12', 'Rollup Stainless 85x200', '125000', 'pcs', '0', '0', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('34', '18', 'X Fiber 60x160 Fixed', '15000', 'pcs', '0', '0', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('35', '13', 'Gold Glossy', '3', 'cm', '350000', '100000', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('36', '13', 'Gold Matte', '4', 'cm', '350000', '100000', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('37', '13', 'Silver Glossy', '3', 'cm', '350000', '100000', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('38', '13', 'Silver Matte', '4', 'cm', '350000', '100000', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('39', '13', 'Red', '4.5', 'cm', '350000', '100000', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('40', '13', 'Blue', '4.5', 'cm', '350000', '100000', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('41', '14', 'Emboss', '2', 'cm', '150000', '100000', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('42', '14', 'Deboss', '2', 'cm', '150000', '100000', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('43', '15', 'Spot UV 1 sisi', '0.28', 'cm', '200000', '100000', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('44', '15', 'Spot UV 2 sisi', '0.56', 'cm', '200000', '100000', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('45', '16', 'Lipat Seluruh Sisi', '3000', 'm', '0', '0', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('46', '16', 'Potong Tepat Gambar', '500', 'm', '0', '0', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('47', '16', 'Selongsong', '2000', 'm', '0', '0', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('48', '17', 'Matte (Doff)', '40000', 'm', '100000', '30000', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('49', '17', 'Glossy', '40000', 'm', '100000', '30000', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('50', '19', 'Board Import 0.15mm + Linen', '13000', 'pcs', '130000', '0', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('51', '19', 'Board Import 0.15mm + Laminating Doff', '14500', 'pcs', '145000', '0', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('52', '19', 'Board Import 0.2mm + Linen', '14000', 'pcs', '140000', '0', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('53', '19', 'Board Import 0.2mm + Laminating Doff', '15500', 'pcs', '155000', '0', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('54', '19', 'Board Import 0.25mm + Linen', '15000', 'pcs', '150000', '0', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('55', '19', 'Board Import 0.25mm + Laminating Doff', '16500', 'pcs', '165000', '0', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('56', '19', 'Board Lokal 0.15mm + Linen', '6000', 'pcs', '60000', '0', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('57', '19', 'Board Lokal 0.15mm + Laminating Doff', '7500', 'pcs', '75000', '0', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('58', '19', 'Board Lokal 0.2mm + Linen', '6500', 'pcs', '65000', '0', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('59', '19', 'Board Lokal 0.2mm + Laminating Doff', '8000', 'pcs', '80000', '0', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('60', '19', 'Board Lokal 0.25mm + Linen', '7000', 'pcs', '70000', '0', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('61', '19', 'Board Lokal 0.25mm + Laminating Doff', '8500', 'pcs', '85000', '0', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('62', '20', 'Spiral Hitam Full', '0', 'pcs', '0', '0', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('63', '20', 'Spiral Hitam 2 Bagian', '0', 'pcs', '0', '0', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('64', '20', 'Spiral Putih Full', '0', 'pcs', '0', '0', '');
			INSERT INTO finishingoptions(id, finishingID, optionname, price, priceper, priceminim, pricebase, info) VALUES ('65', '20', 'Spiral Putih 2 Bagian', '0', 'pcs', '0', '0', '');
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
