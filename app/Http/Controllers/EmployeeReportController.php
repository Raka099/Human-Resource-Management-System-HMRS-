<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\PermissionRequest;
use App\Models\OvertimeRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Exports\EmployeesExport;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeReportController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Laporan Data Karyawan
    |--------------------------------------------------------------------------
    */

    public function index(Request $request): View
    {
        $query = Employee::with([
            'department',
            'position',
        ]);

        if ($request->filled('department_id')) {
            $query->where(
                'department_id',
                $request->department_id
            );
        }

        if ($request->filled('employment_status')) {
            $query->where(
                'employment_status',
                $request->employment_status
            );
        }

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

        $employees = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

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


    /*
    |--------------------------------------------------------------------------
    | 17.2 Laporan Cuti
    |--------------------------------------------------------------------------
    */

    public function leave(Request $request): View
    {
        $query = LeaveRequest::with([
            'employee',
            'employee.department',
        ]);

        if ($request->filled('status')) {
            $query->where(
                'status',
                $request->status
            );
        }

        if ($request->filled('department_id')) {

            $query->whereHas(
                'employee',
                function ($q) use ($request) {
                    $q->where(
                        'department_id',
                        $request->department_id
                    );
                }
            );
        }

        if ($request->filled('search')) {

            $search = $request->search;

            $query->whereHas(
                'employee',
                function ($q) use ($search) {

                    $q->where(
                        'full_name',
                        'like',
                        "%{$search}%"
                    )
                        ->orWhere(
                            'employee_number',
                            'like',
                            "%{$search}%"
                        );
                }
            );
        }

        $leaveRequests = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $departments = Department::orderBy(
            'department_name'
        )->get();

        return view(
            'reports.leave.index',
            compact(
                'leaveRequests',
                'departments'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | 17.3 Laporan Izin
    |--------------------------------------------------------------------------
    */

    public function permission(Request $request): View
    {
        $query = PermissionRequest::with([
            'employee',
            'employee.department',
        ]);

        if ($request->filled('status')) {
            $query->where(
                'status',
                $request->status
            );
        }

        if ($request->filled('department_id')) {

            $query->whereHas(
                'employee',
                function ($q) use ($request) {
                    $q->where(
                        'department_id',
                        $request->department_id
                    );
                }
            );
        }

        if ($request->filled('search')) {

            $search = $request->search;

            $query->whereHas(
                'employee',
                function ($q) use ($search) {

                    $q->where(
                        'full_name',
                        'like',
                        "%{$search}%"
                    )
                        ->orWhere(
                            'employee_number',
                            'like',
                            "%{$search}%"
                        );
                }
            );
        }

        $permissionRequests = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $departments = Department::orderBy(
            'department_name'
        )->get();

        return view(
            'reports.permission.index',
            compact(
                'permissionRequests',
                'departments'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | 17.4 Laporan Lembur
    |--------------------------------------------------------------------------
    */

    public function overtime(Request $request): View
    {
        $query = OvertimeRequest::with([
            'employee',
            'employee.department',
        ]);

        if ($request->filled('status')) {
            $query->where(
                'status',
                $request->status
            );
        }

        if ($request->filled('department_id')) {

            $query->whereHas(
                'employee',
                function ($q) use ($request) {
                    $q->where(
                        'department_id',
                        $request->department_id
                    );
                }
            );
        }

        if ($request->filled('search')) {

            $search = $request->search;

            $query->whereHas(
                'employee',
                function ($q) use ($search) {

                    $q->where(
                        'full_name',
                        'like',
                        "%{$search}%"
                    )
                        ->orWhere(
                            'employee_number',
                            'like',
                            "%{$search}%"
                        );
                }
            );
        }

        $overtimeRequests = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $departments = Department::orderBy(
            'department_name'
        )->get();

        return view(
            'reports.overtime.index',
            compact(
                'overtimeRequests',
                'departments'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | 17.5 Dashboard Laporan
    |--------------------------------------------------------------------------
    */

    public function dashboard(): View
    {
        $employeeCount = Employee::count();

        $activeEmployeeCount = Employee::where(
            'employment_status',
            'Active'
        )->count();

        $inactiveEmployeeCount = Employee::where(
            'employment_status',
            'Inactive'
        )->count();

        $leaveCount = LeaveRequest::count();

        $permissionCount = PermissionRequest::count();

        $overtimeCount = OvertimeRequest::count();

        $leavePending = LeaveRequest::where(
            'status',
            'Pending'
        )->count();

        $leaveApproved = LeaveRequest::where(
            'status',
            'Approved'
        )->count();

        $leaveRejected = LeaveRequest::where(
            'status',
            'Rejected'
        )->count();

        $permissionPending = PermissionRequest::where(
            'status',
            'Pending'
        )->count();

        $permissionApproved = PermissionRequest::where(
            'status',
            'Approved'
        )->count();

        $permissionRejected = PermissionRequest::where(
            'status',
            'Rejected'
        )->count();

        $overtimePending = OvertimeRequest::where(
            'status',
            'Pending'
        )->count();

        $overtimeApproved = OvertimeRequest::where(
            'status',
            'Approved'
        )->count();

        $overtimeRejected = OvertimeRequest::where(
            'status',
            'Rejected'
        )->count();

        return view(
            'reports.dashboard',
            compact(
                'employeeCount',
                'activeEmployeeCount',
                'inactiveEmployeeCount',
                'leaveCount',
                'permissionCount',
                'overtimeCount',
                'leavePending',
                'leaveApproved',
                'leaveRejected',
                'permissionPending',
                'permissionApproved',
                'permissionRejected',
                'overtimePending',
                'overtimeApproved',
                'overtimeRejected'
            )
        );
    }
    public function export(Request $request)
    {
        return Excel::download(
            new EmployeesExport($request),
            'laporan-data-karyawan.xlsx'
        );
    }

    public function managerEmployees(Request $request)
    {
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
            ->when($request->employment_status, function ($query, $status) {
                $query->where(
                    'employment_status',
                    $status
                );
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();


        $departments = Department::orderBy(
            'department_name'
        )->get();


        return view(
            'manager.employees.index',
            compact(
                'employees',
                'departments'
            )
        );
    }
}
