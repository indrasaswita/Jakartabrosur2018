<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalespaymentverifTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::unprepared("
            CREATE TABLE salespaymentverifs (
                id INT PRIMARY KEY AUTO_INCREMENT,
                paymentID INT UNSIGNED NOT NULL,
                customerbankaccID INT UNSIGNED DEFAULT NULL,
                note VARCHAR(128) NOT NULL DEFAULT '',
                employeeID INT UNSIGNED NOT NULL,
                veriftime DATETIME NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP NULL
            );
        ");

        //DB::statement('ALTER TABLE salespaymentverifs DROP PRIMARY KEY, ADD PRIMARY KEY (id, salesID, paymentID)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('salespaymentverifs');
    }
}
