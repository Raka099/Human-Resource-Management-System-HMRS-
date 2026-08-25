@extends('layouts.app')

@section('title', 'Employee Dashboard')

@section('content')

<div class="container">

    {{-- HEADER --}}
    <div class="card">

        <h1 style="
            color:#8B1E1E;
            margin-top:0;
        ">
            Employee Dashboard
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


    {{-- INFORMASI KARYAWAN --}}
    <div
        class="card"
        style="margin-top:25px;"
    >

        <h2 style="
            color:#8B1E1E;
            margin-top:0;
        ">
            Informasi Karyawan
        </h2>

        <div
            style="
                display:grid;
                grid-template-columns:repeat(3, 1fr);
                gap:20px;
            "
        >

            <div>

                <small style="color:#777;">
                    Nomor Karyawan
                </small>

                <p>
                    <strong>
                        {{ $employee->employee_number }}
                    </strong>
                </p>

            </div>


            <div>

                <small style="color:#777;">
                    Nama Lengkap
                </small>

                <p>
                    <strong>
                        {{ $employee->full_name }}
                    </strong>
                </p>

            </div>


            <div>

                <small style="color:#777;">
                    Email
                </small>

                <p>
                    <strong>
                        {{ $employee->email }}
                    </strong>
                </p>

            </div>


            <div>

                <small style="color:#777;">
                    Department
                </small>

                <p>
                    <strong>
                        {{ $employee->department?->department_name ?? '-' }}
                    </strong>
                </p>

            </div>


            <div>

                <small style="color:#777;">
                    Position
                </small>

                <p>
                    <strong>
                        {{ $employee->position?->position_name ?? '-' }}
                    </strong>
                </p>

            </div>


            <div>

                <small style="color:#777;">
                    Status
                </small>

                <p>
                    <strong>
                        {{ $employee->employment_status }}
                    </strong>
                </p>

            </div>

        </div>

    </div>


    {{-- STATISTIK PENGAJUAN --}}
    <div class="stat-grid">

        {{-- CUTI --}}
        <div class="stat-card">

            <div class="stat-title">
                Total Pengajuan Cuti
            </div>

            <div class="stat-number">
                {{ $leaveCount }}
            </div>

            <a
                href="{{ route('employee.leave-requests.index', [
                    'employee' => $employee->id
                ]) }}"
                class="btn-primary"
                style="margin-top:10px;"
            >
                Lihat Cuti
            </a>

        </div>


        {{-- IZIN --}}
        <div class="stat-card">

            <div class="stat-title">
                Total Pengajuan Izin
            </div>

            <div class="stat-number">
                {{ $permissionCount }}
            </div>

            <a
                href="{{ route('employee.permission-requests.index') }}"
                class="btn-primary"
                style="margin-top:10px;"
            >
                Lihat Izin
            </a>

        </div>


        {{-- LEMBUR --}}
        <div class="stat-card">

            <div class="stat-title">
                Total Pengajuan Lembur
            </div>

            <div class="stat-number">
                {{ $overtimeCount }}
            </div>

            @if(Route::has('employee.overtime-requests.index'))

                <a
                    href="{{ route('employee.overtime-requests.index') }}"
                    class="btn-primary"
                    style="margin-top:10px;"
                >
                    Lihat Lembur
                </a>

            @endif

        </div>

    </div>


    {{-- GRAFIK --}}
    <div class="chart-grid">

        <div class="chart-card">

            <div class="chart-title">
                Statistik Pengajuan Saya
            </div>

            <div class="chart-container">

                <canvas id="employeeRequestChart"></canvas>

            </div>

        </div>


        {{-- MENU PENGAJUAN --}}
        <div class="chart-card">

            <div class="chart-title">
                Pengajuan Baru
            </div>

            <p>
                Gunakan menu berikut untuk membuat
                pengajuan administrasi.
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
                    href="{{ route('employee.leave-requests.create', [
                        'employee' => $employee->id
                    ]) }}"
                    class="btn-primary"
                >
                    + Ajukan Cuti
                </a>


                <a
                    href="{{ route('employee.permission-requests.create') }}"
                    class="btn-primary"
                >
                    + Ajukan Izin
                </a>


                @if(Route::has('employee.overtime-requests.create'))

                    <a
                        href="{{ route('employee.overtime-requests.create') }}"
                        class="btn-primary"
                    >
                        + Ajukan Lembur
                    </a>

                @endif

            </div>

        </div>

    </div>


</div>


{{-- CHART --}}
<script>

    const employeeRequestChart =
        document.getElementById(
            'employeeRequestChart'
        );

    new Chart(employeeRequestChart, {

        type: 'doughnut',

        data: {

            labels: [
                'Cuti',
                'Izin',
                'Lembur'
            ],

            datasets: [{

                data: [
                    {{ $leaveCount }},
                    {{ $permissionCount }},
                    {{ $overtimeCount }}
                ],

                backgroundColor: [
                    '#8B1E1E',
                    '#D5322F',
                    '#F4D66D'
                ],

                borderWidth: 0

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