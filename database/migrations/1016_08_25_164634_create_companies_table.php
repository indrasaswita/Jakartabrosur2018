<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function(Blueprint $table){
            $table->engine="InnoDB";
            $table->increments('id');
            $table->string('nickname', 64);
            $table->string('name');
            $table->string('address');
            $table->integer('cityID')->unsigned();
            $table->string('phone1', 16)->nullable();
            $table->string('phone2', 16)->nullable();
            $table->string('phone3', 16)->nullable();
            $table->string('type', 32);
            $table->tinyinteger('verified')->default(0);
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
        Schema::drop('companies');
    }
}
