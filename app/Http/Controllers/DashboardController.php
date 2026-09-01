<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Applicant;
use App\Models\Document;
use App\Models\Contract;
use App\Models\LeaveRequest;
use App\Models\PermissionRequest;
use App\Models\OvertimeRequest;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HR Dashboard
    |--------------------------------------------------------------------------
    */

    public function hr()
    {
        $employeeCount = Employee::count();

        $applicantCount = Applicant::count();

        $documentCount = Document::count();

        $contractCount = Contract::count();

        $leaveCount = LeaveRequest::count();

        $permissionCount = PermissionRequest::count();

        $overtimeCount = OvertimeRequest::count();

        return view('hr.dashboard', compact(
            'employeeCount',
            'applicantCount',
            'documentCount',
            'contractCount',
            'leaveCount',
            'permissionCount',
            'overtimeCount'
        ));
    }


    /*
    |--------------------------------------------------------------------------
    | Manager Dashboard
    |--------------------------------------------------------------------------
    */

    public function manager()
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
    | Pastikan Manager terhubung dengan Employee
    |--------------------------------------------------------------------------
    */

        abort_unless(
            $managerEmployee,
            403,
            'Data Manager belum terhubung dengan data karyawan.'
        );

        $departmentId = $managerEmployee->department_id;


        /*
    |--------------------------------------------------------------------------
    | Data Department Manager
    |--------------------------------------------------------------------------
    */

        $department = Department::find($departmentId);


        /*
    |--------------------------------------------------------------------------
    | Jumlah Karyawan Department
    |--------------------------------------------------------------------------
    */

        $employeeCount = Employee::where(
            'department_id',
            $departmentId
        )->count();


        /*
    |--------------------------------------------------------------------------
    | Pengajuan Cuti Pending
    |--------------------------------------------------------------------------
    */

        $pendingLeave = LeaveRequest::whereHas(
            'employee',
            function ($query) use ($departmentId) {

                $query->where(
                    'department_id',
                    $departmentId
                );
            }
        )
            ->where('manager_status', 'Pending')
            ->count();


        /*
    |--------------------------------------------------------------------------
    | Pengajuan Izin Pending
    |--------------------------------------------------------------------------
    */

        $pendingPermission = PermissionRequest::whereHas(
            'employee',
            function ($query) use ($departmentId) {

                $query->where(
                    'department_id',
                    $departmentId
                );
            }
        )
            ->where('manager_status', 'Pending')
            ->count();


        /*
    |--------------------------------------------------------------------------
    | Pengajuan Lembur Pending
    |--------------------------------------------------------------------------
    */

        $pendingOvertime = OvertimeRequest::whereHas(
            'employee',
            function ($query) use ($departmentId) {

                $query->where(
                    'department_id',
                    $departmentId
                );
            }
        )
            ->where('manager_status', 'Pending')
            ->count();


        /*
    |--------------------------------------------------------------------------
    | Return Dashboard Manager
    |--------------------------------------------------------------------------
    */

        return view(
            'manager.dashboard',
            compact(
                'managerEmployee',
                'department',
                'employeeCount',
                'pendingLeave',
                'pendingPermission',
                'pendingOvertime'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Employee Dashboard
    |--------------------------------------------------------------------------
    */

    public function employee()
    {
        $employee = Auth::user()->employee;

        abort_unless($employee, 403);

        $leaveCount = LeaveRequest::where(
            'employee_id',
            $employee->id
        )->count();

        $permissionCount = PermissionRequest::where(
            'employee_id',
            $employee->id
        )->count();

        $overtimeCount = OvertimeRequest::where(
            'employee_id',
            $employee->id
        )->count();

        return view(
            'employee.dashboard',
            compact(
                'employee',
                'leaveCount',
                'permissionCount',
                'overtimeCount'
            )
        );
    }
}
