<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Exports\ManagerEmployeesExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ManagerEmployeeController extends Controller
{

    public function index()
    {
        return $this->managerEmployees();
    }
    
    public function managerEmployees()
    {
        $manager = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | Cari data Employee milik Manager
        |--------------------------------------------------------------------------
        */



        $managerEmployee = Employee::where(
            'user_id',
            $manager->id
        )->first();


        /*
        |--------------------------------------------------------------------------
        | Pastikan Manager memiliki data Employee
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $managerEmployee,
            403,
            'Data Manager belum terhubung dengan data karyawan.'
        );


        /*
        |--------------------------------------------------------------------------
        | Ambil karyawan berdasarkan Department Manager
        |--------------------------------------------------------------------------
        */

        $employees = Employee::with([
            'department',
            'position'
        ])
            ->where(
                'department_id',
                $managerEmployee->department_id
            )
            ->latest()
            ->paginate(10);


        return view(
            'manager.employees.index',
            compact('employees')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Generate Excel
    |--------------------------------------------------------------------------
    */

    public function exportEmployees()
    {
        $manager = Auth::user();


        /*
        |--------------------------------------------------------------------------
        | Cari Employee Manager
        |--------------------------------------------------------------------------
        */

        $managerEmployee = Employee::where(
            'user_id',
            $manager->id
        )->first();


        /*
        |--------------------------------------------------------------------------
        | Pastikan Manager Terhubung
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $managerEmployee,
            403,
            'Data Manager belum terhubung dengan data karyawan.'
        );


        /*
        |--------------------------------------------------------------------------
        | Department Manager
        |--------------------------------------------------------------------------
        */

        $departmentId =
            $managerEmployee->department_id;


        /*
        |--------------------------------------------------------------------------
        | Nama Department
        |--------------------------------------------------------------------------
        */

        $departmentName =
            $managerEmployee->department
            ? $managerEmployee->department->department_name
            : 'Department';


        /*
        |--------------------------------------------------------------------------
        | Download Excel
        |--------------------------------------------------------------------------
        */

        return Excel::download(
            new ManagerEmployeesExport($departmentId),
            'Data-Karyawan-' . $departmentName . '.xlsx'
        );
    }
}
