<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class create_objects extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('objects')->insert([
            'name' => 'Granger 01',
            'client_id' => 1,
            'object_type_id' => 4,
        ]);
        DB::table('objects')->insert([
            'name' => 'RTW 01',
            'client_id' => 1,
            'object_type_id' => 2,
        ]);
        DB::table('objects')->insert([
            'name' => 'Tailgator 01',
            'client_id' => 1,
            'object_type_id' => 7,
        ]);
        DB::table('objects')->insert([
            'name' => 'RTW 02',
            'client_id' => 1,
            'object_type_id' => 2,
        ]);
        DB::table('objects')->insert([
            'name' => 'RTW 03',
            'client_id' => 1,
            'object_type_id' => 2,
        ]);
    }
}
