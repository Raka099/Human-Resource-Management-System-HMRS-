<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LeaveRequestController extends Controller
{
    public function index(): View
    {
        $employee = Auth::user()->employee;

        abort_unless($employee, 403);

        $leaveRequests = LeaveRequest::where(
            'employee_id',
            $employee->id
        )
            ->latest()
            ->get();

        return view(
            'employee.leave_requests.index',
            compact(
                'employee',
                'leaveRequests'
            )
        );
    }

    public function create(): View
    {
        $employee = Auth::user()->employee;

        abort_unless($employee, 403);

        return view(
            'employee.leave_requests.create',
            compact('employee')
        );
    }

    public function store(
        Request $request
    ): RedirectResponse {

        $employee = Auth::user()->employee;

        abort_unless($employee, 403);

        $validated = $request->validate([
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
        ]);

        LeaveRequest::create([
            'employee_id' => $employee->id,
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'reason' => $validated['reason'],
            'status' => 'Pending',
        ]);

        return redirect()
            ->route('leave-requests.index')
            ->with(
                'success',
                'Pengajuan cuti berhasil dikirim.'
            );
    }
}