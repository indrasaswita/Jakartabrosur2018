<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaperdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paperdetails', function(Blueprint $table){
            $table->engine="InnoDB";
            $table->increments('id');
            $table->integer('paperID')->unsigned();
            $table->foreign('paperID')->references('id')->on('papers');
            $table->integer('vendorID')->unsigned();
            $table->foreign('vendorID')->references('id')->on('vendors');
            $table->integer('planoID')->unsigned();
            $table->foreign('planoID')->references('id')->on('papersizes');

            $table->decimal('buyprice', 10, 2);
            $table->decimal('sellprice', 10, 2);
            $table->decimal('unitprice', 10, 2);
            $table->string('unittype', 32);
            $table->string('totalpcs', 16)->comment('jumlah total dari perpcs');
            $table->tinyinteger('available')->comment('1/0');
            $table->timestamps();
        });
        //DB::statement('ALTER TABLE paperdetails DROP PRIMARY KEY, ADD PRIMARY KEY (paperID, vendorID, planoID)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('paperdetails');
    }
}
