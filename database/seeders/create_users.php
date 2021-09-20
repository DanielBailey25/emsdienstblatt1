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
            'name' => 'Michael_Leitung',
            'type' => 0,
            'rank' => 12,
            'player_id' => 23,
            'phone' => 203632,
            'client_id' => 1,
            'password' => Hash::make('einfach'),
        ]);
        DB::table('users')->insert([
            'name' => 'Michael_Geissler',
            'type' => 0,
            'rank' => 1,
            'player_id' => 89,
            'phone' => 203632,
            'client_id' => 1,
            'password' => Hash::make('einfach'),
        ]);
        DB::table('users')->insert([
            'name' => 'Michael_Prakti',
            'rank' => 0,
            'player_id' => 12,
            'phone' => 573832,
            'client_id' => 1,
            'password' => Hash::make('einfach'),
        ]);
        DB::table('users')->insert([
            'name' => 'Max_Mustermann',
            'rank' => 0,
            'player_id' => 13,
            'phone' => 573832,
            'client_id' => 1,
            'password' => Hash::make('einfach'),
        ]);
        DB::table('users')->insert([
            'name' => 'Tester_Einfach',
            'rank' => 2,
            'player_id' => 14,
            'phone' => 573832,
            'client_id' => 1,
            'password' => Hash::make('einfach'),
        ]);
        DB::table('users')->insert([
            'name' => 'Peter_Muster',
            'rank' => 5,
            'player_id' => 16,
            'phone' => 573832,
            'client_id' => 1,
            'password' => Hash::make('einfach'),
        ]);
        DB::table('users')->insert([
            'name' => 'Gunther_Meisel',
            'rank' => 5,
            'player_id' => 55,
            'phone' => 573832,
            'client_id' => 1,
            'password' => Hash::make('einfach'),
        ]);
        User::find(1)->assignRole('Admin');
        User::find(2)->assignRole('Editor');
        User::find(3)->assignRole('Benutzer');
        User::find(4)->assignRole('Benutzer');
        User::find(5)->assignRole('Benutzer');
        User::find(6)->assignRole('Benutzer');
        User::find(7)->assignRole('Benutzer');
    }
}
