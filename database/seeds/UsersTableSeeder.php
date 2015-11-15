<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Kevin',
            'email' => 'kev@kpbowler.co.uk',
            'password' => bcrypt('fma0207!!'),
        ]);
        DB::table('users')->insert([
            'name' => 'Kevin Bowler',
            'email' => 'kpbowler@gmail.com',
            'password' => bcrypt('test'),
        ]);
    }
}
