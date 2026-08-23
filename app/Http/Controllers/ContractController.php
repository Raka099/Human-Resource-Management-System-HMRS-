<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Employee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ContractController extends Controller
{
    public function index(Employee $employee): View
    {
        $employee->load('contracts');

        return view(
            'contracts.index',
            compact('employee')
        );
    }

    public function create(Employee $employee): View
    {
        return view(
            'contracts.create',
            compact('employee')
        );
    }

    public function store(
        Request $request,
        Employee $employee
    ): RedirectResponse {

        $validated = $request->validate([
            'contract_name' => [
                'required',
                'string',
                'max:150',
            ],

            'file' => [
                'required',
                'file',
                'mimes:pdf,doc,docx',
                'max:5120',
            ],
        ]);

        $file = $request->file('file');

        $path = $file->store(
            'employees/' .
            $employee->id .
            '/contracts',
            'public'
        );

        Contract::create([
            'employee_id' => $employee->id,
            'contract_name' => $validated['contract_name'],
            'file_path' => $path,
            'file_extension' =>
                $file->getClientOriginalExtension(),
            'file_size' => $file->getSize(),
        ]);

        return redirect()
            ->route('employees.contracts.index', $employee)
            ->with(
                'success',
                'File kontrak berhasil diupload.'
            );
    }

    public function edit(
        Employee $employee,
        Contract $contract
    ): View {

        abort_unless(
            $contract->employee_id === $employee->id,
            404
        );

        return view(
            'contracts.edit',
            compact(
                'employee',
                'contract'
            )
        );
    }

    public function update(
        Request $request,
        Employee $employee,
        Contract $contract
    ): RedirectResponse {

        abort_unless(
            $contract->employee_id === $employee->id,
            404
        );

        $validated = $request->validate([
            'contract_name' => [
                'required',
                'string',
                'max:150',
            ],

            'file' => [
                'nullable',
                'file',
                'mimes:pdf,doc,docx',
                'max:5120',
            ],
        ]);

        if ($request->hasFile('file')) {

            Storage::disk('public')
                ->delete($contract->file_path);

            $file = $request->file('file');

            $contract->file_path = $file->store(
                'employees/' .
                $employee->id .
                '/contracts',
                'public'
            );

            $contract->file_extension =
                $file->getClientOriginalExtension();

            $contract->file_size =
                $file->getSize();
        }

        $contract->contract_name =
            $validated['contract_name'];

        $contract->save();

        return redirect()
            ->route('employees.contracts.index', $employee)
            ->with(
                'success',
                'Kontrak berhasil diperbarui.'
            );
    }

    public function destroy(
        Employee $employee,
        Contract $contract
    ): RedirectResponse {

        abort_unless(
            $contract->employee_id === $employee->id,
            404
        );

        Storage::disk('public')
            ->delete($contract->file_path);

        $contract->delete();

        return redirect()
            ->route('employees.contracts.index', $employee)
            ->with(
                'success',
                'Kontrak berhasil dihapus.'
            );
    }
}