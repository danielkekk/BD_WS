<?php

use Illuminate\Database\Seeder;

class ValamiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('valami')->insert([
            'mezo' => 'Jack',
        ]);
    }
}
