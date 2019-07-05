<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsubtypetemplatefinishingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobsubtypetemplatefinishings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jobsubtypetemplateID')->unsigned();
            $table->integer('finishingID')->unsigned();
            $table->integer('optionID')->unsigned();
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
        Schema::dropIfExists('jobsubtypetemplatefinishings');
    }
}
