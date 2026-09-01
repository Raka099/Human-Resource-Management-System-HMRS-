<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
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

        $hr = Role::where('role_name', 'HR')->first();

        $managerRole = Role::where(
            'role_name',
            'Manager'
        )->first();

        $employeeRole = Role::where(
            'role_name',
            'Karyawan'
        )->first();


        /*
        |--------------------------------------------------------------------------
        | USER HR
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
        | MANAGER IT
        |--------------------------------------------------------------------------
        */

        $itDepartment = Department::where(
            'department_name',
            'IT'
        )->first();

        $managerIT = User::updateOrCreate(
            [
                'email' => 'manager.it@hrms.test',
            ],
            [
                'name' => 'Manager IT',
                'role_id' => $managerRole->id,
                'password' => Hash::make('password'),
            ]
        );

        $itPosition = Position::where(
            'position_name',
            'manager IT'
        )->first();

        if ($itDepartment && $itPosition) {

            Employee::updateOrCreate(
                [
                    'user_id' => $managerIT->id,
                ],
                [
                    'employee_number' => 'MGR-IT-001',
                    'department_id' => $itDepartment->id,
                    'position_id' => $itPosition->id,
                    'full_name' => 'Manager IT',
                    'email' => 'manager.it@hrms.test',
                    'join_date' => now()->toDateString(),
                    'employment_status' => 'Active',
                ]
            );
        }


        /*
        |--------------------------------------------------------------------------
        | MANAGER R&D
        |--------------------------------------------------------------------------
        */

        $rndDepartment = Department::where(
            'department_name',
            'RnD'
        )->first();

        $managerRnD = User::updateOrCreate(
            [
                'email' => 'manager.rnd@hrms.test',
            ],
            [
                'name' => 'Manager RnD',
                'role_id' => $managerRole->id,
                'password' => Hash::make('password'),
            ]
        );

        $rndPosition = Position::where(
            'position_name',
            'manager RnD'
        )->first();

        if ($rndDepartment && $rndPosition) {

            Employee::updateOrCreate(
                [
                    'user_id' => $managerRnD->id,
                ],
                [
                    'employee_number' => 'MGR-RND-001',
                    'department_id' => $rndDepartment->id,
                    'position_id' => $rndPosition->id,
                    'full_name' => 'Manager RnD',
                    'email' => 'manager.rnd@hrms.test',
                    'join_date' => now()->toDateString(),
                    'employment_status' => 'Active',
                ]
            );
        }


        /*
        |--------------------------------------------------------------------------
        | MANAGER DIGITAL MARKETING
        |--------------------------------------------------------------------------
        */

        $marketingDepartment = Department::where(
            'department_name',
            'Marketing'
        )->first();

        $managerMarketing = User::updateOrCreate(
            [
                'email' => 'manager.marketing@hrms.test',
            ],
            [
                'name' => 'Manager Marketing',
                'role_id' => $managerRole->id,
                'password' => Hash::make('password'),
            ]
        );

        $marketingPosition = Position::where(
            'position_name',
            'manager Marketing'
        )->first();

        if ($marketingDepartment && $marketingPosition) {

            Employee::updateOrCreate(
                [
                    'user_id' => $managerMarketing->id,
                ],
                [
                    'employee_number' => 'MGR-MKT-001',
                    'department_id' => $marketingDepartment->id,
                    'position_id' => $marketingPosition->id,
                    'full_name' => 'Manager Marketing',
                    'email' => 'manager.marketing@hrms.test',
                    'join_date' => now()->toDateString(),
                    'employment_status' => 'Active',
                ]
            );
        }

        /*
        |--------------------------------------------------------------------------
        | USER KARYAWAN
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
