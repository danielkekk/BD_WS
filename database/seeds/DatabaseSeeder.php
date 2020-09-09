<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            ProductSeeder::class,
            CategoriesSeeder::class,
            AttributeSeeder::class,
            AttributeValuesSeeder::class,
            CategoriesAttributeSeeder::class,
            ProductsAttributeValuesSeeder::class,
            AttributeTypeSeeder::class,
        ]);
    }
}
