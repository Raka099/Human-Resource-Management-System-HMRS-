<?php

namespace App\Http\Controllers;

use App\Models\PermissionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermissionRequestController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Daftar Pengajuan Izin Karyawan
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $employee = Auth::user()->employee;

        abort_unless($employee, 403);

        $permissionRequests = PermissionRequest::where(
            'employee_id',
            $employee->id
        )
            ->latest()
            ->get();

        return view(
            'employee.permission_requests.index',
            compact('permissionRequests')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Form Pengajuan Izin
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $employee = Auth::user()->employee;

        abort_unless($employee, 403);

        return view(
            'employee.permission_requests.create'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Simpan Pengajuan
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $employee = Auth::user()->employee;

        abort_unless($employee, 403);

        $validated = $request->validate([
            'permission_type' => [
                'required',
                'string',
                'max:50',
            ],

            'start_date' => [
                'required',
                'date',
            ],

            'end_date' => [
                'required',
                'date',
                'after_or_equal:start_date',
            ],

            'reason' => [
                'required',
                'string',
                'max:1000',
            ],

            'attachment' => [
                'nullable',
                'file',
                'mimes:jpg,jpeg,png,pdf',
                'max:2048',
            ],
        ]);

        $attachmentPath = null;

        if ($request->hasFile('attachment')) {
            $attachmentPath = $request
                ->file('attachment')
                ->store('permission-attachments', 'public');
        }

        PermissionRequest::create([
            'employee_id' => $employee->id,

            'permission_type' =>
                $validated['permission_type'],

            'start_date' =>
                $validated['start_date'],

            'end_date' =>
                $validated['end_date'],

            'reason' =>
                $validated['reason'],

            'attachment' =>
                $attachmentPath,

            'status' => 'Pending',
        ]);

        return redirect()
            ->route('employee.permission-requests.index')
            ->with(
                'success',
                'Pengajuan izin berhasil dikirim.'
            );
    }
}