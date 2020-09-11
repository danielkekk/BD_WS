<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('attributes')->insert([
            'id' => 1,
            'web_name' => 'Gyártó',
            'name' => 'gyarto',
            'azon' => 'gyarto',
            'type_id' => 'select',
        ]);

        DB::table('attributes')->insert([
            'id' => 2,
            'web_name' => 'Alkoholtartalom',
            'name' => 'alkoholtartalom',
            'azon' => 'alkoholtartalom',
            'type_id' => 'number',
        ]);

        DB::table('attributes')->insert([
            'id' => 3,
            'web_name' => 'Szőlőfajta',
            'name' => 'szolofajta',
            'azon' => 'szolofajta',
            'type_id' => 'select',
        ]);
    }
}
