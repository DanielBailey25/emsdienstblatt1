<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class create_users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Michael_Leitung',
            'type' => 0,
            'rank' => 12,
            'service_number' => 23,
            'phone' => 203632,
            'client_id' => 1,
            'password' => Hash::make('einfach'),
        ]);
        DB::table('users')->insert([
            'name' => 'Michael_Geissler',
            'type' => 0,
            'rank' => 1,
            'service_number' => 89,
            'phone' => 203632,
            'client_id' => 1,
            'password' => Hash::make('einfach'),
        ]);
        DB::table('users')->insert([
            'name' => 'Michael_Prakti',
            'rank' => 0,
            'service_number' => 12,
            'phone' => 573832,
            'client_id' => 1,
            'password' => Hash::make('einfach'),
        ]);
    }
}
