<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerbankaccsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customerbankaccs', function(Blueprint $table){
            $table->engine="InnoDB";
            $table->increments('id');
            $table->integer('customerID')->unsigned();
            $table->foreign('customerID')->references('id')->on('customers');
            $table->integer('bankID')->unsigned();
            $table->foreign('bankID')->references('id')->on('banks');
            $table->string('accno', 32);
            $table->string('accname', 64);
            $table->string('acclocation', 64);
            $table->timestamps();
        });
        //RASANYA GA PERLU DI BUAT JADI PRIMARY CUSTOMERIDNYAA
        //DB::statement('ALTER TABLE customerbankaccs DROP PRIMARY KEY, ADD PRIMARY KEY (id, customerID)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('customerbankaccs');
    }
}
