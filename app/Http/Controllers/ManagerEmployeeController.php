<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Support\Facades\Auth;

class ManagerEmployeeController extends Controller
{
    public function index()
    {
        $manager = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | Cari data employee milik Manager
        |--------------------------------------------------------------------------
        */

        $managerEmployee = Employee::where(
            'user_id',
            $manager->id
        )->first();

        /*
        |--------------------------------------------------------------------------
        | Jika Manager belum memiliki data employee
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $managerEmployee,
            403,
            'Data Manager belum terhubung dengan data karyawan.'
        );

        /*
        |--------------------------------------------------------------------------
        | Ambil karyawan berdasarkan department Manager
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
}