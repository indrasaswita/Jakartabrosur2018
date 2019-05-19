<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAicesalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aicesales', function(Blueprint $table){
            $table->engine="InnoDB";
            $table->increments('id');
            $table->integer('icecreamID')->unsigned();
            $table->foreign('icecreamID')->references('id')->on('icecreams');
            $table->integer('sellprice')->unsigned();
            $table->smallinteger('qty');
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
        Schema::dropIfExists('aicesales');
    }
}
