<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::updateOrInsert(
            ['id' => 1],
            ['nama_role' => 'super_admin']
        );
        Role::updateOrInsert(
            ['id' => 2],
            ['nama_role' => 'admin']
        );
    }
}
