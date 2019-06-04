<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePapersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('papers', function(Blueprint $table){
            $table->engine="InnoDB";
            $table->increments('id');
            $table->integer('papertypeID')->unsigned();
            $table->foreign('papertypeID')->references('id')->on('papertypes');
            $table->string('name', 64);
            $table->string('color', 16);
            $table->smallinteger('gramature');
            $table->tinyinteger('texture')->default(0);
            $table->tinyinteger('numerator')->default(0);
            $table->tinyinteger('varnish')->default(0);
            $table->tinyinteger('spotuv')->default(0);
            $table->tinyinteger('laminating')->default(0);
            $table->tinyinteger('folding')->default(0);
            $table->tinyinteger('perforation')->default(0);
            $table->tinyinteger('diecut')->default(0);
            $table->integer('coatingtype')->unsigned()->default(1);
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
        Schema::drop('papers');
    }
}
