<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function(Blueprint $table){
            $table->engine="InnoDB";
            $table->increments('id');
            $table->string('name');
            $table->tinyinteger('sale');
            $table->tinyinteger('purchase');
            $table->tinyinteger('delivery');
            $table->tinyinteger('workorder');
            $table->tinyinteger('customer');
            $table->tinyinteger('employee');
            $table->tinyinteger('report');
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
        Schema::drop('roles');
    }
}
