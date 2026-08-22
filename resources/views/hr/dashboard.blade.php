@extends('layouts.app')

@section('title', 'HR Dashboard')

@section('content')

<div class="container">

    <div class="card">

        <h1 style="color: #8B1E1E;">
            HR Dashboard
        </h1>

        <p style="margin-top: 10px;">
            Selamat datang,
            <strong>{{ auth()->user()->name }}</strong>.
        </p>

        <p style="margin-top: 10px;">
            Role:
            <strong>{{ auth()->user()->role->role_name }}</strong>
        </p>

    </div>
    <div
    style="
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        margin-top: 25px;
    "
>

    <div class="card">

        <h2 style="color: #8B1E1E;">
            Department
        </h2>

        <p style="margin: 10px 0;">
            Kelola data department perusahaan.
        </p>

        <a
            href="{{ route('departments.index') }}"
            class="btn-primary"
        >
            Kelola Department
        </a>

    </div>

    <div class="card">

        <h2 style="color: #8B1E1E;">
            Position
        </h2>

        <p style="margin: 10px 0;">
            Kelola data jabatan perusahaan.
        </p>

        <a
            href="{{ route('positions.index') }}"
            class="btn-primary"
        >
            Kelola Position
        </a>

    </div>

    <div class="card">

        <h2 style="color:#8B1E1E;">
            Data Karyawan
        </h2>

        <p style="margin:10px 0;">
            Kelola data karyawan perusahaan.
        </p>

        <a
            href="{{ route('employees.index') }}"
            class="btn-primary"
        >
            Kelola Karyawan
        </a>

    </div>

</div>

</div>

@endsection