<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalespaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salespayments', function(Blueprint $table){
            $table->engine="InnoDB";
            $table->increments('id');
            $table->integer('salesID')->unsigned();
            //$table->primary(array('id', 'salesID'));
            $table->integer('customeraccID')->unsigned();
            $table->integer('companyaccID')->unsigned();
            $table->date('paydate')->default('1901-01-01'); //spaya lebih cepet pencarian
            $table->string('note');
            $table->integer('ammount');
            $table->string('type');
            $table->timestamps();
        });
        //DB::statement('ALTER TABLE salespayments DROP PRIMARY KEY, ADD PRIMARY KEY (id, salesID)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('salespayments');
    }
}
