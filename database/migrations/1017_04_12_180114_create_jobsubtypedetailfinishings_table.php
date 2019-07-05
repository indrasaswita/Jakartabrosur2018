<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsubtypedetailfinishingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobsubtypedetailfinishings', function(Blueprint $table){
            $table->engine="InnoDB";
            $table->increments('id');
            $table->integer('jobsubtypedetailID')->unsigned();
            $table->tinyinteger('ofdg');
            $table->integer('finishingID')->unsigned();
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
        //

        Schema::dropIfExists('jobsubtypedetailfinishings');
    }
}
