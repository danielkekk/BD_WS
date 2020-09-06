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
            'azon' => 1,
            'lft' => 1,
            'rgt' => 20,
        ]);

        DB::table('categories')->insert([
            'name' => 'TELEVISIONS',
            'azon' => 2,
            'lft' => 2,
            'rgt' => 9,
        ]);

        DB::table('categories')->insert([
            'name' => 'TUBE',
            'azon' => 3,
            'lft' => 3,
            'rgt' => 4,
        ]);

        DB::table('categories')->insert([
            'name' => 'LCD',
            'azon' => 4,
            'lft' => 5,
            'rgt' => 6,
        ]);

        DB::table('categories')->insert([
            'name' => 'PLASMA',
            'azon' => 5,
            'lft' => 7,
            'rgt' => 8,
        ]);

        DB::table('categories')->insert([
            'name' => 'PORTABLEELECTRONICS',
            'azon' => 6,
            'lft' => 10,
            'rgt' => 19,
        ]);

        DB::table('categories')->insert([
            'name' => 'MP3PLAYERS',
            'azon' => 7,
            'lft' => 11,
            'rgt' => 14,
        ]);

        DB::table('categories')->insert([
            'name' => 'FLASH',
            'azon' => 8,
            'lft' => 12,
            'rgt' => 13,
        ]);

        DB::table('categories')->insert([
            'name' => 'CDPLAYERS',
            'azon' => 9,
            'lft' => 15,
            'rgt' => 16,
        ]);

        DB::table('categories')->insert([
            'name' => '2WAYRADIOS',
            'azon' => 10,
            'lft' => 17,
            'rgt' => 18,
        ]);
    }
}
