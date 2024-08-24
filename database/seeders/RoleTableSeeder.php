<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'role_name' => 'Administrator',
            'short_code' => 'Admin',
        ]);

        Role::create([
            'role_name' => 'User',
        ]);
    }
}
