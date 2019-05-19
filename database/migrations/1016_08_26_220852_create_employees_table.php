<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function(Blueprint $table){
            $table->engine="InnoDB";
            $table->increments('id');
            $table->string('name', 32);
            $table->string('email', 128);
            $table->string('password', 64);
            $table->integer('roleID')->unsigned();
            $table->foreign('roleID')->references('id')->on('roles');
            $table->rememberToken();
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
        Schema::drop('employees');
    }
}