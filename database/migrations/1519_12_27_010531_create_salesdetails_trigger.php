<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesdetailsTrigger extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("

			CREATE TRIGGER inittotal_onupdate 
				AFTER UPDATE ON salesdetails
				FOR EACH ROW 

			BEGIN

				DECLARE done INT DEFAULT FALSE;
				DECLARE salesdetailID INT DEFAULT 0;
				DECLARE salesheaderID INT DEFAULT (SELECT salesID 
						FROM salesdetails 
						WHERE id = NEW.id);
				DECLARE cartID INT;
				DECLARE salesdetail_cur CURSOR FOR 
					SELECT sd.id
					FROM salesdetails sd 
						JOIN cartheaders ch ON sd.cartID = ch.id
					WHERE sd.salesID = salesheaderID;
				DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

				OPEN salesdetail_cur;

				UPDATE salesheaders sh
						JOIN salesdetails sd ON sh.id = sd.salesID
						JOIN cartheaders ch ON sd.cartID = ch.id
				SET sh.totalprice = 0
				WHERE sd.id = NEW.id;

				update_loop: LOOP

					FETCH salesdetail_cur INTO salesdetailID;
					IF done THEN
						LEAVE update_loop;
					END IF;
					
					UPDATE 
						salesheaders sh 
							JOIN salesdetails sd ON sh.id = sd.salesID 
							JOIN cartheaders ch ON sd.cartID = ch.id 
					SET 
						sh.totalprice = sh.totalprice + ch.printprice + ch.deliveryprice - ch.discount 
					WHERE
						sd.id = salesdetailID;
				

				END LOOP;

			END;



			CREATE TRIGGER inittotal_oninsert 
				AFTER INSERT ON salesdetails
				FOR EACH ROW 

			BEGIN

				DECLARE done INT DEFAULT FALSE;
				DECLARE salesdetailID INT DEFAULT 0;
				DECLARE salesheaderID INT DEFAULT (SELECT salesID 
						FROM salesdetails 
						WHERE id = NEW.id);
				DECLARE cartID INT;
				DECLARE salesdetail_cur CURSOR FOR 
					SELECT sd.id
					FROM salesdetails sd 
						JOIN cartheaders ch ON sd.cartID = ch.id
					WHERE sd.salesID = salesheaderID;
				DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

				OPEN salesdetail_cur;

				UPDATE salesheaders sh
						JOIN salesdetails sd ON sh.id = sd.salesID
						JOIN cartheaders ch ON sd.cartID = ch.id
				SET sh.totalprice = 0
				WHERE sd.id = NEW.id;

				update_loop: LOOP

					FETCH salesdetail_cur INTO salesdetailID;
					IF done THEN
						LEAVE update_loop;
					END IF;
					
					UPDATE 
						salesheaders sh 
							JOIN salesdetails sd ON sh.id = sd.salesID 
							JOIN cartheaders ch ON sd.cartID = ch.id 
					SET 
						sh.totalprice = sh.totalprice + ch.printprice + ch.deliveryprice - ch.discount 
					WHERE
						sd.id = salesdetailID;
				

				END LOOP;

			END;
		");
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::unprepared("
			DROP TRIGGER IF EXISTS inittotal_onupdate;
			DROP TRIGGER IF EXISTS inittotal_oninsert;
		");
	}
}
