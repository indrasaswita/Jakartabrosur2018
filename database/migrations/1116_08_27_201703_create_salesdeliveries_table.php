<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesdeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salesdeliveries', function(Blueprint $table){
            $table->engine="InnoDB";
            $table->increments('id');
            $table->integer('salesID')->unsigned();
            $table->integer('deliveryID')->unsigned();
            $table->integer('employeeID')->unsigned()->nullable();
            $table->integer('addressID')->unsigned()->nullable();
            $table->string('receiver', 64)->nullable();
            $table->string('customernote')->nullable();
            $table->string('employeenote')->nullable();
            $table->string('suratimage', 128)->nullable();
            $table->string('suratno', 128)->nullable();
            $table->datetime('arrivedtime');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salesdeliveries');
    }
}
