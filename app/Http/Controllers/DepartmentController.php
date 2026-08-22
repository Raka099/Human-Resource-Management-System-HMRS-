<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DepartmentController extends Controller
{
    public function index(): View
    {
        $departments = Department::latest()->get();

        return view('departements.index', compact('departments'));
    }

    public function create(): View
    {
        return view('departements.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'department_name' => [
                'required',
                'string',
                'max:100',
                'unique:departments,department_name',
            ],
        ]);

        Department::create($validated);

        return redirect()
            ->route('departements.index')
            ->with('success', 'Department berhasil ditambahkan.');
    }

    public function edit(Department $department): View
    {
        return view('departements.edit', compact('department'));
    }

    public function update(
        Request $request,
        Department $department
    ): RedirectResponse {

        $validated = $request->validate([
            'department_name' => [
                'required',
                'string',
                'max:100',
                'unique:departments,department_name,' . $department->id,
            ],
        ]);

        $department->update($validated);

        return redirect()
            ->route('departments.index')
            ->with('success', 'Department berhasil diperbarui.');
    }

    public function destroy(
        Department $department
    ): RedirectResponse {

        $department->delete();

        return redirect()
            ->route('departments.index')
            ->with('success', 'Department berhasil dihapus.');
    }
}