<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->delete();
        User::create(array(
        	'name' 		=> 'monyong',  
        	'username'	=> 'landak', 
        	'email'		=> 'monyong@landak.com',
        	'password' 	=> Hash::make('12345'));
    }
}
