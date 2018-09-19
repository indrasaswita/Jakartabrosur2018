<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinishingoptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
                CREATE TABLE finishingoptions(
                    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
                    finishingID INT UNSIGNED,
                    optionname VARCHAR(32),
                    price NUMERIC(10, 2),
                    priceper VARCHAR(8),
                    priceminim INT UNSIGNED,
                    pricebase INT UNSIGNED,
                    processdays TINYINT UNSIGNED DEFAULT 1,
                    info VARCHAR(255),
                    FOREIGN KEY (finishingID) REFERENCES finishings(id) ON UPDATE CASCADE ON DELETE CASCADE
                );
            ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP TABLE finishingoptions");
    }
}
