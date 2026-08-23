<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Ambil Role
        |--------------------------------------------------------------------------
        */

        $hr = Role::where(
            'role_name',
            'HR'
        )->first();

        $manager = Role::where(
            'role_name',
            'Manager'
        )->first();

        $employeeRole = Role::where(
            'role_name',
            'Karyawan'
        )->first();


        /*
        |--------------------------------------------------------------------------
        | User HR
        |--------------------------------------------------------------------------
        */

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


        /*
        |--------------------------------------------------------------------------
        | User Manager
        |--------------------------------------------------------------------------
        */

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


        /*
        |--------------------------------------------------------------------------
        | User Karyawan
        |--------------------------------------------------------------------------
        */

        $employeeUser = User::updateOrCreate(
            [
                'email' => 'employee@hrms.test',
            ],
            [
                'name' => 'Employee HRMS',
                'role_id' => $employeeRole->id,
                'password' => Hash::make('password'),
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | Hubungkan User dengan Employee
        |--------------------------------------------------------------------------
        */

        $employeeData = Employee::where(
            'email',
            'employee@hrms.test'
        )->first();

        if ($employeeData) {

            $employeeData->update([
                'user_id' => $employeeUser->id,
            ]);

        }
    }
}