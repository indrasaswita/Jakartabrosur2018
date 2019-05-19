<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesdeliverydetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salesdeliverydetails', function(Blueprint $table){
            $table->engine="InnoDB";
            $table->increments('id');
            $table->integer('salesdeliveryID')->unsigned();
            $table->foreign('salesdeliveryID')->references("id")->on('salesdeliveries');
            $table->integer('salesdetailID')->unsigned();
            $table->foreign('salesdetailID')->references("id")->on('salesdetails');
            $table->integer('actualprice')->unsigned();
            $table->integer('quantity')->unsigned();
            $table->decimal('weight', 10, 2);
            $table->integer('totalpackage')->unsigned();
            $table->tinyinteger('status')->unsigned()->comment('0: belom buat surat, 1: sudah print, 2: sudah selesai');
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
        Schema::dropIfExists('salesdeliverydetails');
    }
}
