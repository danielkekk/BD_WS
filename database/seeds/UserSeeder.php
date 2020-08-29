<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB as DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 1,
        ]);

        DB::table('users')->insert([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('user'),
            'role' => 2,
        ]);

        DB::table('users')->insert([
            'name' => 'vendeg',
            'email' => 'vendeg@gmail.com',
            'password' => Hash::make('vendeg'),
            'role' => 3,
        ]);
    }
}
