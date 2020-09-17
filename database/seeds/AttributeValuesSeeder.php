<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeValuesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('attributes_values')->insert([
            'id' => 1,
            'categories_id' => 3,
            'attributes_id' => 1,
            'value' => 'Botanic',
        ]);

        DB::table('attributes_values')->insert([
            'id' => 2,
            'categories_id' => 3,
            'attributes_id' => 1,
            'value' => "Hendrick's",
        ]);

        DB::table('attributes_values')->insert([
            'id' => 3,
            'categories_id' => 4,
            'attributes_id' => 1,
            'value' => "Bacardi",
        ]);

        DB::table('attributes_values')->insert([
            'id' => 4,
            'categories_id' => 4,
            'attributes_id' => 1,
            'value' => "Portorico",
        ]);

        DB::table('attributes_values')->insert([
            'id' => 5,
            'categories_id' => 6,
            'attributes_id' => 1,
            'value' => "Szekszárdi",
        ]);

        DB::table('attributes_values')->insert([
            'id' => 6,
            'categories_id' => 6,
            'attributes_id' => 1,
            'value' => "Tokaji",
        ]);

        DB::table('attributes_values')->insert([
            'id' => 7,
            'categories_id' => 7,
            'attributes_id' => 1,
            'value' => "Bottega",
        ]);

        DB::table('attributes_values')->insert([
            'id' => 8,
            'categories_id' => 7,
            'attributes_id' => 1,
            'value' => "Torres Pincészet",
        ]);

        DB::table('attributes_values')->insert([
            'id' => 9,
            'categories_id' => 8,
            'attributes_id' => 1,
            'value' => "Kontyos Pincészet",
        ]);

        DB::table('attributes_values')->insert([
            'id' => 10,
            'categories_id' => 10,
            'attributes_id' => 1,
            'value' => "Bernard",
        ]);

        DB::table('attributes_values')->insert([
            'id' => 11,
            'categories_id' => 10,
            'attributes_id' => 1,
            'value' => "Corona",
        ]);

        DB::table('attributes_values')->insert([
            'id' => 12,
            'categories_id' => 11,
            'attributes_id' => 1,
            'value' => "Borsodi",
        ]);

        DB::table('attributes_values')->insert([
            'id' => 13,
            'categories_id' => 11,
            'attributes_id' => 1,
            'value' => "Dreher",
        ]);

        DB::table('attributes_values')->insert([
            'id' => 14,
            'categories_id' => 12,
            'attributes_id' => 1,
            'value' => "Somersby",
        ]);



        DB::table('attributes_values')->insert([
            'id' => 15,
            'categories_id' => 3,
            'attributes_id' => 2,
            'min' => 1,
            'max' => 100,
            'step' => 1,
        ]);

        DB::table('attributes_values')->insert([
            'id' => 16,
            'categories_id' => 4,
            'attributes_id' => 2,
            'min' => 1,
            'max' => 100,
            'step' => 1,
        ]);

        DB::table('attributes_values')->insert([
            'id' => 17,
            'categories_id' => 6,
            'attributes_id' => 2,
            'min' => 1,
            'max' => 100,
            'step' => 1,
        ]);

        DB::table('attributes_values')->insert([
            'id' => 18,
            'categories_id' => 7,
            'attributes_id' => 2,
            'min' => 1,
            'max' => 100,
            'step' => 1,
        ]);

        DB::table('attributes_values')->insert([
            'id' => 19,
            'categories_id' => 8,
            'attributes_id' => 2,
            'min' => 1,
            'max' => 100,
            'step' => 1,
        ]);

        DB::table('attributes_values')->insert([
            'id' => 20,
            'categories_id' => 10,
            'attributes_id' => 2,
            'min' => 1,
            'max' => 100,
            'step' => 1,
        ]);

        DB::table('attributes_values')->insert([
            'id' => 21,
            'categories_id' => 11,
            'attributes_id' => 2,
            'min' => 1,
            'max' => 100,
            'step' => 1,
        ]);

        DB::table('attributes_values')->insert([
            'id' => 22,
            'categories_id' => 12,
            'attributes_id' => 2,
            'min' => 1,
            'max' => 100,
            'step' => 1,
        ]);



        DB::table('attributes_values')->insert([
            'id' => 23,
            'categories_id' => 6,
            'attributes_id' => 3,
            'value' => "Cabernet Franc",
        ]);

        DB::table('attributes_values')->insert([
            'id' => 24,
            'categories_id' => 6,
            'attributes_id' => 3,
            'value' => "Cuvée",
        ]);

        DB::table('attributes_values')->insert([
            'id' => 25,
            'categories_id' => 6,
            'attributes_id' => 3,
            'value' => "Bikavér",
        ]);

        DB::table('attributes_values')->insert([
            'id' => 26,
            'categories_id' => 7,
            'attributes_id' => 3,
            'value' => "Cabernet Franc",
        ]);

        DB::table('attributes_values')->insert([
            'id' => 27,
            'categories_id' => 7,
            'attributes_id' => 3,
            'value' => "Cuvée",
        ]);
    }
}
