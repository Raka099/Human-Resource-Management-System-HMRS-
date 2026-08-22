@extends('layouts.app')

@section('title', 'Data Karyawan')

@section('content')

<div class="container">

    <div class="card">

        <div style="
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:20px;
        ">

            <div>
                <h1 style="color:#8B1E1E;">
                    Data Karyawan
                </h1>

                <p style="margin-top:5px;">
                    Kelola data karyawan perusahaan.
                </p>
            </div>

            <a
                href="{{ route('employees.create') }}"
                class="btn-primary"
            >
                + Tambah Karyawan
            </a>

        </div>

        @if(session('success'))

            <div style="
                background:#F4D66D;
                padding:12px;
                border-radius:8px;
                margin-bottom:20px;
            ">
                {{ session('success') }}
            </div>

        @endif

        <div style="overflow-x:auto;">

            <table style="
                width:100%;
                border-collapse:collapse;
            ">

                <thead>

                    <tr style="
                        background:#8B1E1E;
                        color:white;
                    ">

                        <th style="padding:12px;">
                            No
                        </th>

                        <th style="padding:12px;">
                            NIK
                        </th>

                        <th style="padding:12px;">
                            Nama
                        </th>

                        <th style="padding:12px;">
                            Department
                        </th>

                        <th style="padding:12px;">
                            Position
                        </th>

                        <th style="padding:12px;">
                            Status
                        </th>

                        <th style="padding:12px;">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($employees as $employee)

                        <tr style="
                            border-bottom:1px solid #ddd;
                        ">

                            <td style="padding:12px;">
                                {{ $loop->iteration }}
                            </td>

                            <td style="padding:12px;">
                                {{ $employee->employee_number }}
                            </td>

                            <td style="padding:12px;">
                                {{ $employee->full_name }}
                            </td>

                            <td style="padding:12px;">
                                {{ $employee->department->department_name }}
                            </td>

                            <td style="padding:12px;">
                                {{ $employee->position->position_name }}
                            </td>

                            <td style="padding:12px;">
                                {{ $employee->employment_status }}
                            </td>

                            <td style="padding:12px;">

                                <a
                                    href="{{ route(
                                        'employees.edit',
                                        $employee
                                    ) }}"
                                    class="btn-primary"
                                >
                                    Edit
                                </a>

                                <form
                                    action="{{ route(
                                        'employees.destroy',
                                        $employee
                                    ) }}"
                                    method="POST"
                                    style="display:inline;"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn-primary"
                                        onclick="
                                            return confirm(
                                                'Hapus data karyawan ini?'
                                            )
                                        "
                                    >
                                        Hapus
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="7"
                                style="
                                    padding:20px;
                                    text-align:center;
                                "
                            >
                                Belum ada data karyawan.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection