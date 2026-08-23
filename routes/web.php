<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\DocumentController;

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
    |--------------------------------------------------------------------------
    | HR
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:HR')
        ->prefix('hr')
        ->group(function () {

            Route::get('/dashboard', [
                DashboardController::class,
                'hr'
            ])->name('hr.dashboard');
        });


    /*
    |--------------------------------------------------------------------------
    | Manager
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:Manager')
        ->prefix('manager')
        ->group(function () {

            Route::get('/dashboard', [
                DashboardController::class,
                'manager'
            ])->name('manager.dashboard');
        });


    /*
    |--------------------------------------------------------------------------
    | Karyawan
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:Karyawan')
        ->prefix('employee')
        ->group(function () {

            Route::get('/dashboard', [
                DashboardController::class,
                'employee'
            ])->name('employee.dashboard');
        });


    /*
    |--------------------------------------------------------------------------
    | Department & Position
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:HR')->group(function () {

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
    });
});

require __DIR__ . '/profile.php';
require __DIR__ . '/auth.php';
