@extends('layouts.app')

@section('title', 'Generate Karyawan')

@section('content')

<div class="container">

    <div class="card">

        <h1 style="color:#8B1E1E;">
            Generate Karyawan
        </h1>

        <p style="margin-top:5px; margin-bottom:25px;">
            Buat data karyawan berdasarkan data pelamar yang diterima.
        </p>


        {{-- Informasi Applicant --}}

        <div style="
            background:#FAF8F5;
            padding:20px;
            border-left:5px solid #8B1E1E;
            margin-bottom:25px;
            border-radius:8px;
        ">

            <h3 style="color:#8B1E1E;">
                Data Pelamar
            </h3>

            <p>
                <strong>Nomor Lamaran:</strong>
                {{ $applicant->application_number }}
            </p>

            <p>
                <strong>Nama:</strong>
                {{ $applicant->full_name }}
            </p>

            <p>
                <strong>Email:</strong>
                {{ $applicant->email }}
            </p>

            <p>
                <strong>Telepon:</strong>
                {{ $applicant->phone ?? '-' }}
            </p>

            <p>
                <strong>Alamat:</strong>
                {{ $applicant->address ?? '-' }}
            </p>

            <p>
                <strong>Status:</strong>

                <span style="
                    background:#F4D66D;
                    padding:5px 10px;
                    border-radius:15px;
                ">
                    {{ $applicant->status }}
                </span>

            </p>

        </div>


        {{-- Form Employee --}}

        <form
            action="{{ route(
                'applicants.store-generated-employee',
                $applicant
            ) }}"
            method="POST"
        >

            @csrf


            {{-- Nomor Karyawan --}}

            <label>
                Nomor Karyawan
            </label>

            <input
                type="text"
                name="employee_number"
                value="{{ old('employee_number') }}"
                placeholder="Contoh: EMP001"
                required
                style="
                    width:100%;
                    padding:12px;
                    margin:8px 0 15px;
                "
            >

            @error('employee_number')
                <p style="color:#D5322F;">
                    {{ $message }}
                </p>
            @enderror


            {{-- Nama --}}

            <label>
                Nama Lengkap
            </label>

            <input
                type="text"
                value="{{ $applicant->full_name }}"
                disabled
                style="
                    width:100%;
                    padding:12px;
                    margin:8px 0 15px;
                    background:#eee;
                "
            >


            {{-- Email --}}

            <label>
                Email
            </label>

            <input
                type="email"
                value="{{ $applicant->email }}"
                disabled
                style="
                    width:100%;
                    padding:12px;
                    margin:8px 0 15px;
                    background:#eee;
                "
            >


            {{-- Telepon --}}

            <label>
                Nomor Telepon
            </label>

            <input
                type="text"
                value="{{ $applicant->phone }}"
                disabled
                style="
                    width:100%;
                    padding:12px;
                    margin:8px 0 15px;
                    background:#eee;
                "
            >


            {{-- Department --}}

            <label>
                Department
            </label>

            <select
                name="department_id"
                required
                style="
                    width:100%;
                    padding:12px;
                    margin:8px 0 15px;
                "
            >

                <option value="">
                    -- Pilih Department --
                </option>

                @foreach($departments as $department)

                    <option
                        value="{{ $department->id }}"
                        @selected(
                            old('department_id')
                            == $department->id
                        )
                    >
                        {{ $department->department_name }}
                    </option>

                @endforeach

            </select>

            @error('department_id')
                <p style="color:#D5322F;">
                    {{ $message }}
                </p>
            @enderror


            {{-- Position --}}

            <label>
                Position
            </label>

            <select
                name="position_id"
                required
                style="
                    width:100%;
                    padding:12px;
                    margin:8px 0 15px;
                "
            >

                <option value="">
                    -- Pilih Position --
                </option>

                @foreach($positions as $position)

                    <option
                        value="{{ $position->id }}"
                        @selected(
                            old('position_id')
                            == $position->id
                        )
                    >
                        {{ $position->position_name }}
                    </option>

                @endforeach

            </select>

            @error('position_id')
                <p style="color:#D5322F;">
                    {{ $message }}
                </p>
            @enderror


            {{-- Join Date --}}

            <label>
                Tanggal Bergabung
            </label>

            <input
                type="date"
                name="join_date"
                value="{{ old('join_date') }}"
                required
                style="
                    width:100%;
                    padding:12px;
                    margin:8px 0 15px;
                "
            >

            @error('join_date')
                <p style="color:#D5322F;">
                    {{ $message }}
                </p>
            @enderror


            {{-- Status --}}

            <label>
                Status Kepegawaian
            </label>

            <select
                name="employment_status"
                required
                style="
                    width:100%;
                    padding:12px;
                    margin:8px 0 20px;
                "
            >

                <option value="Active">
                    Active
                </option>

                <option value="Inactive">
                    Inactive
                </option>

            </select>

            {{-- Password Akun --}}
            <div style="margin-top:20px;">

                <label>
                    Password Login
                </label>

                <input
                    type="password"
                    name="password"
                    required
                    minlength="8"
                    style="
                        width:100%;
                        padding:12px;
                        margin:8px 0 15px;
                        border:1px solid #ccc;
                        border-radius:7px;
                    "
                >

                @error('password')
                    <p style="color:#D5322F;">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Konfirmasi Password --}}
            <div style="margin-top:5px;">

                <label>
                    Konfirmasi Password
                </label>

                <input
                    type="password"
                    name="password_confirmation"
                    required
                    minlength="8"
                    style="
                        width:100%;
                        padding:12px;
                        margin:8px 0 20px;
                        border:1px solid #ccc;
                        border-radius:7px;
                    "
                >

            </div>

            <button
                type="submit"
                class="btn-primary"
            >
                Generate Karyawan
            </button>

            <a
                href="{{ route('applicants.index') }}"
                class="btn-primary"
            >
                Kembali
            </a>

        </form>

    </div>

</div>

@endsection