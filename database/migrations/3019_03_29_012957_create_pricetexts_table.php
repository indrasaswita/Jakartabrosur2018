<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
//use DB;

class CreatePricetextsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::unprepared("
            CREATE TABLE pricetexts(
                id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
                jobsubtypeID INT UNSIGNED NULL,
                customerID INT UNSIGNED NULL,
                employeeID INT UNSIGNED NULL,
                pricetext VARCHAR(10240) NOT NULL,
                totalprice NUMERIC(10,2) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
                updated_at TIMESTAMP NULL
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
        Schema::dropIfExists('pricetexts');
    }
}
