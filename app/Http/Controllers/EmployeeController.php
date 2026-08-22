<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

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

    public function store(Request $request): RedirectResponse
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

        Employee::create($validated);

        return redirect()
            ->route('employees.index')
            ->with(
                'success',
                'Data karyawan berhasil ditambahkan.'
            );
    }

    public function edit(Employee $employee): View
    {
        $departments = Department::orderBy('department_name')->get();

        $positions = Position::orderBy('position_name')->get();

        return view(
            'employees.edit',
            compact(
                'employee',
                'departments',
                'positions'
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

            'employment_status' => [
                'required',
                'in:Active,Inactive',
            ],
        ]);

        $employee->update($validated);

        return redirect()
            ->route('employees.index')
            ->with(
                'success',
                'Data karyawan berhasil diperbarui.'
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