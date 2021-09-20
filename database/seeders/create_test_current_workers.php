<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class create_test_current_workers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('current_worker')->insert([
            'client_id' => 1,
            'user_id' => 1,
            'item_id' => 1,
            'state_id' => 1,
            'related_id' => null,
            'started_at' => '2021-08-16 09:20:47',
            'updated_at' => '2021-08-16 09:20:47',
        ]);

        DB::table('current_worker')->insert([
            'client_id' => 1,
            'user_id' => 2,
            'item_id' => 1,
            'state_id' => 1,
            'related_id' => 1,
            'started_at' => '2021-08-15 09:20:47',
            'updated_at' => '2021-08-15 09:20:47',
        ]);

        DB::table('current_worker')->insert([
            'client_id' => 1,
            'user_id' => 4,
            'item_id' => 2,
            'state_id' => 1,
            'related_id' => null,
            'started_at' => '2021-08-15 23:20:47',
            'updated_at' => '2021-08-15 23:20:47',
        ]);
        DB::table('current_worker')->insert([
            'client_id' => 1,
            'user_id' => 3,
            'item_id' => 2,
            'state_id' => 1,
            'related_id' => 3,
            'started_at' => '2021-08-16 02:53:47',
            'updated_at' => '2021-08-16 02:53:47',
        ]);
        DB::table('current_worker')->insert([
            'client_id' => 1,
            'user_id' => 5,
            'item_id' => 2,
            'state_id' => 1,
            'related_id' => 3,
            'started_at' => '2021-08-16 04:34:47',
            'updated_at' => '2021-08-16 04:34:47',
        ]);

        DB::table('current_worker')->insert([
            'client_id' => 1,
            'user_id' => 6,
            'item_id' => 3,
            'state_id' => 2,
            'related_id' => null,
            'started_at' => '2021-08-16 09:10:47',
            'updated_at' => '2021-08-16 09:10:47',
        ]);

        DB::table('current_worker')->insert([
            'client_id' => 1,
            'user_id' => 7,
            'item_id' => 4,
            'state_id' => 1,
            'related_id' => null,
            'started_at' => '2021-08-16 06:27:47',
            'updated_at' => '2021-08-16 06:27:47',
        ]);
    }
}
