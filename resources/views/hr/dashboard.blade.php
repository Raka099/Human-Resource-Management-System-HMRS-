@extends('layouts.app')

@section('title', 'HR Dashboard')

@section('content')

<div class="container">

    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="card">

        <h1 style="color:#8B1E1E; margin-top:0;">
            HR Dashboard
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
         STATISTICS
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

        </div>


        {{-- PELAMAR --}}

        <div class="stat-card">

            <div class="stat-title">
                Total Pelamar
            </div>

            <div class="stat-number">
                {{ $applicantCount }}
            </div>

        </div>


        {{-- DOKUMEN --}}

        <div class="stat-card">

            <div class="stat-title">
                Total Dokumen
            </div>

            <div class="stat-number">
                {{ $documentCount }}
            </div>

        </div>


        {{-- KONTRAK --}}

        <div class="stat-card">

            <div class="stat-title">
                Total Kontrak
            </div>

            <div class="stat-number">
                {{ $contractCount }}
            </div>

        </div>

    </div>

{{-- =====================================================
         LAPORAN
    ====================================================== --}}

    <div
        class="card"
        style="
            margin-top:25px;
        "
    >

        <h2 style="
            color:#8B1E1E;
            margin-top:0;
        ">
            Laporan
        </h2>

        <p style="
            margin:10px 0 20px;
        ">
            Lihat dan filter laporan data karyawan perusahaan.
        </p>

        <a
            href="{{ route('reports.employees.index') }}"
            class="btn-primary"
        >
            Laporan Data Karyawan
        </a>

    </div>


    {{-- =====================================================
         GRAPH
    ====================================================== --}}

    <div class="chart-grid">


        {{-- GRAFIK DATA HR --}}

        <div class="chart-card">

            <div class="chart-title">
                Statistik Data HR
            </div>

            <div class="chart-container">

                <canvas id="hrDataChart"></canvas>

            </div>

        </div>


        {{-- GRAFIK PENGAJUAN --}}

        <div class="chart-card">

            <div class="chart-title">
                Statistik Pengajuan
            </div>

            <div class="chart-container">

                <canvas id="requestChart"></canvas>

            </div>

        </div>

    </div>


    {{-- =====================================================
         MENU INFORMASI
    ====================================================== --}}

    <div
        class="card"
        style="margin-top:25px;"
    >

        <h2
            style="
                color:#8B1E1E;
                margin-top:0;
            "
        >
            Informasi HRMS
        </h2>

        <p>
            Gunakan menu di sebelah kiri untuk mengelola
            data Department, Position, Karyawan, dan Pelamar.
        </p>

    </div>

</div>


{{-- =========================================================
     CHART SCRIPT
========================================================= --}}

<script>

    /*
    |--------------------------------------------------------------------------
    | Grafik Data HR
    |--------------------------------------------------------------------------
    */

    const hrDataChart =
        document
            .getElementById('hrDataChart');


    new Chart(hrDataChart, {

        type: 'bar',

        data: {

            labels: [
                'Karyawan',
                'Pelamar',
                'Dokumen',
                'Kontrak'
            ],

            datasets: [{

                label: 'Jumlah Data',

                data: [
                    {{ $employeeCount }},
                    {{ $applicantCount }},
                    {{ $documentCount }},
                    {{ $contractCount }}
                ],

                backgroundColor: [
                    '#8B1E1E',
                    '#D5322F',
                    '#F4D66D',
                    '#A8662A'
                ],

                borderRadius: 8

            }]

        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            plugins: {

                legend: {
                    display: false
                }

            },

            scales: {

                y: {

                    beginAtZero: true,

                    ticks: {
                        precision: 0
                    }

                }

            }

        }

    });


    /*
    |--------------------------------------------------------------------------
    | Grafik Pengajuan
    |--------------------------------------------------------------------------
    */

    const requestChart =
        document
            .getElementById('requestChart');


    new Chart(requestChart, {

        type: 'doughnut',

        data: {

            labels: [
                'Cuti',
                'Izin',
                'Lembur'
            ],

            datasets: [{

                data: [
                    {{ $leaveCount ?? 0 }},
                    {{ $permissionCount ?? 0 }},
                    {{ $overtimeCount ?? 0 }}
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

            plugins: {

                legend: {
                    position: 'bottom'
                }

            }

        }

    });

</script>

@endsection