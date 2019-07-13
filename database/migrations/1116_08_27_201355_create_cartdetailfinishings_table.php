<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartdetailfinishingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TABLE cartdetailfinishings(
                id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
                cartdetailID INT UNSIGNED NOT NULL,
                finishingID INT UNSIGNED NOT NULL,
                optionID INT UNSIGNED NOT NULL,
                quantity INT UNSIGNED NOT NULL,
                buyprice NUMERIC(10, 2) NOT NULL,
                sellprice NUMERIC(10, 2) NOT NULL,
                side TINYINT UNSIGNED NOT NULL,
                created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP NULl
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
        DB::unprepared("DROP TABLE IF EXISTS cartdetailfinishings");
    }
}
