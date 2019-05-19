<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConstantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('constants', function(Blueprint $table){
            $table->engine="InnoDB";
            $table->increments('id');
            $table->string('name', '64')->unique();
            $table->decimal('price', 10, 3);
            $table->timestamps();
        });
        //DB::statement('ALTER TABLE addresses DROP PRIMARY KEY, ADD PRIMARY KEY (customeraddressID, customerID);');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('constants');
    }
}
