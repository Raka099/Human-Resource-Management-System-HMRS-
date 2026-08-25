@extends('layouts.app')

@section('title', 'Dashboard Laporan')

@section('content')

<div class="container">

    <div class="card">

        <h1 style="
            color:#8B1E1E;
            margin-top:0;
        ">
            Dashboard Laporan
        </h1>

        <p>
            Ringkasan data karyawan dan seluruh pengajuan HRMS.
        </p>

    </div>


    {{-- STATISTIK KARYAWAN --}}

    <div class="stat-grid">

        <div class="stat-card">

            <div class="stat-title">
                Total Karyawan
            </div>

            <div class="stat-number">
                {{ $employeeCount }}
            </div>

        </div>


        <div class="stat-card">

            <div class="stat-title">
                Karyawan Aktif
            </div>

            <div class="stat-number">
                {{ $activeEmployeeCount }}
            </div>

        </div>


        <div class="stat-card">

            <div class="stat-title">
                Karyawan Tidak Aktif
            </div>

            <div class="stat-number">
                {{ $inactiveEmployeeCount }}
            </div>

        </div>

    </div>


    {{-- STATISTIK PENGAJUAN --}}

    <div class="stat-grid">

        <div class="stat-card">

            <div class="stat-title">
                Total Cuti
            </div>

            <div class="stat-number">
                {{ $leaveCount }}
            </div>

        </div>


        <div class="stat-card">

            <div class="stat-title">
                Total Izin
            </div>

            <div class="stat-number">
                {{ $permissionCount }}
            </div>

        </div>


        <div class="stat-card">

            <div class="stat-title">
                Total Lembur
            </div>

            <div class="stat-number">
                {{ $overtimeCount }}
            </div>

        </div>

    </div>


    {{-- CHART --}}

    <div
        class="chart-grid"
        style="margin-top:25px;"
    >

        <div class="chart-card">

            <div class="chart-title">
                Status Pengajuan Cuti
            </div>

            <div class="chart-container">

                <canvas id="leaveChart"></canvas>

            </div>

        </div>


        <div class="chart-card">

            <div class="chart-title">
                Status Pengajuan Izin
            </div>

            <div class="chart-container">

                <canvas id="permissionChart"></canvas>

            </div>

        </div>


        <div class="chart-card">

            <div class="chart-title">
                Status Pengajuan Lembur
            </div>

            <div class="chart-container">

                <canvas id="overtimeChart"></canvas>

            </div>

        </div>

    </div>


    {{-- MENU LAPORAN --}}

    <div
        class="card"
        style="margin-top:25px;"
    >

        <h2 style="
            color:#8B1E1E;
            margin-top:0;
        ">
            Daftar Laporan
        </h2>


        <div
            style="
                display:grid;
                grid-template-columns:
                    repeat(2, 1fr);
                gap:15px;
            "
        >

            <a
                href="{{ route('reports.employees.index') }}"
                class="btn-primary"
            >
                📊 Laporan Data Karyawan
            </a>


            <a
                href="{{ route('reports.leave.index') }}"
                class="btn-primary"
            >
                📅 Laporan Pengajuan Cuti
            </a>


            <a
                href="{{ route('reports.permission.index') }}"
                class="btn-primary"
            >
                📋 Laporan Pengajuan Izin
            </a>


            <a
                href="{{ route('reports.overtime.index') }}"
                class="btn-primary"
            >
                ⏰ Laporan Pengajuan Lembur
            </a>

        </div>

    </div>

</div>


<script>

    new Chart(
        document.getElementById('leaveChart'),
        {
            type: 'doughnut',

            data: {

                labels: [
                    'Pending',
                    'Approved',
                    'Rejected'
                ],

                datasets: [{

                    data: [
                        {{ $leavePending }},
                        {{ $leaveApproved }},
                        {{ $leaveRejected }}
                    ],

                    backgroundColor: [
                        '#F4D66D',
                        '#A8662A',
                        '#D5322F'
                    ]

                }]

            },

            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        }
    );


    new Chart(
        document.getElementById('permissionChart'),
        {
            type: 'doughnut',

            data: {

                labels: [
                    'Pending',
                    'Approved',
                    'Rejected'
                ],

                datasets: [{

                    data: [
                        {{ $permissionPending }},
                        {{ $permissionApproved }},
                        {{ $permissionRejected }}
                    ],

                    backgroundColor: [
                        '#F4D66D',
                        '#A8662A',
                        '#D5322F'
                    ]

                }]

            },

            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        }
    );


    new Chart(
        document.getElementById('overtimeChart'),
        {
            type: 'doughnut',

            data: {

                labels: [
                    'Pending',
                    'Approved',
                    'Rejected'
                ],

                datasets: [{

                    data: [
                        {{ $overtimePending }},
                        {{ $overtimeApproved }},
                        {{ $overtimeRejected }}
                    ],

                    backgroundColor: [
                        '#F4D66D',
                        '#A8662A',
                        '#D5322F'
                    ]

                }]

            },

            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        }
    );

</script>

@endsection