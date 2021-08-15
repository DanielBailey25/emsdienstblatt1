<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class create_roles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(
            ['name' => 'Benutzer'],
        );
        Role::create(
            ['name' => 'Editor'],
        );
        Role::create(
            ['name' => 'Admin'],
        );
    }
}
