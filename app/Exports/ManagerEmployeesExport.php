<?php

namespace App\Exports;

use App\Models\Employee;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ManagerEmployeesExport implements FromCollection, WithHeadings
{
    protected $departmentId;

    public function __construct($departmentId)
    {
        $this->departmentId = $departmentId;
    }

    public function collection(): Collection
    {
        return Employee::with([
            'department',
            'position'
        ])
            ->where(
                'department_id',
                $this->departmentId
            )
            ->orderBy('full_name')
            ->get()
            ->map(function ($employee) {

                return [

                    'Nomor Karyawan' =>
                        $employee->employee_number,

                    'Nama Lengkap' =>
                        $employee->full_name,

                    'Email' =>
                        $employee->email,

                    'No. Telepon' =>
                        $employee->phone ?? '-',

                    'Department' =>
                        $employee->department->department_name
                        ?? '-',

                    'Position' =>
                        $employee->position->position_name
                        ?? '-',

                    'Tanggal Bergabung' =>
                        $employee->join_date
                            ? $employee->join_date->format('d-m-Y')
                            : '-',

                    'Status' =>
                        $employee->employment_status,

                ];

            });
    }

    public function headings(): array
    {
        return [

            'Nomor Karyawan',
            'Nama Lengkap',
            'Email',
            'No. Telepon',
            'Department',
            'Position',
            'Tanggal Bergabung',
            'Status',

        ];
    }
}