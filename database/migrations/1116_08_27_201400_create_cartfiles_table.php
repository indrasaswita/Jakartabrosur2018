<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cartfiles', function(Blueprint $table){
            $table->increments('id');
            $table->integer('fileID')->unsigned();
            $table->foreign('fileID')->references('id')->on('files');
            $table->integer('cartID')->unsigned();
            $table->foreign('cartID')->references('id')->on('cartheaders');
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
        Schema::drop('cartfiles');
    }
}
