@extends('layouts.app')

@section('title', 'Laporan Pengajuan')

@section('content')

<div class="container">

    <div class="card">

        <h1 style="color:#8B1E1E;">
            Laporan Pengajuan
        </h1>

        <p>
            Rekap seluruh pengajuan cuti, izin,
            dan lembur karyawan.
        </p>

    </div>


    {{-- CUTI --}}

    <div class="card">

        <h2 style="color:#8B1E1E;">
            Pengajuan Cuti
        </h2>

        <table style="
            width:100%;
            border-collapse:collapse;
            margin-top:15px;
        ">

            <thead>

                <tr style="
                    background:#8B1E1E;
                    color:white;
                ">

                    <th style="padding:10px;">
                        Karyawan
                    </th>

                    <th style="padding:10px;">
                        Tanggal
                    </th>

                    <th style="padding:10px;">
                        Status
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($leaveRequests as $request)

                    <tr>

                        <td style="padding:10px;">
                            {{ $request->employee?->full_name }}
                        </td>

                        <td style="padding:10px;">
                            {{ $request->created_at->format('d-m-Y') }}
                        </td>

                        <td style="padding:10px;">
                            {{ $request->status }}
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td
                            colspan="3"
                            style="
                                text-align:center;
                                padding:15px;
                            "
                        >
                            Belum ada pengajuan cuti.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- IZIN --}}

    <div class="card">

        <h2 style="color:#8B1E1E;">
            Pengajuan Izin
        </h2>

        <table style="
            width:100%;
            border-collapse:collapse;
            margin-top:15px;
        ">

            <thead>

                <tr style="
                    background:#D5322F;
                    color:white;
                ">

                    <th style="padding:10px;">
                        Karyawan
                    </th>

                    <th style="padding:10px;">
                        Tanggal
                    </th>

                    <th style="padding:10px;">
                        Status
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($permissionRequests as $request)

                    <tr>

                        <td style="padding:10px;">
                            {{ $request->employee?->full_name }}
                        </td>

                        <td style="padding:10px;">
                            {{ $request->created_at->format('d-m-Y') }}
                        </td>

                        <td style="padding:10px;">
                            {{ $request->status }}
                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="3"
                            style="
                                text-align:center;
                                padding:15px;
                            "
                        >
                            Belum ada pengajuan izin.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- LEMBUR --}}

    <div class="card">

        <h2 style="color:#8B1E1E;">
            Pengajuan Lembur
        </h2>

        <table style="
            width:100%;
            border-collapse:collapse;
            margin-top:15px;
        ">

            <thead>

                <tr style="
                    background:#A8662A;
                    color:white;
                ">

                    <th style="padding:10px;">
                        Karyawan
                    </th>

                    <th style="padding:10px;">
                        Tanggal
                    </th>

                    <th style="padding:10px;">
                        Status
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($overtimeRequests as $request)

                    <tr>

                        <td style="padding:10px;">
                            {{ $request->employee?->full_name }}
                        </td>

                        <td style="padding:10px;">
                            {{ $request->created_at->format('d-m-Y') }}
                        </td>

                        <td style="padding:10px;">
                            {{ $request->status }}
                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="3"
                            style="
                                text-align:center;
                                padding:15px;
                            "
                        >
                            Belum ada pengajuan lembur.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection