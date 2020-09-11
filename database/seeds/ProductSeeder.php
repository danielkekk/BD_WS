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
            'id' => 1,
            'name' => 'Bombay',
            'category_azon' => 'gin',
            'category_id' => 3,
            'code' => Str::random(10),
            'qty' => 100,
            'active' => true,
        ]);

        DB::table('products')->insert([
            'id' => 2,
            'name' => 'ADLER BERLIN DRY GIN',
            'category_azon' => 'gin',
            'category_id' => 3,
            'code' => Str::random(10),
            'qty' => 30,
            'active' => true,
        ]);

        DB::table('products')->insert([
            'id' => 3,
            'name' => 'AGÁRDI GIN',
            'category_azon' => 'gin',
            'category_id' => 3,
            'code' => Str::random(10),
            'qty' => 200,
            'active' => true,
        ]);

        DB::table('products')->insert([
            'id' => 4,
            'name' => '10 CANE RUM',
            'category_azon' => 'rum',
            'category_id' => 4,
            'code' => Str::random(10),
            'qty' => 30,
            'active' => true,
        ]);

        DB::table('products')->insert([
            'id' => 5,
            'name' => 'A.H. RIISE BLACK BARREL NAVY SPICED RUM',
            'category_azon' => 'rum',
            'category_id' => 4,
            'code' => Str::random(10),
            'qty' => 200,
            'active' => true,
        ]);

        DB::table('products')->insert([
            'id' => 6,
            'name' => 'ANDRÁSSY TOKAJI JÉGBOR',
            'category_azon' => 'magyar_bor',
            'category_id' => 6,
            'code' => Str::random(10),
            'qty' => 200,
            'active' => true,
        ]);

        DB::table('products')->insert([
            'id' => 7,
            'name' => 'ALVARO PALACIOS CAMINS DEL PRIORAT',
            'category_azon' => 'kulfoldi_bor',
            'category_id' => 7,
            'code' => Str::random(10),
            'qty' => 200,
            'active' => true,
        ]);

        DB::table('products')->insert([
            'id' => 8,
            'name' => 'ANTINORI PEPPOLI CHIANTI CLASSICO',
            'category_azon' => 'kulfoldi_bor',
            'category_id' => 7,
            'code' => Str::random(10),
            'qty' => 200,
            'active' => true,
        ]);

        DB::table('products')->insert([
            'id' => 9,
            'name' => 'FRUITS AND WINE - ROSÉ BOR & EPER',
            'category_azon' => 'gyumolcsbor',
            'category_id' => 8,
            'code' => Str::random(10),
            'qty' => 200,
            'active' => true,
        ]);

        DB::table('products')->insert([
            'id' => 10,
            'name' => 'BANANA BREAD /ÜVEGES',
            'category_azon' => 'premium_sorok',
            'category_id' => 10,
            'code' => Str::random(10),
            'qty' => 200,
            'active' => true,
        ]);

        DB::table('products')->insert([
            'id' => 11,
            'name' => 'BARBAR HONEY /ÜVEGES',
            'category_azon' => 'premium_sorok',
            'category_id' => 10,
            'code' => Str::random(10),
            'qty' => 200,
            'active' => true,
        ]);

        DB::table('products')->insert([
            'id' => 12,
            'name' => 'ARANY ÁSZOK /DOBOZOS',
            'category_azon' => 'hagyomanyos_sorok',
            'category_id' => 11,
            'code' => Str::random(10),
            'qty' => 200,
            'active' => true,
        ]);

        DB::table('products')->insert([
            'id' => 13,
            'name' => 'ARANY ÁSZOK /ÜVEGES/',
            'category_azon' => 'hagyomanyos_sorok',
            'category_id' => 11,
            'code' => Str::random(10),
            'qty' => 200,
            'active' => true,
        ]);

        DB::table('products')->insert([
            'id' => 14,
            'name' => 'CHRISTIAN DROUIN POIRE /KÖRTE/ CIDER',
            'category_azon' => 'cider',
            'category_id' => 12,
            'code' => Str::random(10),
            'qty' => 200,
            'active' => true,
        ]);
    }
}
