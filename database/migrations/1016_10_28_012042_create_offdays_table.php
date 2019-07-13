<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffdaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offdays', function(Blueprint $table){
            $table->engine="InnoDB";
            $table->increments('id');
            $table->integer('employeeID')->unsigned();
            $table->date('offday');
            $table->time('starttime');
            $table->time('endtime');
            $table->string('description', 128);
            $table->tinyinteger('status')->unsigned()->comment('kalo 0: ga kerja, ga bisa ambil. 1: ga kerja, bisa ambil. 2: kerja, ga bisa ambil');
            $table->timestamps();
        });
        //DB::statement('ALTER TABLE addresses DROP PRIMARY KEY, ADD PRIMARY KEY (customeraddressID, customerID);');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offdays');
    }
}
