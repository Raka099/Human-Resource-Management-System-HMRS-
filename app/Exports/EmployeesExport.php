<?php

namespace App\Exports;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EmployeesExport implements FromCollection, WithHeadings, WithMapping
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Mengambil data karyawan
     */
    public function collection(): EloquentCollection
    {
        return Employee::with([
            'department',
            'position',
        ])

        // ==========================
        // SEARCH
        // ==========================
        ->when(
            $this->request->search,
            function ($query, $search) {

                $query->where(function ($q) use ($search) {

                    $q->where(
                        'full_name',
                        'like',
                        "%{$search}%"
                    )

                    ->orWhere(
                        'employee_number',
                        'like',
                        "%{$search}%"
                    )

                    ->orWhere(
                        'email',
                        'like',
                        "%{$search}%"
                    );
                });
            }
        )

        // ==========================
        // DEPARTMENT
        // ==========================
        ->when(
            $this->request->department_id,
            function ($query, $id) {

                $query->where(
                    'department_id',
                    $id
                );
            }
        )

        // ==========================
        // POSITION
        // ==========================
        ->when(
            $this->request->position_id,
            function ($query, $id) {

                $query->where(
                    'position_id',
                    $id
                );
            }
        )

        // ==========================
        // STATUS
        // ==========================
        ->when(
            $this->request->employment_status,
            function ($query, $status) {

                $query->where(
                    'employment_status',
                    $status
                );
            }
        )

        ->latest()
        ->get();
    }

    /**
     * Header Excel
     */
    public function headings(): array
    {
        return [
            'No',
            'Nomor Karyawan',
            'Nama Lengkap',
            'Email',
            'Telepon',
            'Alamat',
            'Department',
            'Position',
            'Tanggal Lahir',
            'Tanggal Bergabung',
            'Status Kepegawaian',
        ];
    }

    /**
     * Mapping data ke Excel
     */
    public function map($employee): array
    {
        static $no = 0;

        $no++;

        return [
            $no,

            $employee->employee_number,

            $employee->full_name,

            $employee->email,

            $employee->phone ?? '-',

            $employee->address ?? '-',

            $employee->department?->department_name ?? '-',

            $employee->position?->position_name ?? '-',

            $employee->birth_date
                ? $employee->birth_date->format('d-m-Y')
                : '-',

            $employee->join_date
                ? $employee->join_date->format('d-m-Y')
                : '-',

            $employee->employment_status,
        ];
    }
}