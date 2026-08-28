<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use App\Models\PermissionRequest;
use App\Models\OvertimeRequest;
use Illuminate\Http\Request;

class HRApprovalController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Dashboard Approval HR
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | CUTI
        |--------------------------------------------------------------------------
        | HR hanya melihat pengajuan yang sudah disetujui Manager
        | dan belum diproses HR.
        */

        $leaveRequests = LeaveRequest::with('employee')
            ->where('manager_status', 'Approved')
            ->where('hr_status', 'Pending')
            ->latest()
            ->get();


        /*
        |--------------------------------------------------------------------------
        | IZIN
        |--------------------------------------------------------------------------
        */

        $permissionRequests = PermissionRequest::with('employee')
            ->where('manager_status', 'Approved')
            ->where('hr_status', 'Pending')
            ->latest()
            ->get();


        /*
        |--------------------------------------------------------------------------
        | LEMBUR
        |--------------------------------------------------------------------------
        */

        $overtimeRequests = OvertimeRequest::with('employee')
            ->where('manager_status', 'Approved')
            ->where('hr_status', 'Pending')
            ->latest()
            ->get();


        return view(
            'hr.approvals.index',
            compact(
                'leaveRequests',
                'permissionRequests',
                'overtimeRequests'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Approval Cuti HR
    |--------------------------------------------------------------------------
    */

    public function approveLeave(
        Request $request,
        LeaveRequest $leaveRequest
    ) {
        $validated = $request->validate([
            'status' => [
                'required',
                'in:Approved,Rejected',
            ],

            'note' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);


        if ($validated['status'] === 'Approved') {

            $leaveRequest->update([
                'hr_status' => 'Approved',
                'hr_note' => $validated['note'] ?? null,
                'hr_approved_at' => now(),
                'status' => 'Approved',
            ]);

            return back()->with(
                'success',
                'Pengajuan cuti berhasil disetujui HR.'
            );
        }


        $leaveRequest->update([
            'hr_status' => 'Rejected',
            'hr_note' => $validated['note'] ?? null,
            'hr_approved_at' => now(),
            'status' => 'Rejected',
        ]);


        return back()->with(
            'success',
            'Pengajuan cuti ditolak HR.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Approval Izin HR
    |--------------------------------------------------------------------------
    */

    public function approvePermission(
        Request $request,
        PermissionRequest $permissionRequest
    ) {
        $validated = $request->validate([
            'status' => [
                'required',
                'in:Approved,Rejected',
            ],

            'note' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);


        if ($validated['status'] === 'Approved') {

            $permissionRequest->update([
                'hr_status' => 'Approved',
                'hr_note' => $validated['note'] ?? null,
                'hr_approved_at' => now(),
                'status' => 'Approved',
            ]);

            return back()->with(
                'success',
                'Pengajuan izin berhasil disetujui HR.'
            );
        }


        $permissionRequest->update([
            'hr_status' => 'Rejected',
            'hr_note' => $validated['note'] ?? null,
            'hr_approved_at' => now(),
            'status' => 'Rejected',
        ]);


        return back()->with(
            'success',
            'Pengajuan izin ditolak HR.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Approval Lembur HR
    |--------------------------------------------------------------------------
    */

    public function approveOvertime(
        Request $request,
        OvertimeRequest $overtimeRequest
    ) {
        $validated = $request->validate([
            'status' => [
                'required',
                'in:Approved,Rejected',
            ],

            'note' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);


        if ($validated['status'] === 'Approved') {

            $overtimeRequest->update([
                'hr_status' => 'Approved',
                'hr_note' => $validated['note'] ?? null,
                'hr_approved_at' => now(),
                'status' => 'Approved',
            ]);

            return back()->with(
                'success',
                'Pengajuan lembur berhasil disetujui HR.'
            );
        }


        $overtimeRequest->update([
            'hr_status' => 'Rejected',
            'hr_note' => $validated['note'] ?? null,
            'hr_approved_at' => now(),
            'status' => 'Rejected',
        ]);


        return back()->with(
            'success',
            'Pengajuan lembur ditolak HR.'
        );
    }
}