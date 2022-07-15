<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;
use App\Models\RoleUser;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdminRole = Role::where('nama_role', 'super_admin')->first();
        $adminRole = Role::where('nama_role', 'admin')->first();
        User::updateOrInsert(
            [
                'email' => 'superadmin@gmail.com',
            ],
            [
                'name' => 'super admin',
                'password' => Hash::make('password')
            ]
        );
        $superAdmin = User::where('email', 'superadmin@gmail.com')->first();

        RoleUser::updateOrInsert(
            [
                'users_id' => $superAdmin->id,
                'roles_id' => $superAdminRole->id,
            ],
            []
        );

        User::updateOrInsert(
            [
                'email' => 'admin@gmail.com',
            ],
            [
                'name' => 'admin 1',
                'password' => Hash::make('password')
            ]
        );
        $admin = User::where('email', 'admin@gmail.com')->first();

        RoleUser::updateOrInsert(
            [
                'users_id' => $admin->id,
                'roles_id' => $adminRole->id,
            ],
            []
        );

    }
}
