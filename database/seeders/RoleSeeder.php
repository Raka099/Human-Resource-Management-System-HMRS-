<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            'HR',
            'Manager',
            'Karyawan',
        ];

        foreach ($roles as $role) {

            Role::firstOrCreate([
                'role_name' => $role,
            ]);

        }
    }
}