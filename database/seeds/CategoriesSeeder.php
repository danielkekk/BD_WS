<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'ELECTRONICS',
            'lft' => 1,
            'rgt' => 20,
        ]);

        DB::table('categories')->insert([
            'name' => 'TELEVISIONS',
            'lft' => 2,
            'rgt' => 9,
        ]);

        DB::table('categories')->insert([
            'name' => 'TUBE',
            'lft' => 3,
            'rgt' => 4,
        ]);

        DB::table('categories')->insert([
            'name' => 'LCD',
            'lft' => 5,
            'rgt' => 6,
        ]);

        DB::table('categories')->insert([
            'name' => 'PLASMA',
            'lft' => 7,
            'rgt' => 8,
        ]);

        DB::table('categories')->insert([
            'name' => 'PORTABLE ELECTRONICS',
            'lft' => 10,
            'rgt' => 19,
        ]);

        DB::table('categories')->insert([
            'name' => 'MP3 PLAYERS',
            'lft' => 11,
            'rgt' => 14,
        ]);

        DB::table('categories')->insert([
            'name' => 'FLASH',
            'lft' => 12,
            'rgt' => 13,
        ]);

        DB::table('categories')->insert([
            'name' => 'CD PLAYERS',
            'lft' => 15,
            'rgt' => 16,
        ]);

        DB::table('categories')->insert([
            'name' => '2 WAY RADIOS',
            'lft' => 17,
            'rgt' => 18,
        ]);
    }
}
