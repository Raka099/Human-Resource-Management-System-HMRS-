<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmployeeReportController extends Controller
{
    public function index(Request $request): View
    {
        $query = Employee::with([
            'department',
            'position',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Filter Department
        |--------------------------------------------------------------------------
        */

        if ($request->filled('department_id')) {
            $query->where(
                'department_id',
                $request->department_id
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Filter Status
        |--------------------------------------------------------------------------
        */

        if ($request->filled('employment_status')) {
            $query->where(
                'employment_status',
                $request->employment_status
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where(
                    'employee_number',
                    'like',
                    "%{$search}%"
                )
                ->orWhere(
                    'full_name',
                    'like',
                    "%{$search}%"
                )
                ->orWhere(
                    'email',
                    'like',
                    "%{$search}%"
                );

            });
        }


        /*
        |--------------------------------------------------------------------------
        | Data Employee
        |--------------------------------------------------------------------------
        */

        $employees = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | Department
        |--------------------------------------------------------------------------
        */

        $departments = Department::orderBy(
            'department_name'
        )->get();


        return view(
            'reports.employees.index',
            compact(
                'employees',
                'departments'
            )
        );
    }
}