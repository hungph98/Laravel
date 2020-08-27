<?php

use Illuminate\Database\Seeder;
use  Illuminate\Database\QueryException;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(userSeeder::class);
    }
}
/**
 * 
 */
class userSeeder extends Seeder
{
	
	public function run()
	{
		# code...
		DB::table('users')->insert([
        	['name'=>'Hung','email'=>'phamhoanghung@gmail.com','password'=>bcrypt('matkhau')],
        	['name'=>'Hung1','email'=>'hungph62@wru.vn','password'=>bcrypt('matkhau')], 
        	['name'=>'Hung2','email'=>'hungph98@gmail.com','password'=>bcrypt('matkhau')]
        ]);
	}
}
