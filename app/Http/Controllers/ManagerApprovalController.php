<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use App\Models\PermissionRequest;
use App\Models\OvertimeRequest;
use Illuminate\Http\Request;

class ManagerApprovalController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Dashboard Approval Manager
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $leaveRequests = LeaveRequest::with('employee')
            ->where('status', 'Pending')
            ->latest()
            ->get();

        $permissionRequests = PermissionRequest::with('employee')
            ->where('status', 'Pending')
            ->latest()
            ->get();

        $overtimeRequests = OvertimeRequest::with('employee')
            ->where('status', 'Pending')
            ->latest()
            ->get();

        return view(
            'manager.approvals.index',
            compact(
                'leaveRequests',
                'permissionRequests',
                'overtimeRequests'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Approval Cuti
    |--------------------------------------------------------------------------
    */

    public function approveLeave(
        Request $request,
        LeaveRequest $leaveRequest
    ) {
        $validated = $request->validate([
            'action' => [
                'required',
                'in:Approved,Rejected',
            ],

            'manager_note' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        $leaveRequest->update([
            'status' => $validated['action'],
            'manager_note' => $validated['manager_note'] ?? null,
            'approved_at' => now(),
        ]);

        return back()->with(
            'success',
            'Pengajuan cuti berhasil diproses.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Approval Izin
    |--------------------------------------------------------------------------
    */

    public function approvePermission(
        Request $request,
        PermissionRequest $permissionRequest
    ) {
        $validated = $request->validate([
            'action' => [
                'required',
                'in:Approved,Rejected',
            ],

            'manager_note' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        $permissionRequest->update([
            'status' => $validated['action'],
            'manager_note' => $validated['manager_note'] ?? null,
            'approved_at' => now(),
        ]);

        return back()->with(
            'success',
            'Pengajuan izin berhasil diproses.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Approval Lembur
    |--------------------------------------------------------------------------
    */

    public function approveOvertime(
        Request $request,
        OvertimeRequest $overtimeRequest
    ) {
        $validated = $request->validate([
            'action' => [
                'required',
                'in:Approved,Rejected',
            ],

            'manager_note' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        $overtimeRequest->update([
            'status' => $validated['action'],
            'manager_note' => $validated['manager_note'] ?? null,
            'approved_at' => now(),
        ]);

        return back()->with(
            'success',
            'Pengajuan lembur berhasil diproses.'
        );
    }
}