<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalespaymentsTrigger extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("

			CREATE TRIGGER setpayment_onupdate 
				AFTER UPDATE ON salespayments
				FOR EACH ROW 

			BEGIN

				DECLARE done INT DEFAULT FALSE;
				DECLARE temppay INT DEFAULT 0;
				DECLARE tempsalesid INT;
				DECLARE cartID INT;
				DECLARE salespayment_cur CURSOR FOR 
					SELECT sp.ammount, sh.id
					FROM salespayments sp
						JOIN salesheaders sh ON sp.salesID = sh.id
					WHERE sp.id = NEW.id;
				DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

				OPEN salespayment_cur;

				UPDATE salesheaders sh
						JOIN salespayments sp ON sh.id = sp.salesID
				SET sh.totalpayment = 0
				WHERE sp.id = NEW.id;

				update_loop: LOOP

					FETCH salespayment_cur INTO temppay, tempsalesid;
					IF done THEN
						LEAVE update_loop;
					END IF;
					
					UPDATE salesheaders 
					SET totalpayment = totalpayment + temppay
					WHERE id = tempsalesid;
				

				END LOOP;

			END;


			CREATE TRIGGER setpayment_oninsert 
				AFTER INSERT ON salespayments
				FOR EACH ROW 

			BEGIN

				DECLARE done INT DEFAULT FALSE;
				DECLARE temppay INT DEFAULT 0;
				DECLARE tempsalesid INT;
				DECLARE cartID INT;
				DECLARE salespayment_cur2 CURSOR FOR 
					SELECT sp.ammount, sh.id
					FROM salespayments sp
						JOIN salesheaders sh ON sp.salesID = sh.id
					WHERE sp.id = NEW.id;
				DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

				OPEN salespayment_cur2;

				UPDATE salesheaders sh
						JOIN salespayments sp ON sh.id = sp.salesID
				SET sh.totalpayment = 0
				WHERE sp.id = NEW.id;

				update_loop: LOOP

					FETCH salespayment_cur2 INTO temppay, tempsalesid;
					IF done THEN
						LEAVE update_loop;
					END IF;
					
					UPDATE salesheaders 
					SET totalpayment = totalpayment + temppay
					WHERE id = tempsalesid;
				

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
			DROP TRIGGER IF EXISTS setpayment_onupdate;
			DROP TRIGGER IF EXISTS setpayment_oninsert;
		");
	}
}
