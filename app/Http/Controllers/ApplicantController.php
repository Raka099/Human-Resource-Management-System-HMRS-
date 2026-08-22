<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;

class ApplicantController extends Controller
{
    public function index(): View
    {
        $applicants = Applicant::latest()->get();

        return view(
            'applicants.index',
            compact('applicants')
        );
    }

    public function create(): View
    {
        return view('applicants.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'application_number' => [
                'required',
                'string',
                'max:30',
                'unique:applicants,application_number',
            ],

            'full_name' => [
                'required',
                'string',
                'max:150',
            ],

            'email' => [
                'required',
                'email',
                'max:150',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:20',
            ],

            'address' => [
                'nullable',
                'string',
            ],

            'cv_file' => [
                'required',
                'file',
                'mimes:pdf,doc,docx',
                'max:5120',
            ],
        ]);

        $validated['cv_file'] = $request
            ->file('cv_file')
            ->store('applicants/cv', 'public');

        $validated['status'] = 'Proses';

        Applicant::create($validated);

        return redirect()
            ->route('applicants.index')
            ->with(
                'success',
                'Data pelamar berhasil ditambahkan.'
            );
    }

    public function edit(Applicant $applicant): View
    {
        return view(
            'applicants.edit',
            compact('applicant')
        );
    }

    public function update(
        Request $request,
        Applicant $applicant
    ): RedirectResponse {

        $validated = $request->validate([
            'application_number' => [
                'required',
                'string',
                'max:30',
                'unique:applicants,application_number,' . $applicant->id,
            ],

            'full_name' => [
                'required',
                'string',
                'max:150',
            ],

            'email' => [
                'required',
                'email',
                'max:150',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:20',
            ],

            'address' => [
                'nullable',
                'string',
            ],

            'cv_file' => [
                'nullable',
                'file',
                'mimes:pdf,doc,docx',
                'max:5120',
            ],
        ]);

        if ($request->hasFile('cv_file')) {

            if ($applicant->cv_file) {
                Storage::disk('public')
                    ->delete($applicant->cv_file);
            }

            $validated['cv_file'] = $request
                ->file('cv_file')
                ->store('applicants/cv', 'public');
        }

        $applicant->update($validated);

        return redirect()
            ->route('applicants.index')
            ->with(
                'success',
                'Data pelamar berhasil diperbarui.'
            );
    }

    public function updateStatus(
        Request $request,
        Applicant $applicant
    ): RedirectResponse {

        $validated = $request->validate([
            'status' => [
                'required',
                'in:Proses,Diterima,Tidak Diterima',
            ],
        ]);

        $applicant->update([
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('applicants.index')
            ->with(
                'success',
                'Status pelamar berhasil diperbarui.'
            );
    }
    public function generateEmployee(Applicant $applicant): View
    {
        if ($applicant->status !== 'Diterima') {
            abort(403, 'Pelamar belum berstatus Diterima.');
        }

        $departments = Department::orderBy('department_name')->get();
        $positions = Position::orderBy('position_name')->get();

        return view(
            'applicants.generate-employee',
            compact(
                'applicant',
                'departments',
                'positions'
            )
        );
    }

    public function storeGeneratedEmployee(
        Request $request,
        Applicant $applicant
    ): RedirectResponse {

        if ($applicant->status !== 'Diterima') {
            abort(403, 'Pelamar belum berstatus Diterima.');
        }

        $validated = $request->validate([
            'employee_number' => [
                'required',
                'string',
                'max:30',
                'unique:employees,employee_number',
            ],

            'join_date' => [
                'required',
                'date',
            ],

            'department_id' => [
                'required',
                'exists:departments,id',
            ],

            'position_id' => [
                'required',
                'exists:positions,id',
            ],

            'employment_status' => [
                'required',
                'in:Active,Inactive',
            ],
        ]);

        Employee::create([
            'employee_number' => $validated['employee_number'],
            'full_name' => $applicant->full_name,
            'email' => $applicant->email,
            'phone' => $applicant->phone,
            'address' => $applicant->address,
            'join_date' => $validated['join_date'],
            'department_id' => $validated['department_id'],
            'position_id' => $validated['position_id'],
            'employment_status' => $validated['employment_status'],
        ]);

        return redirect()
            ->route('employees.index')
            ->with(
                'success',
                'Pelamar berhasil digenerate menjadi karyawan.'
            );
    }

    public function destroy(
        Applicant $applicant
    ): RedirectResponse {

        if ($applicant->cv_file) {
            Storage::disk('public')
                ->delete($applicant->cv_file);
        }

        $applicant->delete();

        return redirect()
            ->route('applicants.index')
            ->with(
                'success',
                'Data pelamar berhasil dihapus.'
            );
    }
}
