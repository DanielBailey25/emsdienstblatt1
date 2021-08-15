<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class create_news_categories extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news_categories')->insert([
            'name' => 'Aktuelle Dienstanweisungen',
            'client_id' => 1,
        ]);
        DB::table('news_categories')->insert([
            'name' => 'Aktuelle Informationen',
            'client_id' => 1,
        ]);
    }
}
