<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use App\Models\LeaveRequest;
use App\Models\PermissionRequest;
use App\Models\OvertimeRequest;
use Illuminate\Http\Request;
use App\Exports\EmployeesExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function employees(Request $request)
    {
        $departments = Department::orderBy('department_name')->get();
        $positions = Position::orderBy('position_name')->get();

        $employees = Employee::with([
            'department',
            'position'
        ])
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('full_name', 'like', "%{$search}%")
                        ->orWhere(
                            'employee_number',
                            'like',
                            "%{$search}%"
                        )
                        ->orWhere(
                            'email',
                            'like',
                            "%{$search}%"
                        );
                });
            })
            ->when($request->department_id, function ($query, $id) {
                $query->where('department_id', $id);
            })
            ->when($request->position_id, function ($query, $id) {
                $query->where('position_id', $id);
            })
            ->when($request->employment_status, function ($query, $status) {
                $query->where(
                    'employment_status',
                    $status
                );
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'reports.employees',
            compact(
                'employees',
                'departments',
                'positions'
            )
        );
    }

    public function requests()
    {
        $leaveRequests = LeaveRequest::with('employee')
            ->latest()
            ->get();

        $permissionRequests = PermissionRequest::with('employee')
            ->latest()
            ->get();

        $overtimeRequests = OvertimeRequest::with('employee')
            ->latest()
            ->get();

        return view(
            'reports.requests',
            compact(
                'leaveRequests',
                'permissionRequests',
                'overtimeRequests'
            )
        );
    }
    public function employeesExcel(Request $request)
    {
        return Excel::download(
            new EmployeesExport($request),
            'laporan-data-karyawan.xlsx'
        );
    }
}
