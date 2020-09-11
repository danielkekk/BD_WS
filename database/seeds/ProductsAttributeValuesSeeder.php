<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsAttributeValuesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products_attributes_values')->insert([
            'id' => 1,
            'products_id' => 1,
            'attributes_id' => 1,
            'attributes_values_id' => 1,
        ]);

        DB::table('products_attributes_values')->insert([
            'id' => 1,
            'products_id' => 1,
            'attributes_id' => 2,
            'value' => '30',
        ]);

        DB::table('products_attributes_values')->insert([
            'id' => 1,
            'products_id' => 2,
            'attributes_id' => 1,
            'attributes_values_id' => 2,
        ]);

        DB::table('products_attributes_values')->insert([
            'id' => 1,
            'products_id' => 2,
            'attributes_id' => 2,
            'value' => '45',
        ]);

        DB::table('products_attributes_values')->insert([
            'id' => 1,
            'products_id' => 3,
            'attributes_id' => 1,
            'attributes_values_id' => 2,
        ]);

        DB::table('products_attributes_values')->insert([
            'id' => 1,
            'products_id' => 3,
            'attributes_id' => 2,
            'value' => '45',
        ]);

        DB::table('products_attributes_values')->insert([
            'id' => 1,
            'products_id' => 4,
            'attributes_id' => 1,
            'attributes_values_id' => 3,
        ]);

        DB::table('products_attributes_values')->insert([
            'id' => 1,
            'products_id' => 4,
            'attributes_id' => 2,
            'value' => '65',
        ]);

        DB::table('products_attributes_values')->insert([
            'id' => 1,
            'products_id' => 5,
            'attributes_id' => 1,
            'attributes_values_id' => 3,
        ]);

        DB::table('products_attributes_values')->insert([
            'id' => 1,
            'products_id' => 5,
            'attributes_id' => 2,
            'value' => '65',
        ]);

        DB::table('products_attributes_values')->insert([
            'id' => 1,
            'products_id' => 6,
            'attributes_id' => 1,
            'attributes_values_id' => 5,
        ]);

        DB::table('products_attributes_values')->insert([
            'id' => 1,
            'products_id' => 6,
            'attributes_id' => 2,
            'value' => '15',
        ]);

        DB::table('products_attributes_values')->insert([
            'id' => 1,
            'products_id' => 6,
            'attributes_id' => 3,
            'attributes_values_id' => 30,
        ]);

        DB::table('products_attributes_values')->insert([
            'id' => 1,
            'products_id' => 7,
            'attributes_id' => 1,
            'attributes_values_id' => 7,
        ]);

        DB::table('products_attributes_values')->insert([
            'id' => 1,
            'products_id' => 7,
            'attributes_id' => 2,
            'value' => '12',
        ]);

        DB::table('products_attributes_values')->insert([
            'id' => 1,
            'products_id' => 7,
            'attributes_id' => 3,
            'attributes_values_id' => 33,
        ]);

        DB::table('products_attributes_values')->insert([
            'id' => 1,
            'products_id' => 8,
            'attributes_id' => 1,
            'attributes_values_id' => 8,
        ]);

        DB::table('products_attributes_values')->insert([
            'id' => 1,
            'products_id' => 8,
            'attributes_id' => 2,
            'value' => '10',
        ]);

        DB::table('products_attributes_values')->insert([
            'id' => 1,
            'products_id' => 8,
            'attributes_id' => 3,
            'attributes_values_id' => 32,
        ]);

        DB::table('products_attributes_values')->insert([
            'id' => 1,
            'products_id' => 9,
            'attributes_id' => 1,
            'attributes_values_id' => 9,
        ]);

        DB::table('products_attributes_values')->insert([
            'id' => 1,
            'products_id' => 9,
            'attributes_id' => 2,
            'value' => '8',
        ]);

        DB::table('products_attributes_values')->insert([
            'id' => 1,
            'products_id' => 10,
            'attributes_id' => 1,
            'attributes_values_id' => 10,
        ]);

        DB::table('products_attributes_values')->insert([
            'id' => 1,
            'products_id' => 10,
            'attributes_id' => 2,
            'value' => '10',
        ]);

        DB::table('products_attributes_values')->insert([
            'id' => 1,
            'products_id' => 11,
            'attributes_id' => 1,
            'attributes_values_id' => 11,
        ]);

        DB::table('products_attributes_values')->insert([
            'id' => 1,
            'products_id' => 11,
            'attributes_id' => 2,
            'value' => '6',
        ]);

        DB::table('products_attributes_values')->insert([
            'id' => 1,
            'products_id' => 12,
            'attributes_id' => 1,
            'attributes_values_id' => 12,
        ]);

        DB::table('products_attributes_values')->insert([
            'id' => 1,
            'products_id' => 12,
            'attributes_id' => 2,
            'value' => '6',
        ]);

        DB::table('products_attributes_values')->insert([
            'id' => 1,
            'products_id' => 13,
            'attributes_id' => 1,
            'attributes_values_id' => 13,
        ]);

        DB::table('products_attributes_values')->insert([
            'id' => 1,
            'products_id' => 13,
            'attributes_id' => 2,
            'value' => '5',
        ]);

        DB::table('products_attributes_values')->insert([
            'id' => 1,
            'products_id' => 14,
            'attributes_id' => 1,
            'attributes_values_id' => 14,
        ]);

        DB::table('products_attributes_values')->insert([
            'id' => 1,
            'products_id' => 14,
            'attributes_id' => 2,
            'value' => '5',
        ]);
    }
}
