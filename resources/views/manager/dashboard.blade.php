@extends('layouts.app')

@section('title', 'Manager Dashboard')

@section('content')

<div class="container">

    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="card">

        <h1 style="
            color:#8B1E1E;
            margin-top:0;
        ">
            Manager Dashboard
        </h1>

        <p>
            Selamat datang,
            <strong>{{ auth()->user()->name }}</strong>.
        </p>

        <p>
            Role:
            <strong>
                {{ auth()->user()->role->role_name }}
            </strong>
        </p>

    </div>


    {{-- =====================================================
         STATISTIK
    ====================================================== --}}

    <div class="stat-grid">

        {{-- KARYAWAN --}}

        <div class="stat-card">

            <div class="stat-title">
                Total Karyawan
            </div>

            <div class="stat-number">
                {{ $employeeCount }}
            </div>

            <a
                href="#data-karyawan"
                class="btn-primary"
                style="margin-top:10px;"
            >
                Lihat Karyawan
            </a>

        </div>


        {{-- CUTI --}}

        <div class="stat-card">

            <div class="stat-title">
                Pengajuan Cuti
            </div>

            <div class="stat-number">
                {{ $leaveCount }}
            </div>

            <a
                href="#pengajuan"
                class="btn-primary"
                style="margin-top:10px;"
            >
                Lihat Pengajuan
            </a>

        </div>


        {{-- IZIN --}}

        <div class="stat-card">

            <div class="stat-title">
                Pengajuan Izin
            </div>

            <div class="stat-number">
                {{ $permissionCount }}
            </div>

            <a
                href="#pengajuan"
                class="btn-primary"
                style="margin-top:10px;"
            >
                Lihat Pengajuan
            </a>

        </div>


        {{-- LEMBUR --}}

        <div class="stat-card">

            <div class="stat-title">
                Pengajuan Lembur
            </div>

            <div class="stat-number">
                {{ $overtimeCount }}
            </div>

            <a
                href="#pengajuan"
                class="btn-primary"
                style="margin-top:10px;"
            >
                Lihat Pengajuan
            </a>

        </div>

    </div>


    {{-- =====================================================
         CONTENT GRID
    ====================================================== --}}

    <div class="chart-grid">


        {{-- GRAFIK --}}

        <div class="chart-card">

            <div class="chart-title">
                Statistik Pengajuan
            </div>

            <div
                class="chart-container"
                style="height:300px;"
            >

                <canvas id="managerRequestChart"></canvas>

            </div>

        </div>


        {{-- MENU APPROVAL --}}

        {{-- <div class="chart-card">

            <div class="chart-title">
                Persetujuan Pengajuan
            </div>

            <p>
                Kelola dan lakukan persetujuan terhadap
                pengajuan administrasi karyawan.
            </p>

            <div
                style="
                    display:flex;
                    flex-direction:column;
                    gap:10px;
                    margin-top:20px;
                "
            >

                <a
                    href="#pengajuan"
                    class="btn-primary"
                >
                    Pengajuan Cuti
                </a>

                <a
                    href="#pengajuan"
                    class="btn-primary"
                >
                    Pengajuan Izin
                </a>

                <a
                    href="#pengajuan"
                    class="btn-primary"
                >
                    Pengajuan Lembur
                </a>

            </div>

        </div>

    </div> --}}


    {{-- =====================================================
         DATA KARYAWAN
    ====================================================== --}}

    {{-- <div
        class="card"
        id="data-karyawan"
        style="margin-top:25px;"
    >

        <h2 style="
            color:#8B1E1E;
            margin-top:0;
        ">
            Data Karyawan
        </h2>

        <p>
            Manager dapat melihat informasi karyawan
            perusahaan.
        </p>

        <div
            style="
                overflow-x:auto;
                margin-top:20px;
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

                        <th style="padding:12px;text-align:left;">
                            No
                        </th>

                        <th style="padding:12px;text-align:left;">
                            Nomor Karyawan
                        </th>

                        <th style="padding:12px;text-align:left;">
                            Nama
                        </th>

                        <th style="padding:12px;text-align:left;">
                            Department
                        </th>

                        <th style="padding:12px;text-align:left;">
                            Position
                        </th>

                        <th style="padding:12px;text-align:left;">
                            Status
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($employees ?? [] as $employee)

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
                                {{ $employee->department?->department_name ?? '-' }}
                            </td>

                            <td style="padding:12px;">
                                {{ $employee->position?->position_name ?? '-' }}
                            </td>

                            <td style="padding:12px;">
                                {{ $employee->employment_status }}
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                style="
                                    padding:20px;
                                    text-align:center;
                                    color:#777;
                                "
                            >
                                Belum ada data karyawan.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div> --}}


    {{-- =====================================================
         PENGAJUAN
    ====================================================== --}}

    <div
        class="card"
        id="pengajuan"
        style="margin-top:25px;"
    >

        <h2 style="
            color:#8B1E1E;
            margin-top:0;
        ">
            Pengajuan Karyawan
        </h2>

        <p>
            Menu ini nantinya digunakan Manager untuk
            melakukan approval pengajuan karyawan.
        </p>

        <div
            style="
                display:grid;
                grid-template-columns:repeat(3, 1fr);
                gap:20px;
                margin-top:20px;
            "
        >

            <div
                style="
                    padding:20px;
                    border-radius:12px;
                    background:#FAF8F5;
                    border-left:5px solid #8B1E1E;
                "
            >

                <h3 style="color:#8B1E1E;">
                    Cuti
                </h3>

                <p>
                    {{ $leaveCount }}
                    pengajuan cuti.
                </p>

            </div>


            <div
                style="
                    padding:20px;
                    border-radius:12px;
                    background:#FAF8F5;
                    border-left:5px solid #D5322F;
                "
            >

                <h3 style="color:#D5322F;">
                    Izin
                </h3>

                <p>
                    {{ $permissionCount }}
                    pengajuan izin.
                </p>

            </div>


            <div
                style="
                    padding:20px;
                    border-radius:12px;
                    background:#FAF8F5;
                    border-left:5px solid #F4D66D;
                "
            >

                <h3 style="color:#A8662A;">
                    Lembur
                </h3>

                <p>
                    {{ $overtimeCount }}
                    pengajuan lembur.
                </p>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     CHART
========================================================= --}}

<script>

    const managerRequestChart =
        document.getElementById(
            'managerRequestChart'
        );

    new Chart(managerRequestChart, {

        type: 'bar',

        data: {

            labels: [
                'Cuti',
                'Izin',
                'Lembur'
            ],

            datasets: [{

                label: 'Total Pengajuan',

                data: [
                    {{ $leaveCount }},
                    {{ $permissionCount }},
                    {{ $overtimeCount }}
                ],

                backgroundColor: [
                    '#8B1E1E',
                    '#D5322F',
                    '#F4D66D'
                ]

            }]

        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            scales: {

                y: {

                    beginAtZero: true,

                    ticks: {
                        precision: 0
                    }

                }

            },

            plugins: {

                legend: {
                    display: false
                }

            }

        }

    });

</script>

@endsection