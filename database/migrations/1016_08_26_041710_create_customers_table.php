<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->engine="InnoDB";
            $table->increments('id');
            $table->integer('companyID')->unsigned();
            $table->foreign('companyID')->references('id')->on('companies');
            $table->string('email')->unique();
            $table->string('password', 64);
            $table->string('name', 64);
            $table->string('type', 32);
            $table->string('title', 8);
            $table->string('address');
            $table->string('postcode', 8);
            $table->integer('cityID')->unsigned();
            $table->foreign('cityID')->references('id')->on('cities');
            $table->string('phone1', 16)->nullable();
            $table->string('phone2', 16)->nullable();
            $table->string('phone3', 16)->nullable();
            $table->tinyinteger('news');
            $table->decimal('balance', 10, 2);
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
        Schema::drop('customers');
    }
}
