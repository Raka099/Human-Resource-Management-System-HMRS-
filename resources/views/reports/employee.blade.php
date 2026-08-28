@extends('layouts.app')

@section('title', 'Laporan Karyawan')

@section('content')

<div class="container">

    <div class="card">

        <h1 style="color:#8B1E1E;">
            Laporan Data Karyawan
        </h1>

        <form method="GET"
              action="{{ route('reports.employees') }}">

            <div style="
                display:grid;
                grid-template-columns:repeat(4,1fr);
                gap:15px;
                margin-top:20px;
            ">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari karyawan..."
                    style="padding:12px;"
                >

                <select
                    name="department_id"
                    style="padding:12px;"
                >
                    <option value="">
                        Semua Department
                    </option>

                    @foreach($departments as $department)

                        <option
                            value="{{ $department->id }}"
                            @selected(
                                request('department_id')
                                == $department->id
                            )
                        >
                            {{ $department->department_name }}
                        </option>

                    @endforeach
                </select>

                <select
                    name="position_id"
                    style="padding:12px;"
                >
                    <option value="">
                        Semua Position
                    </option>

                    @foreach($positions as $position)

                        <option
                            value="{{ $position->id }}"
                            @selected(
                                request('position_id')
                                == $position->id
                            )
                        >
                            {{ $position->position_name }}
                        </option>

                    @endforeach
                </select>

                <select
                    name="employment_status"
                    style="padding:12px;"
                >
                    <option value="">
                        Semua Status
                    </option>

                    <option
                        value="Active"
                        @selected(
                            request('employment_status') === 'Active'
                        )
                    >
                        Active
                    </option>

                    <option
                        value="Inactive"
                        @selected(
                            request('employment_status') === 'Inactive'
                        )
                    >
                        Inactive
                    </option>

                </select>

            </div>

            <button
                type="submit"
                class="btn-primary"
                style="margin-top:15px;"
            >
                Filter
            </button>

            <a
                href="{{ route('reports.employees') }}"
                class="btn-primary"
                style="margin-top:15px;"
            >
                Reset
            </a>

        </form>

    </div>


    <div class="card">

        <div style="
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
                            Department
                        </th>

                        <th style="padding:12px;">
                            Position
                        </th>

                        <th style="padding:12px;">
                            Email
                        </th>

                        <th style="padding:12px;">
                            Join Date
                        </th>

                        <th style="padding:12px;">
                            Status
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($employees as $employee)

                        <tr>

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
                                {{ $employee->department?->department_name }}
                            </td>

                            <td style="padding:12px;">
                                {{ $employee->position?->position_name }}
                            </td>

                            <td style="padding:12px;">
                                {{ $employee->email }}
                            </td>

                            <td style="padding:12px;">
                                {{ $employee->join_date?->format('d-m-Y') }}
                            </td>

                            <td style="padding:12px;">

                                <span style="
                                    padding:6px 10px;
                                    border-radius:6px;
                                    background:
                                    {{ $employee->employment_status === 'Active'
                                        ? '#F4D66D'
                                        : '#D5322F' }};
                                ">

                                    {{ $employee->employment_status }}

                                </span>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="8"
                                style="
                                    padding:20px;
                                    text-align:center;
                                "
                            >
                                Data karyawan tidak ditemukan.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div style="margin-top:20px;">
            {{ $employees->links() }}
        </div>

    </div>

</div>

@endsection