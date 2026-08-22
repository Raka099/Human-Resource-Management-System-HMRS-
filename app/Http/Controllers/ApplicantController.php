<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

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
