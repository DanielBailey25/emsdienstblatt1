<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class create_items extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->insert([
            'name' => 'Granger 01',
            'client_id' => 1,
            'item_type_id' => 4,
        ]);
        DB::table('items')->insert([
            'name' => 'RTW 01',
            'client_id' => 1,
            'item_type_id' => 2,
        ]);
        DB::table('items')->insert([
            'name' => 'Tailgator 01',
            'client_id' => 1,
            'item_type_id' => 7,
        ]);
        DB::table('items')->insert([
            'name' => 'RTW 02',
            'client_id' => 1,
            'item_type_id' => 2,
        ]);
        DB::table('items')->insert([
            'name' => 'RTW 03',
            'client_id' => 1,
            'item_type_id' => 2,
        ]);
        DB::table('items')->insert([
            'name' => 'KH Pillbox',
            'client_id' => 1,
            'item_type_id' => 1,
        ]);
        DB::table('items')->insert([
            'name' => 'KH Davis',
            'client_id' => 1,
            'item_type_id' => 1,
        ]);
        DB::table('items')->insert([
            'name' => 'KH Rockford',
            'client_id' => 1,
            'item_type_id' => 1,
        ]);
        DB::table('items')->insert([
            'name' => 'KH Sandy',
            'client_id' => 1,
            'item_type_id' => 1,
        ]);
        DB::table('items')->insert([
            'name' => 'KH Paleto',
            'client_id' => 1,
            'item_type_id' => 1,
        ]);
    }
}
