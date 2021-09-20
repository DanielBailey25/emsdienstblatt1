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
            'name' => 'KH Pillbox',
            'client_id' => 1,
            'item_type_id' => 1,
        ]);
        DB::table('items')->insert([
            'name' => 'KH Ghetto',
            'client_id' => 1,
            'item_type_id' => 1,
        ]);
        DB::table('items')->insert([
            'name' => 'KH Sandy',
            'client_id' => 1,
            'item_type_id' => 1,
        ]);
        DB::table('items')->insert([
            'name' => 'Aussendienst',
            'client_id' => 1,
            'item_type_id' => 10,
        ]);
    }
}
