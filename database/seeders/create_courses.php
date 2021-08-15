<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class create_courses extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->insert([
            'name' => 'EST',
            'client_id' => 1,
        ]);
        DB::table('courses')->insert([
            'name' => 'IDP',
            'client_id' => 1,
        ]);
        DB::table('courses')->insert([
            'name' => 'Appro',
            'client_id' => 1,
        ]);
        DB::table('courses')->insert([
            'name' => 'RTW',
            'client_id' => 1,
        ]);
        DB::table('courses')->insert([
            'name' => 'RTH',
            'client_id' => 1,
        ]);
        DB::table('courses')->insert([
            'name' => 'Granger',
            'client_id' => 1,
        ]);
        DB::table('courses')->insert([
            'name' => 'Funk',
            'client_id' => 1,
        ]);
        DB::table('courses')->insert([
            'name' => 'Außendienst',
            'client_id' => 1,
        ]);
        DB::table('courses')->insert([
            'name' => 'Schmerztherapie',
            'client_id' => 1,
        ]);
        DB::table('courses')->insert([
            'name' => 'ID-Schulung',
            'client_id' => 1,
        ]);
        DB::table('courses')->insert([
            'name' => 'Großeinsatzschulung',
            'client_id' => 1,
        ]);
    }
}
