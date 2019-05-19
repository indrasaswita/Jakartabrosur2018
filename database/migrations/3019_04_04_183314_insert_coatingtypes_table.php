<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertCoatingtypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            INSERT INTO coatingtypes VALUES ('0', 'Coatable', '<i class=\"fas fa-check tx-success\"></i> COAT', 'Kertas ini dapat dilapisi dengan laminasi dof, maupun glossy untuk menghasilkan texture yang lebih indah. Adapun pelapis lain seperti Varnish dan Spot Varnish (Glossy) sesuai kebutuhan Anda. Untuk lebih jelasnya, dapat lihat ke halaman <b>PRINTING KNOWLEDGE</b> pada menu.', 'Bila tidak diberikan lapisan, bahan ini cukup mengkilap. Akan lebih sukar disobek bila dilapisi laminasi.', now(), null);
            INSERT INTO coatingtypes VALUES ('0', 'Non-coatable', '<i class=\"fas fa-times tx-danger\"></i> COAT', 'Kertas ini tidak bisa dilapisi apapun, dari segi texture terlihat matte. Untuk lebih jelasnya, dapat lihat ke halaman <b>PRINTING KNOWLEDGE</b> pada menu.', 'Mudah untuk ditulis dengan pensil maupun pen, dan texture sangat matte.', now(), null);
            INSERT INTO coatingtypes VALUES ('0', 'Coatable Banner', '<i class=\"fas fa-check tx-success\"></i> COAT', 'Kertas ini dapat dilapisi dengan laminasi dof, maupun glossy untuk menghasilkan texture yang lebih indah. Untuk lebih jelasnya, dapat lihat ke halaman <b>PRINTING KNOWLEDGE</b> pada menu.', 'Bila tidak diberikan lapisan, bahan ini rentan dengan goresan yang keras. Akan lebih sukar disobek bila dilapisi laminasi.', now(), null);
            INSERT INTO coatingtypes VALUES ('0', 'Non-coatable banner', '<i class=\"fas fa-times tx-danger\"></i> COAT', 'Spanduk ini tidak dapat dilapisi dengan laminasi dof, maupun glossy. Untuk lebih jelasnya, dapat lihat ke halaman <b>PRINTING KNOWLEDGE</b> pada menu.', 'Tidak mudah tergores maupun tersobek. Namun texture akan kurang menarik dibandingkan bahan spanduk laminasi.', now(), null);
            INSERT INTO coatingtypes VALUES ('0', 'Plastic', '<i class=\"fas fa-sun tx-yellow\"></i> Glossy Coated', 'Digunakan untuk kartu, hanging door, atau semacamnya. Tidak mudah tergores dan tertekuk, tidak dapat sobek, serta dapat digunakan dalam waktu yang lama.', 'Mengkilap, keras seperti kartu ATM.', now(), null);
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
