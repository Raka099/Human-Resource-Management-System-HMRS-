@extends('layouts.app')

@section('title', 'Laporan Data Karyawan')

@section('content')

<div class="container">

    {{-- HEADER --}}

    <div class="card ">

        <h1 style="
            color:#8B1E1E;
            margin-top:0;
        ">
            Laporan Data Karyawan
        </h1>

        <p>
            Laporan data karyawan perusahaan.
        </p>

    </div>


    {{-- FILTER --}}

    <div
        class="card"
        style="margin-top:20px;"
    >

        <h2 style="
            color:#8B1E1E;
            margin-top:0;
        ">
            Filter Laporan
        </h2>


        <form
            action="{{ route('reports.employees.index') }}"
            method="GET"
        >

            <div
                style="
                    display:grid;
                    grid-template-columns:
                        repeat(3, 1fr);
                    gap:15px;
                "
            >

                {{-- SEARCH --}}

                <div>

                    <label>
                        Cari Karyawan
                    </label>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Nama / Nomor Karyawan / Email"
                        style="
                            width:100%;
                            padding:10px;
                            margin-top:6px;
                        "
                    >

                </div>


                {{-- DEPARTMENT --}}

                <div>

                    <label>
                        Department
                    </label>

                    <select
                        name="department_id"
                        style="
                            width:100%;
                            padding:10px;
                            margin-top:6px;
                        "
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

                </div>


                {{-- STATUS --}}

                <div>

                    <label>
                        Status Kepegawaian
                    </label>

                    <select
                        name="employment_status"
                        style="
                            width:100%;
                            padding:10px;
                            margin-top:6px;
                        "
                    >

                        <option value="">
                            Semua Status
                        </option>

                        <option
                            value="Active"
                            @selected(
                                request('employment_status')
                                === 'Active'
                            )
                        >
                            Active
                        </option>

                        <option
                            value="Inactive"
                            @selected(
                                request('employment_status')
                                === 'Inactive'
                            )
                        >
                            Inactive
                        </option>

                    </select>

                </div>

            </div>


            {{-- BUTTON --}}

            <div
                style="
                    display:flex;
                    gap:10px;
                    margin-top:20px;
                "
            >

                <button
                    type="submit"
                    class="btn-primary"
                >
                    Terapkan Filter
                </button>


                <a
                    href="{{ route('reports.employees.index') }}"
                    class="btn-primary"
                    style="
                        background:#A8662A;
                    "
                >
                    Reset
                </a>

            </div>

        </form>

    </div>


    {{-- TABLE --}}

    <div
        class="card"
        style="
            margin-top:20px;
            overflow-x:auto;
        "
    >

        <div
            style="
                display:flex;
                justify-content:space-between;
                align-items:center;
                margin-bottom:15px;
                gap:15px;
            "
        >

            {{-- JUDUL --}}

            <div>

                <h2 style="
                    color:#8B1E1E;
                    margin:0;
                ">
                    Data Karyawan
                </h2>

                <p style="
                    margin:5px 0 0;
                    color:#777;
                ">
                    Total data:
                    <strong>
                        {{ $employees->total() }}
                    </strong>
                    karyawan
                </p>

            </div>
        </div>


            {{-- TOMBOL GENERATE LAPORAN --}}

            <div
                style="
                    display:flex;
                    gap:10px;
                    flex-wrap:wrap;
                "
            >

                <a
                    href="{{ route('reports.employees.excel', request()->query()) }}"
                    class="btn-primary"
                >
                    📊 Generate Excel
                </a>
            </div>

        </div>


        <table
            style="
                width:100%;
                border-collapse:collapse;
            "
        >

            <thead>

                <tr
                    style="
                        background:#8B1E1E;
                        color:white;
                    "
                >

                    <th style="padding:12px;">
                        No
                    </th>

                    <th style="padding:12px;">
                        Nomor Karyawan
                    </th>

                    <th style="padding:12px;">
                        Nama Lengkap
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
                        Join Date
                    </th>

                    <th style="padding:12px;">
                        Status
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($employees as $employee)

                    <tr
                        style="
                            border-bottom:
                            1px solid #ddd;
                        "
                    >

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

                            @if($employee->join_date)

                                {{ $employee->join_date->format('d-m-Y') }}

                            @else

                                -

                            @endif

                        </td>

                        <td style="padding:12px;">

                            @if($employee->employment_status === 'Active')

                                <span
                                    style="
                                        background:#A8662A;
                                        color:white;
                                        padding:6px 10px;
                                        border-radius:20px;
                                    "
                                >
                                    Active
                                </span>

                            @else

                                <span
                                    style="
                                        background:#D5322F;
                                        color:white;
                                        padding:6px 10px;
                                        border-radius:20px;
                                    "
                                >
                                    Inactive
                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="8"
                            style="
                                padding:30px;
                                text-align:center;
                                color:#777;
                            "
                        >

                            Data karyawan tidak ditemukan.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>


        {{-- PAGINATION --}}

        <div
            style="
                margin-top:20px;
            "
        >

            {{ $employees->links() }}

        </div>

    </div>

</div>

@endsection