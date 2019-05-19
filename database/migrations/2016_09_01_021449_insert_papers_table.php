<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class InsertPapersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
			INSERT INTO papers (papertypeID, name, color, gramature) VALUES ('1', 'ArtPaper', 'Putih', '100');
			INSERT INTO papers (papertypeID, name, color, gramature) VALUES ('1', 'ArtPaper', 'Putih', '120');
			INSERT INTO papers (papertypeID, name, color, gramature) VALUES ('1', 'ArtPaper', 'Putih', '150');
			INSERT INTO papers (papertypeID, name, color, gramature) VALUES ('2', 'ArtCarton', 'Putih', '190');
			INSERT INTO papers (papertypeID, name, color, gramature) VALUES ('2', 'ArtCarton', 'Putih', '210');
			INSERT INTO papers (papertypeID, name, color, gramature) VALUES ('2', 'ArtCarton', 'Putih', '230');
			INSERT INTO papers (papertypeID, name, color, gramature) VALUES ('2', 'ArtCarton', 'Putih', '260');
			INSERT INTO papers (papertypeID, name, color, gramature) VALUES ('2', 'ArtCarton', 'Putih', '310');
			INSERT INTO papers (papertypeID, name, color, gramature) VALUES ('2', 'ArtCarton', 'Putih', '350');
			INSERT INTO papers (papertypeID, name, color, gramature) VALUES ('3', 'Kertas HVS', 'Putih', '70');
			INSERT INTO papers (papertypeID, name, color, gramature) VALUES ('3', 'Kertas HVS', 'Putih', '80');
			INSERT INTO papers (papertypeID, name, color, gramature) VALUES ('3', 'Kertas HVS', 'Putih', '100');
			INSERT INTO papers (papertypeID, name, color, gramature) VALUES ('4', 'Bluish White (BW)', 'Putih', '250');
			INSERT INTO papers (papertypeID, name, color, gramature) VALUES ('4', 'Linen', 'Putih', '250');
			INSERT INTO papers (papertypeID, name, color, gramature) VALUES ('5', 'Samson Kraft Lokal', 'Coklat Tua', '70');
			INSERT INTO papers (papertypeID, name, color, gramature) VALUES ('5', 'Samson Kraft Lokal', 'Coklat Tua', '80');
			INSERT INTO papers (papertypeID, name, color, gramature) VALUES ('5', 'Samson Kraft Lokal', 'Coklat Tua', '280');
			INSERT INTO papers (papertypeID, name, color, gramature) VALUES ('6', 'Kertas HVS NCR', 'Putih', '60');
			INSERT INTO papers (papertypeID, name, color, gramature) VALUES ('6', 'Kertas HVS NCR', 'Merah', '60');
			INSERT INTO papers (papertypeID, name, color, gramature) VALUES ('6', 'Kertas HVS NCR', 'Kuning', '60');
			INSERT INTO papers (papertypeID, name, color, gramature) VALUES ('6', 'Kertas HVS NCR', 'Biru', '60');
			INSERT INTO papers (papertypeID, name, color, gramature) VALUES ('6', 'Kertas HVS NCR', 'Hijau', '60');
			INSERT INTO papers (papertypeID, name, color, gramature) VALUES ('3', 'Concorde', 'Putih', '90');
			INSERT INTO papers (papertypeID, name, color, gramature) VALUES ('3', 'Concorde', 'Ivory', '90');
			INSERT INTO papers (papertypeID, name, color, gramature) VALUES ('7', 'Flexy China 300g Murni', 'Putih', '0');
			INSERT INTO papers (papertypeID, name, color, gramature) VALUES ('7', 'Flexy China 270g Murni', 'Putih', '0');
			INSERT INTO papers (papertypeID, name, color, gramature) VALUES ('7', 'Flexy Korea 440g Haleed', 'Putih', '0');
			INSERT INTO papers (papertypeID, name, color, gramature) VALUES ('9', 'Albatros', 'Putih', '0');
			INSERT INTO papers (papertypeID, name, color, gramature) VALUES ('9', 'Luster', 'Putih', '0');
			INSERT INTO papers (papertypeID, name, color, gramature) VALUES ('9', 'Flexy Korea 330g Grayback', 'Putih', '0');
			INSERT INTO papers (papertypeID, name, color, gramature) VALUES ('8', 'PVC Plastic 0.8mm', 'Putih', '0');

			INSERT INTO papers (papertypeID, name, color, gramature) VALUES ('10', 'Sticker Cromo', 'Putih', '403');
			INSERT INTO papers (papertypeID, name, color, gramature) VALUES ('10', 'Sticker Vinyl Digital', 'Putih', '463');
			INSERT INTO papers (papertypeID, name, color, gramature) VALUES ('10', 'Sticker Vinyl Premium', 'Putih', '0');
			INSERT INTO papers (papertypeID, name, color, gramature) VALUES ('10', 'Sticker Transp Digital', 'Transparent', '488');
			INSERT INTO papers (papertypeID, name, color, gramature) VALUES ('10', 'Sticker Transp Premium', 'Transparent', '0');
			INSERT INTO papers (papertypeID, name, color, gramature) VALUES ('10', 'Sticker HVS', 'Putih', '325');
			INSERT INTO papers (papertypeID, name, color, gramature) VALUES ('10', 'Sticker Cromo Premium', '', '420');

			UPDATE papers
				SET numerator = 1
				WHERE papertypeID = 3;

			UPDATE papers
				SET folding = 1
				WHERE papertypeID <= 3;

			UPDATE papers
				SET laminating = 1
				WHERE gramature > 150;

			UPDATE papers
				SET spotuv = 1
				WHERE laminating = 1;

			UPDATE papers
				SET varnish = 1
				WHERE papertypeID = 2;

			UPDATE papers
				SET texture = 1
				WHERE papertypeID <= 2;

			UPDATE papers
				SET texture = 2
				WHERE papertypeID = 3;

			UPDATE papers
				SET perforation = 1
				WHERE papertypeID = 3 AND gramature = 100;

			UPDATE papers
				SET perforation = 1
				WHERE papertypeID = 2 OR papertypeID = 1;
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
