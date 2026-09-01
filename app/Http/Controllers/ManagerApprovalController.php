<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use App\Models\PermissionRequest;
use App\Models\OvertimeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerApprovalController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Dashboard Approval Manager
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $manager = Auth::user();

        $departmentId = $manager->employee->department_id;

        $leaveRequests = LeaveRequest::with('employee')
            ->where('manager_status', 'Pending')
            ->whereHas('employee', function ($query) use ($departmentId) {
                $query->where('department_id', $departmentId);
            })
            ->latest()
            ->get();

        $permissionRequests = PermissionRequest::with('employee')
            ->where('manager_status', 'Pending')
            ->whereHas('employee', function ($query) use ($departmentId) {
                $query->where('department_id', $departmentId);
            })
            ->latest()
            ->get();

        $overtimeRequests = OvertimeRequest::with('employee')
            ->where('manager_status', 'Pending')
            ->whereHas('employee', function ($query) use ($departmentId) {
                $query->where('department_id', $departmentId);
            })
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


        /*
        |--------------------------------------------------------------------------
        | Jika Manager Approve
        |--------------------------------------------------------------------------
        */

        if ($validated['status'] === 'Approved') {

            $leaveRequest->update([
                'manager_status' => 'Approved',

                'manager_note' =>
                $validated['note'] ?? null,

                'manager_approved_at' =>
                now(),
            ]);


            return back()->with(
                'success',
                'Pengajuan cuti berhasil disetujui Manager dan diteruskan ke HR.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Jika Manager Reject
        |--------------------------------------------------------------------------
        */

        $leaveRequest->update([
            'manager_status' => 'Rejected',

            'manager_note' =>
            $validated['note'] ?? null,

            'manager_approved_at' =>
            now(),

            'status' => 'Rejected',
        ]);


        return back()->with(
            'success',
            'Pengajuan cuti ditolak Manager.'
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


        /*
        |--------------------------------------------------------------------------
        | Jika Manager Approve
        |--------------------------------------------------------------------------
        */

        if ($validated['status'] === 'Approved') {

            $permissionRequest->update([
                'manager_status' => 'Approved',

                'manager_note' =>
                $validated['note'] ?? null,

                'manager_approved_at' =>
                now(),
            ]);


            return back()->with(
                'success',
                'Pengajuan izin berhasil disetujui Manager dan diteruskan ke HR.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Jika Manager Reject
        |--------------------------------------------------------------------------
        */

        $permissionRequest->update([
            'manager_status' => 'Rejected',

            'manager_note' =>
            $validated['note'] ?? null,

            'manager_approved_at' =>
            now(),

            'status' => 'Rejected',
        ]);


        return back()->with(
            'success',
            'Pengajuan izin ditolak Manager.'
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


        /*
        |--------------------------------------------------------------------------
        | Jika Manager Approve
        |--------------------------------------------------------------------------
        */

        if ($validated['status'] === 'Approved') {

            $overtimeRequest->update([
                'manager_status' => 'Approved',

                'manager_note' =>
                $validated['note'] ?? null,

                'manager_approved_at' =>
                now(),
            ]);


            return back()->with(
                'success',
                'Pengajuan lembur berhasil disetujui Manager dan diteruskan ke HR.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Jika Manager Reject
        |--------------------------------------------------------------------------
        */

        $overtimeRequest->update([
            'manager_status' => 'Rejected',

            'manager_note' =>
            $validated['note'] ?? null,

            'manager_approved_at' =>
            now(),

            'status' => 'Rejected',
        ]);


        return back()->with(
            'success',
            'Pengajuan lembur ditolak Manager.'
        );
    }
}
