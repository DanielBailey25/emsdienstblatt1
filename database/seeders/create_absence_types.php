<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class create_absence_types extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('absence_types')->insert([
            'name' => 'Freistellung',
        ]);
        DB::table('absence_types')->insert([
            'name' => 'Urlaub',
        ]);
        DB::table('absence_types')->insert([
            'name' => 'Besprechung',
        ]);
    }
}
