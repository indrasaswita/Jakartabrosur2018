bkj<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanybankaccountdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create('companybankaccountdetails', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
        });*/

        DB::unprepared('
            CREATE TABLE companybankaccmutations(
                id INT PRIMARY KEY AUTO_INCREMENT,
                accountID INT UNSIGNED NOT NULL,
                mutationDate DATE NOT NULL,
                mutationNote VARCHAR(255) NOT NULL,
                mutationAmmount INT UNSIGNED NOT NULL, 
                checked TINYINT DEFAULT 0, 
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP NULL
            );
        ');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companybankaccmutations');
    }
}
