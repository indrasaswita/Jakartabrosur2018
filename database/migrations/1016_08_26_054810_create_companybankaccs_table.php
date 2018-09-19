<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanybankaccsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companybankaccs', function(Blueprint $table){
            $table->engine="InnoDB";
            $table->increments('id');
            $table->integer('bankID')->unsigned();
            $table->foreign('bankID')->references('id')->on('banks');
            $table->string('accname', 32);
            $table->string('accno', 32);
            $table->string('acclocation', 32);
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
        Schema::drop('companybankaccs');
    }
}
