<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobtypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TABLE jobtypes(
                id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
                name VARCHAR(64),
                indoname VARCHAR(64),
                colorcode VARCHAR(8),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP NULL DEFAULT NULL
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
        DB::unprepared("        
            DROP TABLE IF EXISTS jobtypes;
        ");
    }
}
