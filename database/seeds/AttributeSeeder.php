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
            'web_name' => 'Gyártó',
            'name' => 'gyarto',
            'type_id' => 'text',
        ]);

        DB::table('attributes')->insert([
            'web_name' => 'Alkoholtartalom',
            'name' => 'alkoholtartalom',
            'type_id' => 'number',
        ]);

        DB::table('attributes')->insert([
            'web_name' => 'Szőlőfajta',
            'name' => 'szolofajta',
            'type_id' => 'select',
        ]);
    }
}
