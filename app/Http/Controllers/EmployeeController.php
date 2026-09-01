<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function index(): View
    {
        $employees = Employee::with([
            'department',
            'position',
        ])
            ->latest()
            ->get();

        return view('employees.index', compact('employees'));
    }

    public function create(): View
    {
        $departments = Department::orderBy('department_name')->get();

        $positions = Position::orderBy('position_name')->get();

        return view(
            'employees.create',
            compact('departments', 'positions')
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_number' => [
                'required',
                'string',
                'max:30',
                'unique:employees,employee_number',
            ],

            'full_name' => [
                'required',
                'string',
                'max:150',
            ],

            'email' => [
                'required',
                'email',
                'max:150',
                'unique:employees,email',
                'unique:users,email',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:20',
            ],

            'address' => [
                'nullable',
                'string',
            ],

            'birth_date' => [
                'nullable',
                'date',
            ],

            'join_date' => [
                'required',
                'date',
            ],

            'department_id' => [
                'required',
                'exists:departments,id',
            ],

            'position_id' => [
                'required',
                'exists:positions,id',
            ],

            'employment_status' => [
                'required',
                'in:Active,Inactive',
            ],
        ]);


        DB::transaction(function () use ($validated) {

            /*
        |--------------------------------------------------------------------------
        | Ambil Role Karyawan
        |--------------------------------------------------------------------------
        */

            $employeeRole = Role::where(
                'role_name',
                'Karyawan'
            )->firstOrFail();


            /*
        |--------------------------------------------------------------------------
        | Buat User
        |--------------------------------------------------------------------------
        */

            $user = User::create([
                'name' => $validated['full_name'],
                'email' => $validated['email'],
                'password' => Hash::make('password'),
                'role_id' => $employeeRole->id,
            ]);


            /*
        |--------------------------------------------------------------------------
        | Buat Employee
        |--------------------------------------------------------------------------
        */

            Employee::create([
                'user_id' => $user->id,

                'employee_number' =>
                $validated['employee_number'],

                'full_name' =>
                $validated['full_name'],

                'email' =>
                $validated['email'],

                'phone' =>
                $validated['phone'] ?? null,

                'address' =>
                $validated['address'] ?? null,

                'birth_date' =>
                $validated['birth_date'] ?? null,

                'join_date' =>
                $validated['join_date'],

                'department_id' =>
                $validated['department_id'],

                'position_id' =>
                $validated['position_id'],

                'employment_status' =>
                $validated['employment_status'],
            ]);
        });


        return redirect()
            ->route('employees.index')
            ->with(
                'success',
                'Karyawan berhasil ditambahkan dan akun login berhasil dibuat.'
            );
    }

    public function edit(Employee $employee): View
    {
        $departments = Department::orderBy('department_name')->get();

        $positions = Position::orderBy('position_name')->get();

        $roles = Role::whereIn(
            'role_name',
            ['Karyawan', 'Manager']
        )
            ->orderBy('role_name')
            ->get();

        return view(
            'employees.edit',
            compact(
                'employee',
                'departments',
                'positions',
                'roles'
            )
        );
    }

    public function update(
        Request $request,
        Employee $employee
    ): RedirectResponse {

        $validated = $request->validate([
            'employee_number' => [
                'required',
                'string',
                'max:30',
                'unique:employees,employee_number,' . $employee->id,
            ],

            'full_name' => [
                'required',
                'string',
                'max:150',
            ],

            'email' => [
                'required',
                'email',
                'max:150',
                'unique:employees,email,' . $employee->id,
            ],

            'phone' => [
                'nullable',
                'string',
                'max:20',
            ],

            'address' => [
                'nullable',
                'string',
            ],

            'birth_date' => [
                'nullable',
                'date',
            ],

            'join_date' => [
                'required',
                'date',
            ],

            'department_id' => [
                'required',
                'exists:departments,id',
            ],

            'position_id' => [
                'required',
                'exists:positions,id',
            ],

            'role_id' => [
                'required',
                'exists:roles,id',
            ],

            'employment_status' => [
                'required',
                'in:Active,Inactive',
            ],
        ]);


        DB::transaction(function () use (
            $validated,
            $employee
        ) {

            /*
        |--------------------------------------------------------------------------
        | Update Data Employee
        |--------------------------------------------------------------------------
        */

            $employee->update([
                'employee_number' =>
                $validated['employee_number'],

                'full_name' =>
                $validated['full_name'],

                'email' =>
                $validated['email'],

                'phone' =>
                $validated['phone'] ?? null,

                'address' =>
                $validated['address'] ?? null,

                'birth_date' =>
                $validated['birth_date'] ?? null,

                'join_date' =>
                $validated['join_date'],

                'department_id' =>
                $validated['department_id'],

                'position_id' =>
                $validated['position_id'],

                'employment_status' =>
                $validated['employment_status'],
            ]);


            /*
        |--------------------------------------------------------------------------
        | Update Role User
        |--------------------------------------------------------------------------
        */

            if ($employee->user) {

                $employee->user->update([
                    'name' =>
                    $validated['full_name'],

                    'email' =>
                    $validated['email'],

                    'role_id' =>
                    $validated['role_id'],
                ]);
            }
        });


        return redirect()
            ->route('employees.index')
            ->with(
                'success',
                'Data karyawan dan role berhasil diperbarui.'
            );
    }

    public function destroy(Employee $employee): RedirectResponse
    {
        $employee->delete();

        return redirect()
            ->route('employees.index')
            ->with(
                'success',
                'Data karyawan berhasil dihapus.'
            );
    }
}
