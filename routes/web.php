<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\PermissionRequestController;
use App\Http\Controllers\OvertimeRequestController;
use App\Http\Controllers\ManagerApprovalController;
use App\Http\Controllers\EmployeeReportController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {

        $user = Auth::user();

        $role = $user->role?->role_name;

        return match ($role) {

            'HR' => redirect()->route('hr.dashboard'),

            'Manager' => redirect()->route('manager.dashboard'),

            'Karyawan' => redirect()->route('employee.dashboard'),

            default => abort(403),
        };
    })->name('dashboard');


    /*
    // |--------------------------------------------------------------------------
    // | HR
    // |--------------------------------------------------------------------------
    // */

    // Route::middleware('role:HR')
    //     ->prefix('hr')
    //     ->group(function () {

    //         Route::get('/dashboard', [
    //             DashboardController::class,
    //             'hr'
    //         ])->name('hr.dashboard');
    //     });


    /*
    |--------------------------------------------------------------------------
    | Manager
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:Manager')
        ->prefix('manager')
        ->group(function () {

            /*
        |--------------------------------------------------------------------------
        | Dashboard Manager
        |--------------------------------------------------------------------------
        */

            Route::get('/dashboard', [
                DashboardController::class,
                'manager'
            ])->name('manager.dashboard');


            /*
        |--------------------------------------------------------------------------
        | Approval Pengajuan
        |--------------------------------------------------------------------------
        */

            Route::get('/approvals', [
                ManagerApprovalController::class,
                'index'
            ])->name('manager.approvals.index');


            /*
        |--------------------------------------------------------------------------
        | Approval Cuti
        |--------------------------------------------------------------------------
        */

            Route::patch('/approvals/leave/{leaveRequest}', [
                ManagerApprovalController::class,
                'approveLeave'
            ])->name('manager.approvals.leave');


            /*
        |--------------------------------------------------------------------------
        | Approval Izin
        |--------------------------------------------------------------------------
        */

            Route::patch('/approvals/permission/{permissionRequest}', [
                ManagerApprovalController::class,
                'approvePermission'
            ])->name('manager.approvals.permission');


            /*
        |--------------------------------------------------------------------------
        | Approval Lembur
        |--------------------------------------------------------------------------
        */

            Route::patch('/approvals/overtime/{overtimeRequest}', [
                ManagerApprovalController::class,
                'approveOvertime'
            ])->name('manager.approvals.overtime');
        });

    /*
    |--------------------------------------------------------------------------
    | Karyawan
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:HR')
        ->prefix('hr')
        ->group(function () {

            Route::get('/dashboard', [
                DashboardController::class,
                'hr'
            ])->name('hr.dashboard');

            Route::resource('departments', DepartmentController::class)
                ->except(['show']);

            Route::resource('positions', PositionController::class)
                ->except(['show']);

            Route::resource(
                'employees',
                EmployeeController::class
            )->except(['show']);

            Route::resource(
                'applicants',
                ApplicantController::class
            )->except(['show']);

            Route::patch(
                '/applicants/{applicant}/status',
                [ApplicantController::class, 'updateStatus']
            )->name('applicants.update-status');

            Route::get(
                '/applicants/{applicant}/generate-employee',
                [ApplicantController::class, 'generateEmployee']
            )->name('applicants.generate-employee');

            Route::post(
                '/applicants/{applicant}/generate-employee',
                [ApplicantController::class, 'storeGeneratedEmployee']
            )->name('applicants.store-generated-employee');

            Route::resource(
                'employees.documents',
                DocumentController::class
            )->except(['show']);

            Route::resource(
                'employees.contracts',
                ContractController::class
            )->except(['show']);

            Route::get('/reports/employees', [
                EmployeeReportController::class,
                'index'
            ])->name('reports.employees.index');

            Route::get('/reports', [
                EmployeeReportController::class,
                'dashboard'
            ])->name('reports.dashboard');


            Route::get('/reports/employees', [
                EmployeeReportController::class,
                'index'
            ])->name('reports.employees.index');


            Route::get('/reports/leave', [
                EmployeeReportController::class,
                'leave'
            ])->name('reports.leave.index');


            Route::get('/reports/permission', [
                EmployeeReportController::class,
                'permission'
            ])->name('reports.permission.index');


            Route::get('/reports/overtime', [
                EmployeeReportController::class,
                'overtime'
            ])->name('reports.overtime.index');
        });

    Route::middleware('role:Karyawan')
        ->prefix('employee')
        ->group(function () {


            /*
            |--------------------------------------------------------------------------
            | Dashboard
            |--------------------------------------------------------------------------
            */

            Route::get('/dashboard', [
                DashboardController::class,
                'employee'
            ])->name('employee.dashboard');


            /*
            |--------------------------------------------------------------------------
            | Pengajuan Cuti
            |--------------------------------------------------------------------------
            */

            Route::get('/leave-requests', [
                LeaveRequestController::class,
                'index'
            ])->name('employee.leave-requests.index');

            Route::get('/leave-requests/create', [
                LeaveRequestController::class,
                'create'
            ])->name('employee.leave-requests.create');

            Route::post('/leave-requests', [
                LeaveRequestController::class,
                'store'
            ])->name('employee.leave-requests.store');

            /*
            |--------------------------------------------------------------------------
            | Pengajuan Izin
            |--------------------------------------------------------------------------
            */

            Route::get('/permission-requests', [
                PermissionRequestController::class,
                'index'
            ])->name('employee.permission-requests.index');


            Route::get('/permission-requests/create', [
                PermissionRequestController::class,
                'create'
            ])->name('employee.permission-requests.create');


            Route::post('/permission-requests', [
                PermissionRequestController::class,
                'store'
            ])->name('employee.permission-requests.store');

            /*
            |--------------------------------------------------------------------------
            | Pengajuan Lembur
            |--------------------------------------------------------------------------
            */

            Route::get('/overtime-requests', [
                OvertimeRequestController::class,
                'index'
            ])->name('employee.overtime-requests.index');


            Route::get('/overtime-requests/create', [
                OvertimeRequestController::class,
                'create'
            ])->name('employee.overtime-requests.create');


            Route::post('/overtime-requests', [
                OvertimeRequestController::class,
                'store'
            ])->name('employee.overtime-requests.store');
        });
});

require __DIR__ . '/profile.php';
require __DIR__ . '/auth.php';
