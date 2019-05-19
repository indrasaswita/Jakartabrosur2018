<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salesdetails', function(Blueprint $table){
            $table->engine="InnoDB";
            $table->increments("id");
            $table->integer('salesID')->unsigned();
            $table->foreign('salesID')->references('id')->on('salesheaders');
            $table->integer('cartID')->unsigned();
            $table->foreign('cartID')->references('id')->on('cartheaders');
            $table->tinyinteger('prioritylevel')->default(2);
            $table->tinyinteger('statusfile')->default(0);
            $table->tinyinteger('commited')->default(0);
            $table->tinyinteger('statusctp')->default(0);
            $table->tinyinteger('statusprint')->default(0);
            $table->tinyinteger('statuspacking')->default(0);
            $table->tinyinteger('statusdelivery')->default(0);
            $table->tinyinteger('statusdone')->default(0);
            $table->timestamps();
        });
        //DB::statement('ALTER TABLE salesdetails DROP PRIMARY KEY, ADD PRIMARY KEY (salesID, cartdetailID)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('salesdetails');
    }
}
