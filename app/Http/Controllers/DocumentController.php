<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Employee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class DocumentController extends Controller
{
    public function index(Employee $employee): View
    {
        $employee->load('documents');

        return view(
            'hr.documents.index',
            compact('employee')
        );
    }

    public function create(Employee $employee): View
    {
        return view(
            'documents.create',
            compact('employee')
        );
    }

    public function store(
        Request $request,
        Employee $employee
    ): RedirectResponse {

        $validated = $request->validate([
            'document_name' => [
                'required',
                'string',
                'max:150',
            ],

            'document_type' => [
                'required',
                'in:KTP,KK,Ijazah,Sertifikat,Lainnya',
            ],

            'file' => [
                'required',
                'file',
                'mimes:pdf,jpg,jpeg,png,doc,docx',
                'max:5120',
            ],
        ]);

        $file = $request->file('file');

        $path = $file->store(
            'employees/' . $employee->id . '/documents',
            'public'
        );

        Document::create([
            'employee_id' => $employee->id,
            'document_name' => $validated['document_name'],
            'document_type' => $validated['document_type'],
            'file_path' => $path,
            'file_extension' => $file->getClientOriginalExtension(),
            'file_size' => $file->getSize(),
        ]);

        return redirect()
            ->route('employees.documents.index', $employee)
            ->with(
                'success',
                'Dokumen berhasil diupload.'
            );
    }

    public function edit(
        Employee $employee,
        Document $document
    ): View {

        abort_unless(
            $document->employee_id === $employee->id,
            404
        );

        return view(
            'documents.edit',
            compact(
                'employee',
                'document'
            )
        );
    }

    public function update(
        Request $request,
        Employee $employee,
        Document $document
    ): RedirectResponse {

        abort_unless(
            $document->employee_id === $employee->id,
            404
        );

        $validated = $request->validate([
            'document_name' => [
                'required',
                'string',
                'max:150',
            ],

            'document_type' => [
                'required',
                'in:KTP,KK,Ijazah,Sertifikat,Lainnya',
            ],

            'file' => [
                'nullable',
                'file',
                'mimes:pdf,jpg,jpeg,png,doc,docx',
                'max:5120',
            ],
        ]);

        if ($request->hasFile('file')) {

            Storage::disk('public')
                ->delete($document->file_path);

            $file = $request->file('file');

            $document->file_path = $file->store(
                'employees/' .
                $employee->id .
                '/documents',
                'public'
            );

            $document->file_extension =
                $file->getClientOriginalExtension();

            $document->file_size =
                $file->getSize();
        }

        $document->document_name =
            $validated['document_name'];

        $document->document_type =
            $validated['document_type'];

        $document->save();

        return redirect()
            ->route('employees.documents.index', $employee)
            ->with(
                'success',
                'Dokumen berhasil diperbarui.'
            );
    }

    public function destroy(
        Employee $employee,
        Document $document
    ): RedirectResponse {

        abort_unless(
            $document->employee_id === $employee->id,
            404
        );

        Storage::disk('public')
            ->delete($document->file_path);

        $document->delete();

        return redirect()
            ->route('employees.documents.index', $employee)
            ->with(
                'success',
                'Dokumen berhasil dihapus.'
            );
    }
}