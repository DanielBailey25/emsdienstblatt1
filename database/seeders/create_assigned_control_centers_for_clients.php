<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class create_assigned_control_centers_for_clients extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('assigned_control_centers')->insert([
            'name' => 'Einsatzleitung',
            'client_id' => 1,
        ]);
        DB::table('assigned_control_centers')->insert([
            'name' => 'Leitstelle',
            'client_id' => 1,
        ]);
    }
}
