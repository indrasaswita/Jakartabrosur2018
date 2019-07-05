<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsubtypedetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobsubtypedetails', function(Blueprint $table){
            $table->engine="InnoDB";
            $table->increments('id');
            $table->integer('jobsubtypeID')->unsigned();
            $table->string('detailname');
            $table->tinyinteger('sizetype');
            $table->tinyinteger('sisicetak')->unsigned()->comment('keterangan di wikigithub, sisi cetak = sisi (bukan warna)');
            $table->tinyinteger('warnacetak')->unsigned()->comment('keterangan di wikigithub, warna cetak = warna (bukan sisi)');
            //multiplier - jumlah set perkalian dari quantity header
            $table->smallinteger('defaultmultip')->unsigned()->comment('berapa x dari header, total lembar detail')->default(1);
            $table->tinyinteger('lockdetailmultip')->unsigned()->comment('kalo di lock, brarti ga bisa ganti, Cth: Cover cuma 1');
            $table->integer('stepmultip')->comment('kalo 2, brarti genap doang, kalo 3 brarti kelipatan 3');
            $table->integer('minmultip')->unsigned();
            $table->integer('maxmultip')->unsigned()->comment('untuk beberapa hal, harus di buat max di js, cth: jilid kawat');
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

        Schema::dropIfExists('jobsubtypedetails');
    }
}
