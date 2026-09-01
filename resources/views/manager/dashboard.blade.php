@extends('layouts.app')

@section('title', 'Dashboard Manager')

@section('content')

<div class="container">

    <div class="card">

        <h1 style="color:#8B1E1E;">
            Dashboard Manager
        </h1>

        <p>
            Selamat datang,
            <strong>{{ auth()->user()->name }}</strong>
        </p>

        <p>
            Department:
            <strong>
                {{ $department->department_name }}
            </strong>
        </p>

    </div>


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
                Pending Cuti
            </div>

            <div class="stat-number">
                {{ $pendingLeave }}
            </div>

        </div>


        <div class="stat-card">

            <div class="stat-title">
                Pending Izin
            </div>

            <div class="stat-number">
                {{ $pendingPermission }}
            </div>

        </div>


        <div class="stat-card">

            <div class="stat-title">
                Pending Lembur
            </div>

            <div class="stat-number">
                {{ $pendingOvertime }}
            </div>

        </div>

    </div>

</div>

@endsection