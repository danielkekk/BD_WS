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
            'id' => 1,
            'web_name' => 'Termékek',
            'name' => 'termekek',
            'azon' => 'termekek',
            'lft' => 1,
            'rgt' => 24,
        ]);

        DB::table('categories')->insert([
            'id' => 2,
            'web_name' => 'Szeszes italok',
            'name' => 'szeszes_italok',
            'azon' => 'szeszes_italok',
            'lft' => 2,
            'rgt' => 7,
        ]);

        DB::table('categories')->insert([
            'id' => 3,
            'web_name' => 'Gin',
            'name' => 'gin',
            'azon' => 'gin',
            'lft' => 3,
            'rgt' => 4,
        ]);

        DB::table('categories')->insert([
            'id' => 4,
            'web_name' => 'Rum',
            'name' => 'rum',
            'azon' => 'rum',
            'lft' => 5,
            'rgt' => 6,
        ]);

        DB::table('categories')->insert([
            'id' => 5,
            'web_name' => 'Bor',
            'name' => 'bor',
            'azon' => 'bor',
            'lft' => 8,
            'rgt' => 15,
        ]);

        DB::table('categories')->insert([
            'id' => 6,
            'web_name' => 'Magyar bor',
            'name' => 'magyar_bor',
            'azon' => 'magyar_bor',
            'lft' => 9,
            'rgt' => 10,
        ]);

        DB::table('categories')->insert([
            'id' => 7,
            'web_name' => 'Külföldi bor',
            'name' => 'kulfoldi_bor',
            'azon' => 'kulfoldi_bor',
            'lft' => 11,
            'rgt' => 12,
        ]);

        DB::table('categories')->insert([
            'id' => 8,
            'web_name' => 'Gyümölcsbor',
            'name' => 'gyumolcsbor',
            'azon' => 'gyumolcsbor',
            'lft' => 13,
            'rgt' => 14,
        ]);

        DB::table('categories')->insert([
            'id' => 9,
            'web_name' => 'Sör',
            'name' => 'sor',
            'azon' => 'sor',
            'lft' => 16,
            'rgt' => 23,
        ]);

        DB::table('categories')->insert([
            'id' => 10,
            'web_name' => 'Prémium sörök',
            'name' => 'premium_sorok',
            'azon' => 'premium_sorok',
            'lft' => 17,
            'rgt' => 18,
        ]);

        DB::table('categories')->insert([
            'id' => 11,
            'web_name' => 'Hagyományos sörök',
            'name' => 'hagyomanyos_sorok',
            'azon' => 'hagyomanyos_sorok',
            'lft' => 19,
            'rgt' => 20,
        ]);

        DB::table('categories')->insert([
            'id' => 12,
            'web_name' => 'Cider',
            'name' => 'cider',
            'azon' => 'cider',
            'lft' => 21,
            'rgt' => 22,
        ]);

    }
}
