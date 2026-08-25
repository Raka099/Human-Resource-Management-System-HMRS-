<?php

namespace App\Http\Controllers;

use App\Models\OvertimeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OvertimeRequestController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Daftar Pengajuan Lembur
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $employee = Auth::user()->employee;

        abort_unless($employee, 403);

        $overtimeRequests = OvertimeRequest::where(
            'employee_id',
            $employee->id
        )
            ->latest()
            ->get();

        return view(
            'employee.overtime_requests.index',
            compact('overtimeRequests')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Form Pengajuan Lembur
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $employee = Auth::user()->employee;

        abort_unless($employee, 403);

        return view(
            'employee.overtime_requests.create'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Simpan Pengajuan Lembur
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $employee = Auth::user()->employee;

        abort_unless($employee, 403);

        $validated = $request->validate([
            'overtime_date' => [
                'required',
                'date',
            ],

            'start_time' => [
                'required',
                'date_format:H:i',
            ],

            'end_time' => [
                'required',
                'date_format:H:i',
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

        /*
        |--------------------------------------------------------------------------
        | Validasi Jam
        |--------------------------------------------------------------------------
        */

        if ($validated['end_time'] <= $validated['start_time']) {
            return back()
                ->withErrors([
                    'end_time' =>
                        'Jam selesai harus lebih besar dari jam mulai.'
                ])
                ->withInput();
        }


        /*
        |--------------------------------------------------------------------------
        | Upload Lampiran
        |--------------------------------------------------------------------------
        */

        $attachmentPath = null;

        if ($request->hasFile('attachment')) {

            $attachmentPath = $request
                ->file('attachment')
                ->store(
                    'overtime-attachments',
                    'public'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Simpan Pengajuan
        |--------------------------------------------------------------------------
        */

        OvertimeRequest::create([
            'employee_id' =>
                $employee->id,

            'overtime_date' =>
                $validated['overtime_date'],

            'start_time' =>
                $validated['start_time'],

            'end_time' =>
                $validated['end_time'],

            'reason' =>
                $validated['reason'],

            'attachment' =>
                $attachmentPath,

            'status' =>
                'Pending',
        ]);


        return redirect()
            ->route(
                'employee.overtime-requests.index'
            )
            ->with(
                'success',
                'Pengajuan lembur berhasil dikirim.'
            );
    }
}