<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Applicant;
use App\Models\Document;
use App\Models\Contract;
use App\Models\LeaveRequest;
use App\Models\PermissionRequest;
use App\Models\OvertimeRequest;
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
        $employeeCount = Employee::count();

        $leaveCount = LeaveRequest::count();

        $permissionCount = PermissionRequest::count();

        $overtimeCount = OvertimeRequest::count();

        return view(
            'manager.dashboard',
            compact(
                'employeeCount',
                'leaveCount',
                'permissionCount',
                'overtimeCount'
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
