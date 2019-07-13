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
        Schema::create('salespaymentverifs', function(Blueprint $table){
            $table->engine="InnoDB";
            $table->increments('id');
            $table->integer('paymentID')->unsigned();
            //$table->primary('paymentID');
            $table->string('note');
            $table->integer('employeeID')->unsigned();
            $table->datetime('veriftime');
            $table->timestamps();
        });

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
