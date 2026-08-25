@extends('layouts.app')

@section('title', 'Laporan Pengajuan Cuti')

@section('content')

<div class="container">

    <div class="card">

        <h1 style="color:#8B1E1E;">
            Laporan Pengajuan Cuti
        </h1>

        <p>
            Laporan seluruh pengajuan cuti karyawan.
        </p>

    </div>


    {{-- FILTER --}}

    <div class="card" style="margin-top:20px;">

        <form
            method="GET"
            action="{{ route('reports.leave.index') }}"
        >

            <div
                style="
                    display:grid;
                    grid-template-columns:
                        repeat(3, 1fr);
                    gap:15px;
                "
            >

                <div>

                    <label>
                        Cari Karyawan
                    </label>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Nama / Nomor Karyawan"
                        style="
                            width:100%;
                            padding:10px;
                            margin-top:6px;
                        "
                    >

                </div>


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


                <div>

                    <label>
                        Status
                    </label>

                    <select
                        name="status"
                        style="
                            width:100%;
                            padding:10px;
                            margin-top:6px;
                        "
                    >

                        <option value="">
                            Semua Status
                        </option>

                        <option value="Pending">
                            Pending
                        </option>

                        <option value="Approved">
                            Approved
                        </option>

                        <option value="Rejected">
                            Rejected
                        </option>

                    </select>

                </div>

            </div>


            <div style="margin-top:20px;">

                <button
                    type="submit"
                    class="btn-primary"
                >
                    Filter
                </button>

                <a
                    href="{{ route('reports.leave.index') }}"
                    class="btn-primary"
                    style="background:#A8662A;"
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
                        Karyawan
                    </th>

                    <th style="padding:12px;">
                        Department
                    </th>

                    <th style="padding:12px;">
                        Tanggal Mulai
                    </th>

                    <th style="padding:12px;">
                        Tanggal Selesai
                    </th>

                    <th style="padding:12px;">
                        Alasan
                    </th>

                    <th style="padding:12px;">
                        Status
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($leaveRequests as $request)

                    <tr style="border-bottom:1px solid #ddd;">

                        <td style="padding:12px;">
                            {{ $leaveRequests->firstItem() + $loop->index }}
                        </td>

                        <td style="padding:12px;">
                            {{ $request->employee?->full_name ?? '-' }}
                        </td>

                        <td style="padding:12px;">
                            {{ $request->employee?->department?->department_name ?? '-' }}
                        </td>

                        <td style="padding:12px;">
                            {{ $request->start_date ?? '-' }}
                        </td>

                        <td style="padding:12px;">
                            {{ $request->end_date ?? '-' }}
                        </td>

                        <td style="padding:12px;">
                            {{ $request->reason ?? '-' }}
                        </td>

                        <td style="padding:12px;">

                            <span
                                style="
                                    padding:6px 10px;
                                    border-radius:20px;
                                    background:
                                    {{ $request->status === 'Approved'
                                        ? '#A8662A'
                                        : ($request->status === 'Rejected'
                                            ? '#D5322F'
                                            : '#F4D66D') }};
                                    color:
                                    {{ $request->status === 'Pending'
                                        ? '#000'
                                        : '#fff' }};
                                "
                            >
                                {{ $request->status }}
                            </span>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="7"
                            style="
                                text-align:center;
                                padding:30px;
                            "
                        >
                            Belum ada pengajuan cuti.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

        <div style="margin-top:20px;">
            {{ $leaveRequests->links() }}
        </div>

    </div>

</div>

@endsection