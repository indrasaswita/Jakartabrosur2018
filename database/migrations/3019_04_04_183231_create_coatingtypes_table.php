<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoatingtypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TABLE coatingtypes(
                id INT PRIMARY KEY AUTO_INCREMENT,
                name VARCHAR(64) NOT NULL COMMENT 'nama keren buat muncul di tampilan customer',
                info VARCHAR(64) NOT NULL COMMENT 'nama lain dari name (nama singkatnya)',
                description VARCHAR(1000) COMMENT 'penjelasan lengkap tentang coating bahan',
                behavior VARCHAR(255) COMMENT 'sifat dasar yang dimunculin di tampilan customer',
                created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP NULL
            );

            ALTER TABLE papers
            ADD COLUMN coatingtypeID INT UNSIGNED NOT NULL COMMENT 'pengaruh ke laminasi, varnish, numerator offset' DEFAULT 1 AFTER perforation; 
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coatingtypes');
    }
}
