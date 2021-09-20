<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class create_states extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->insert([
            'name' => 'Aktiv',
            'description' => 'Besetzt.',
            'client_id' => 1,
        ]);
        DB::table('states')->insert([
            'name' => 'Büro',
            'description' => 'Büroarbeit',
            'client_id' => 1,
        ]);
        DB::table('states')->insert([
            'name' => 'Besprechung',
            'client_id' => 1,
        ]);
        DB::table('states')->insert([
            'name' => 'Einweisung',
            'client_id' => 1,
        ]);
        DB::table('states')->insert([
            'name' => '10-9',
            'client_id' => 1,
        ]);
    }
}
