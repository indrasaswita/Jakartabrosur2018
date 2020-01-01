<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartheadersTrigger extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("

			CREATE TRIGGER settotal_onupdate 
				AFTER UPDATE ON cartheaders
				FOR EACH ROW 

			BEGIN

				DECLARE done INT DEFAULT FALSE;
				DECLARE salesdetailID INT DEFAULT 0;
				DECLARE salesheaderID INT DEFAULT (SELECT salesID 
						FROM salesdetails 
						WHERE cartID = NEW.id);
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
				SET sh.totalprice = 4
				WHERE ch.id = NEW.id;

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


			CREATE TRIGGER settotal_oninsert 
				AFTER INSERT ON cartheaders
				FOR EACH ROW 

			BEGIN

				DECLARE done INT DEFAULT FALSE;
				DECLARE salesdetailID INT DEFAULT 0;
				DECLARE salesheaderID INT DEFAULT (SELECT salesID 
						FROM salesdetails 
						WHERE cartID = NEW.id);
				DECLARE cartID INT;
				DECLARE salesdetail_cur2 CURSOR FOR 
					SELECT sd.id
					FROM salesdetails sd 
						JOIN cartheaders ch ON sd.cartID = ch.id
					WHERE sd.salesID = salesheaderID;
				DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

				OPEN salesdetail_cur2;

				UPDATE salesheaders sh
						JOIN salesdetails sd ON sh.id = sd.salesID
						JOIN cartheaders ch ON sd.cartID = ch.id
				SET sh.totalprice = 3
				WHERE ch.id = NEW.id;

				update_loop: LOOP

					FETCH salesdetail_cur2 INTO salesdetailID;
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
			DROP TRIGGER IF EXISTS settotal_onupdate;
			DROP TRIGGER IF EXISTS settotal_oninsert;
		");
	}
}
