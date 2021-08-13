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
            'name' => 'Außendienst',
            'description' => 'Aktiv im Außendienst unterwegs',
            'client_id' => 1,
        ]);
        DB::table('states')->insert([
            'name' => 'Innendienst',
            'description' => 'Aktiv im Innendienst unterwegs',
            'client_id' => 1,
        ]);
        DB::table('states')->insert([
            'name' => 'Code 7',
            'description' => 'Break/Pause/Kopfschmerzen',
            'client_id' => 1,
        ]);
        DB::table('states')->insert([
            'name' => 'Büro',
            'description' => 'Büroarbeit',
            'client_id' => 1,
        ]);
        DB::table('states')->insert([
            'name' => 'Einsatz',
            'client_id' => 1,
        ]);
        DB::table('states')->insert([
            'name' => 'Event',
            'client_id' => 1,
        ]);
        DB::table('states')->insert([
            'name' => 'EHK',
            'description' => 'im Erste Hilfe Kurs evtl nicht im Funk',
            'client_id' => 1,
        ]);
        DB::table('states')->insert([
            'name' => 'FST',
            'client_id' => 1,
        ]);
        DB::table('states')->insert([
            'name' => 'Schulung',
            'description' => 'in einer Schulung evtl nicht im Funk',
            'client_id' => 1,
        ]);
        DB::table('states')->insert([
            'name' => 'Prüfung',
            'client_id' => 1,
        ]);
        DB::table('states')->insert([
            'name' => 'Code 69',
            'client_id' => 1,
        ]);
        DB::table('states')->insert([
            'name' => 'Besprechung',
            'client_id' => 1,
        ]);
        DB::table('states')->insert([
            'name' => 'Bewerbungsrunde',
            'client_id' => 1,
        ]);
    }
}
