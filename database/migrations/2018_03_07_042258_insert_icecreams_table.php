<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertIcecreamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            INSERT INTO icecreams VALUES ('1', 'Milk Stick', '2000', '1500', '50', '0', '0', '', '', now(), now());
            INSERT INTO icecreams VALUES ('2', 'Semangka Stick', '2000', '1500', '50', '0', '0', '8997033170164', '', now(), now());
            INSERT INTO icecreams VALUES ('3', 'Nanas Stick', '2000', '1500', '50', '0', '0', '', '', now(), now());
            INSERT INTO icecreams VALUES ('4', 'Chocolate Stick', '2000', '1500', '50', '0', '0', '8997033170140', '', now(), now());
            INSERT INTO icecreams VALUES ('5', 'Milk Melon Stick', '2000', '1500', '40', '0', '0', '', '', now(), now());
            INSERT INTO icecreams VALUES ('6', 'Coffee Crispy Stick', '3000', '2250', '40', '0', '0', '8997033170058', '', now(), now());
            INSERT INTO icecreams VALUES ('7', 'Taro Cone', '2500', '1900', '48', '0', '0', '', '', now(), now());
            INSERT INTO icecreams VALUES ('8', 'Sweet Corn Stick', '3000', '2250', '40', '0', '0', '8885013130508', '', now(), now());
            INSERT INTO icecreams VALUES ('9', 'Strawberry Crispy Stick', '3000', '2300', '30', '0', '0', '8885013130065', '', now(), now());
            INSERT INTO icecreams VALUES ('0', 'Chocolate Crispy Stick', '4000', '3200', '30', '0', '0', '8885013130058', '', now(), now());
            INSERT INTO icecreams VALUES ('0', 'Mochi', '3000', '2300', '40', '0', '0', '8885013130201', '', now(), now());
            INSERT INTO icecreams VALUES ('0', 'Chocolate Cup', '5000', '4000', '24', '0', '0', '', '', now(), now());
            INSERT INTO icecreams VALUES ('0', 'Strawberry Cup', '5000', '4000', '24', '0', '0', '', '', now(), now());
            INSERT INTO icecreams VALUES ('0', 'Manggo Slush Stick', '4000', '3000', '30', '0', '0', '', '', now(), now());
            INSERT INTO icecreams VALUES ('0', 'Manggo Slush Low Fat', '4000', '3000', '30', '0', '0', '', '', now(), now());
            INSERT INTO icecreams VALUES ('0', 'Manggo Slush Less Sugar Low Fat', '5000', '4000', '30', '0', '0', '8885013130560', '', now(), now());
            INSERT INTO icecreams VALUES ('0', 'Apel Stick', '3000', '2000', '60', '0', '0', '', '', now(), now());
            INSERT INTO icecreams VALUES ('0', 'Lidah Hijau', '3000', '2000', '60', '0', '0', '8885013130010', '', now(), now());
            INSERT INTO icecreams VALUES ('0', '3 in 1 Ember', '175000', '150000', '2', '0', '0', '', '', now(), now());
            INSERT INTO icecreams VALUES ('0', 'Vanilla Ember', '175000', '150000', '2', '0', '0', '', '', now(), now());
            INSERT INTO icecreams VALUES ('0', 'Chocolate Ember', '175000', '150000', '2', '0', '0', '', '', now(), now());
            INSERT INTO icecreams VALUES ('0', 'Strawberry Ember', '175000', '150000', '2', '0', '0', '', '', now(), now());  
        ");
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
