<?php

namespace Database\Seeders;

use App\Models\User;
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
            'name' => 'Roy_Diamond',
            'type' => 0,
            'rank' => 7,
            'player_id' => 650,
            'client_id' => 1,
            'password' => Hash::make('einfach'),
        ]);
        DB::table('users')->insert([
            'name' => 'Michael Geissler',
            'type' => 0,
            'rank' => 1,
            'player_id' => 3947,
            'client_id' => 1,
            'is_admin' => true,
            'password' => Hash::make('einfach'),
        ]);
        DB::table('users')->insert([
            'name' => 'Sam Lange',
            'rank' => 0,
            'player_id' => 291,
            'client_id' => 1,
            'password' => Hash::make('einfach'),
        ]);
        User::find(1)->assignRole('Admin');
        User::find(2)->assignRole('Admin');
        User::find(3)->assignRole('Editor');
    }
}
