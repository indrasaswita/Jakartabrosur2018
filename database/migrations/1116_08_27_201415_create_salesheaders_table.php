<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesheadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salesheaders', function(Blueprint $table){
            $table->engine="InnoDB";
            $table->increments('id');
            $table->integer('customerID')->unsigned();
            $table->date('tempo')->nullable();
            $table->date('estdate')->nullable();
            $table->string('companyname', 50)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('salesheaders');
    }
}
