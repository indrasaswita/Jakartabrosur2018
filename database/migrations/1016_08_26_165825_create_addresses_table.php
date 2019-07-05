$<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function(Blueprint $table){
            $table->engine="InnoDB";
            $table->increments('id');
            $table->integer('customerID')->unsigned();
            $table->integer('cityID')->unsigned();
            $table->string('name', 32);
            $table->string('address');
            $table->string('receiver', 64);
            $table->string('addressnotes');
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
        Schema::drop('addresses');
    }
}
