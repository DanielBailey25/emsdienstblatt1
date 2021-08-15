<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(create_clients::class);
        $this->call(create_roles::class);
        $this->call(create_users::class);
        $this->call(create_item_types::class);
        $this->call(create_items::class);
        $this->call(create_states::class);
        $this->call(create_assigned_control_centers_for_clients::class);
        $this->call(create_absence_types::class);
        $this->call(create_news_categories::class);
        $this->call(create_courses::class);
    }
}
