<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class create_item_types extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('item_types')->insert([
            'name' => 'Krankenhaus',
            'client_id' => 1,
        ]);
        DB::table('item_types')->insert([
            'name' => 'Rettungswagen',
            'client_id' => 1,
        ]);
        DB::table('item_types')->insert([
            'name' => 'Dinghy',
            'client_id' => 1,
        ]);
        DB::table('item_types')->insert([
            'name' => 'Granger',
            'client_id' => 1,
        ]);
        DB::table('item_types')->insert([
            'name' => 'Rettungshubschrauber',
            'client_id' => 1,
        ]);
        DB::table('item_types')->insert([
            'name' => 'SUV',
            'client_id' => 1,
        ]);
        DB::table('item_types')->insert([
            'name' => 'Tailgater',
            'client_id' => 1,
        ]);
        DB::table('item_types')->insert([
            'name' => 'VSTR',
            'client_id' => 1,
        ]);
        DB::table('item_types')->insert([
            'name' => 'Buffalo',
            'client_id' => 1,
        ]);
        DB::table('item_types')->insert([
            'name' => 'Andere',
            'client_id' => 1,
        ]);
    }
}
