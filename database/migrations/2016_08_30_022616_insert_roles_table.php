<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('roles')->insert(
            [
                'name' => 'Administrator', 
                'sale' => 1, 
                'purchase' => 1,
                'delivery' => 1,
                'workorder' => 1,
                'customer' => 1,
                'employee' => 1,
                'report' => 1
            ]
        );
        
        DB::table('roles')->insert(
            [
                'name' => 'Cashier', 
                'sale' => 1, 
                'purchase' => 0,
                'delivery' => 1,
                'workorder' => 1,
                'customer' => 1,
                'employee' => 0,
                'report' => 0
            ]
        );
        
        DB::table('roles')->insert(
            [
                'name' => 'Courier', 
                'sale' => 0, 
                'purchase' => 0,
                'delivery' => 1,
                'workorder' => 0,
                'customer' => 0,
                'employee' => 0,
                'report' => 0
            ]
        );
        
        DB::table('roles')->insert(
            [
                'name' => 'Operator', 
                'sale' => 0, 
                'purchase' => 0,
                'delivery' => 0,
                'workorder' => 1,
                'customer' => 0,
                'employee' => 0,
                'report' => 0
            ]
        );
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
