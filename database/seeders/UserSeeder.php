<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $hr = Role::where('role_name', 'HR')->first();
        $manager = Role::where('role_name', 'Manager')->first();
        $employee = Role::where('role_name', 'Karyawan')->first();

        User::updateOrCreate(
            [
                'email' => 'hr@hrms.test',
            ],
            [
                'name' => 'HR Administrator',
                'role_id' => $hr->id,
                'password' => Hash::make('password'),
            ]
        );

        User::updateOrCreate(
            [
                'email' => 'manager@hrms.test',
            ],
            [
                'name' => 'Manager HRMS',
                'role_id' => $manager->id,
                'password' => Hash::make('password'),
            ]
        );

        User::updateOrCreate(
            [
                'email' => 'employee@hrms.test',
            ],
            [
                'name' => 'Employee HRMS',
                'role_id' => $employee->id,
                'password' => Hash::make('password'),
            ]
        );
    }
}