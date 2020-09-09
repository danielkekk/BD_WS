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
            'code' => Str::random(10),
            'qty' => 100,
        ]);

        DB::table('products')->insert([
            'id' => 2,
            'name' => 'ADLER BERLIN DRY GIN',
            'category_azon' => 'gin',
            'code' => Str::random(10),
            'qty' => 30,
        ]);

        DB::table('products')->insert([
            'id' => 3,
            'name' => 'AGÁRDI GIN',
            'category_azon' => 'gin',
            'code' => Str::random(10),
            'qty' => 200,
        ]);

        DB::table('products')->insert([
            'id' => 4,
            'name' => '10 CANE RUM',
            'category_azon' => 'rum',
            'code' => Str::random(10),
            'qty' => 30,
        ]);

        DB::table('products')->insert([
            'id' => 5,
            'name' => 'A.H. RIISE BLACK BARREL NAVY SPICED RUM',
            'category_azon' => 'rum',
            'code' => Str::random(10),
            'qty' => 200,
        ]);

        DB::table('products')->insert([
            'id' => 6,
            'name' => 'ANDRÁSSY TOKAJI JÉGBOR',
            'category_azon' => 'magyar_bor',
            'code' => Str::random(10),
            'qty' => 200,
        ]);

        DB::table('products')->insert([
            'id' => 7,
            'name' => 'ALVARO PALACIOS CAMINS DEL PRIORAT',
            'category_azon' => 'kulfoldi_bor',
            'code' => Str::random(10),
            'qty' => 200,
        ]);

        DB::table('products')->insert([
            'id' => 8,
            'name' => 'ANTINORI PEPPOLI CHIANTI CLASSICO',
            'category_azon' => 'kulfoldi_bor',
            'code' => Str::random(10),
            'qty' => 200,
        ]);

        DB::table('products')->insert([
            'id' => 9,
            'name' => 'FRUITS AND WINE - ROSÉ BOR & EPER',
            'category_azon' => 'gyumolcsbor',
            'code' => Str::random(10),
            'qty' => 200,
        ]);

        DB::table('products')->insert([
            'id' => 10,
            'name' => 'BANANA BREAD /ÜVEGES',
            'category_azon' => 'premium_sorok',
            'code' => Str::random(10),
            'qty' => 200,
        ]);

        DB::table('products')->insert([
            'id' => 11,
            'name' => 'BARBAR HONEY /ÜVEGES',
            'category_azon' => 'premium_sorok',
            'code' => Str::random(10),
            'qty' => 200,
        ]);

        DB::table('products')->insert([
            'id' => 12,
            'name' => 'ARANY ÁSZOK /DOBOZOS',
            'category_azon' => 'hagyomanyos_sorok',
            'code' => Str::random(10),
            'qty' => 200,
        ]);

        DB::table('products')->insert([
            'id' => 13,
            'name' => 'ARANY ÁSZOK /ÜVEGES/',
            'category_azon' => 'hagyomanyos_sorok',
            'code' => Str::random(10),
            'qty' => 200,
        ]);

        DB::table('products')->insert([
            'id' => 14,
            'name' => 'CHRISTIAN DROUIN POIRE /KÖRTE/ CIDER',
            'category_azon' => 'cider',
            'code' => Str::random(10),
            'qty' => 200,
        ]);
    }
}
