@extends('layouts.app')

@section('title', 'Data Karyawan Department')

@section('content')

<div class="container">

    <div class="card">

        <h1 style="color:#8B1E1E;">
            Data Karyawan
        </h1>

        <p>
            Menampilkan data karyawan berdasarkan department Manager.
        </p>

        <a
            href="{{ route('manager.employees.export') }}"
            class="btn-primary"
            style="
                display:inline-block;
                margin-bottom:20px;
                text-decoration:none;
            "
        >
            Generate Excel
        </a>

        @if(session('success'))

            <div style="
                background:#F4D66D;
                color:#8B1E1E;
                padding:12px;
                margin:20px 0;
                border-radius:8px;
            ">
                {{ session('success') }}
            </div>

        @endif


        <div style="
            margin-top:25px;
            overflow-x:auto;
        ">

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
                            Nomor Karyawan
                        </th>

                        <th style="padding:12px;">
                            Nama
                        </th>

                        <th style="padding:12px;">
                            Email
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

                    </tr>

                </thead>


                <tbody>

                    @forelse($employees as $employee)

                        <tr style="
                            border-bottom:1px solid #ddd;
                        ">

                            <td style="padding:12px;">
                                {{ $employees->firstItem() + $loop->index }}
                            </td>

                            <td style="padding:12px;">
                                {{ $employee->employee_number }}
                            </td>

                            <td style="padding:12px;">
                                <strong>
                                    {{ $employee->full_name }}
                                </strong>
                            </td>

                            <td style="padding:12px;">
                                {{ $employee->email }}
                            </td>

                            <td style="padding:12px;">
                                {{ $employee->department?->department_name ?? '-' }}
                            </td>

                            <td style="padding:12px;">
                                {{ $employee->position?->position_name ?? '-' }}
                            </td>

                            <td style="padding:12px;">

                                @if($employee->employment_status === 'Active')

                                    <span style="
                                        background:#A8662A;
                                        color:white;
                                        padding:6px 10px;
                                        border-radius:20px;
                                    ">
                                        Active
                                    </span>

                                @else

                                    <span style="
                                        background:#D5322F;
                                        color:white;
                                        padding:6px 10px;
                                        border-radius:20px;
                                    ">
                                        Inactive
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="7"
                                style="
                                    padding:30px;
                                    text-align:center;
                                    color:#777;
                                "
                            >
                                Tidak ada data karyawan.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}

        <div style="margin-top:20px;">

            {{ $employees->links() }}

        </div>

    </div>

</div>

@endsection