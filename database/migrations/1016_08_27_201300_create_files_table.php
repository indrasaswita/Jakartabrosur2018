<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function(Blueprint $table){
            $table->increments('id');
            $table->integer('customerID')->unsigned();
            $table->foreign('customerID')->references('id')->on('customers');
            $table->string('filename', 128);
            $table->decimal('size', 10, 2);
            $table->string('detail')->nullable();
            $table->smallinteger('revision')->default('0');
            $table->string('preview')->nullable();
            $table->string('path');
            $table->string('icon');
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
        Schema::drop('files');
    }
}
