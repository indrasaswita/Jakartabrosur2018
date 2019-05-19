<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertPapertypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('papertypes')->insert([
            "name" => "ArtPaper",
            "category" => "0"
        ]);
        DB::table('papertypes')->insert([
            "name" => "ArtCarton",
            "category" => "0"
        ]);
        DB::table('papertypes')->insert([
            "name" => "HVS",
            "category" => "1"
        ]);
        DB::table('papertypes')->insert([
            "name" => "Fancy Lokal",
            "category" => "1"
        ]);
        DB::table('papertypes')->insert([
            "name" => "Kraft",
            "category" => "1"
        ]);
        DB::table('papertypes')->insert([
            "name" => "HVS Rangkap",
            "category" => "2"
        ]);
        DB::table('papertypes')->insert([
            "name" => "Outdoor",
            "category" => "0"
        ]);
        DB::table('papertypes')->insert([
            "name" => "PVC",
            "category" => "4"
        ]);
        DB::table('papertypes')->insert([
            "name" => "Indoor",
            "category" => "0"
        ]);
        DB::table('papertypes')->insert([
            "name" => "Sticker",
            "category" => "0"
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
