<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'name' => 'Jack Daniels',
            'code' => Str::random(10),
            'qty' => 100,
        ]);

        DB::table('products')->insert([
            'name' => 'Bombay',
            'code' => Str::random(10),
            'qty' => 30,
        ]);

        DB::table('products')->insert([
            'name' => 'Dankó Pista',
            'code' => Str::random(10),
            'qty' => 200,
        ]);
    }
}
