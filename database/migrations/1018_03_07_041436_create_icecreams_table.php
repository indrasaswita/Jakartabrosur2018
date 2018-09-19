<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIcecreamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {  
        Schema::create('icecreams', function(Blueprint $table){
            $table->engine="InnoDB";
            $table->increments('id');
            $table->string('name', '64');
            $table->integer('sellprice')->unsigned();
            $table->integer('buyprice')->unsigned();
            $table->smallinteger('perpak');
            $table->smallinteger('stock');
            $table->smallinteger('minstock');
            $table->string('barcode', '16');
            $table->string('image', '255');
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
        Schema::dropIfExists("icecreams");
    }
}
