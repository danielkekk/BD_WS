<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories_attributes')->insert([
            'categories_id' => 1,
            'attributes_id' => 1,
        ]);

        DB::table('categories_attributes')->insert([
            'categories_id' => 2,
            'attributes_id' => 1,
        ]);

        DB::table('categories_attributes')->insert([
            'categories_id' => 3,
            'attributes_id' => 1,
        ]);

        DB::table('categories_attributes')->insert([
            'categories_id' => 4,
            'attributes_id' => 1,
        ]);

        DB::table('categories_attributes')->insert([
            'categories_id' => 5,
            'attributes_id' => 1,
        ]);

        DB::table('categories_attributes')->insert([
            'categories_id' => 6,
            'attributes_id' => 1,
        ]);

        DB::table('categories_attributes')->insert([
            'categories_id' => 7,
            'attributes_id' => 1,
        ]);

        DB::table('categories_attributes')->insert([
            'categories_id' => 8,
            'attributes_id' => 1,
        ]);

        DB::table('categories_attributes')->insert([
            'categories_id' => 9,
            'attributes_id' => 1,
        ]);

        DB::table('categories_attributes')->insert([
            'categories_id' => 10,
            'attributes_id' => 1,
        ]);

        DB::table('categories_attributes')->insert([
            'categories_id' => 11,
            'attributes_id' => 1,
        ]);

        DB::table('categories_attributes')->insert([
            'categories_id' => 12,
            'attributes_id' => 1,
        ]);

        DB::table('categories_attributes')->insert([
            'categories_id' => 1,
            'attributes_id' => 2,
        ]);

        DB::table('categories_attributes')->insert([
            'categories_id' => 2,
            'attributes_id' => 2,
        ]);

        DB::table('categories_attributes')->insert([
            'categories_id' => 3,
            'attributes_id' => 2,
        ]);

        DB::table('categories_attributes')->insert([
            'categories_id' => 4,
            'attributes_id' => 2,
        ]);

        DB::table('categories_attributes')->insert([
            'categories_id' => 5,
            'attributes_id' => 2,
        ]);

        DB::table('categories_attributes')->insert([
            'categories_id' => 6,
            'attributes_id' => 2,
        ]);

        DB::table('categories_attributes')->insert([
            'categories_id' => 7,
            'attributes_id' => 2,
        ]);

        DB::table('categories_attributes')->insert([
            'categories_id' => 8,
            'attributes_id' => 2,
        ]);

        DB::table('categories_attributes')->insert([
            'categories_id' => 9,
            'attributes_id' => 2,
        ]);

        DB::table('categories_attributes')->insert([
            'categories_id' => 10,
            'attributes_id' => 2,
        ]);

        DB::table('categories_attributes')->insert([
            'categories_id' => 11,
            'attributes_id' => 2,
        ]);

        DB::table('categories_attributes')->insert([
            'categories_id' => 12,
            'attributes_id' => 2,
        ]);

        DB::table('categories_attributes')->insert([
            'categories_id' => 5,
            'attributes_id' => 3,
        ]);

        DB::table('categories_attributes')->insert([
            'categories_id' => 6,
            'attributes_id' => 3,
        ]);

        DB::table('categories_attributes')->insert([
            'categories_id' => 7,
            'attributes_id' => 3,
        ]);
    }
}
