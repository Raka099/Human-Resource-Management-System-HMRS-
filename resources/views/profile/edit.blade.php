@extends('layouts.app')

@section('title', 'Profile')

@section('content')

<div class="container">

    <div class="card">

        <h1 style="color:#8B1E1E;">
            Profile Saya
        </h1>

        <p style="margin-bottom:25px;">
            Kelola informasi akun Anda.
        </p>

        @if(session('status') === 'profile-updated')
            <div style="
                background:#F4D66D;
                color:#8B1E1E;
                padding:12px;
                margin-bottom:20px;
                border-radius:8px;
            ">
                Profile berhasil diperbarui.
            </div>
        @endif

        @if($errors->any())
            <div style="
                background:#FDECEC;
                color:#D5322F;
                padding:12px;
                margin-bottom:20px;
                border-radius:8px;
            ">
                @foreach($errors->all() as $error)
                    <p style="margin:0;">
                        {{ $error }}
                    </p>
                @endforeach
            </div>
        @endif


        {{-- INFORMASI AKUN --}}

        <h2 style="color:#8B1E1E;">
            Informasi Akun
        </h2>

        <form
            method="POST"
            action="{{ route('profile.update') }}"
        >

            @csrf
            @method('PATCH')

            {{-- Nama --}}

            <div style="margin-top:20px;">

                <label>
                    Nama
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $user->name) }}"
                    required
                    style="
                        width:100%;
                        padding:12px;
                        margin-top:8px;
                        border:1px solid #ccc;
                        border-radius:7px;
                    "
                >

                @error('name')
                    <p style="color:#D5322F;">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Email --}}

            <div style="margin-top:20px;">

                <label>
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email', $user->email) }}"
                    required
                    style="
                        width:100%;
                        padding:12px;
                        margin-top:8px;
                        border:1px solid #ccc;
                        border-radius:7px;
                    "
                >

                @error('email')
                    <p style="color:#D5322F;">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            <button
                type="submit"
                class="btn-primary"
                style="margin-top:20px;"
            >
                Simpan Perubahan
            </button>

        </form>


        {{-- INFORMASI KARYAWAN --}}

        @if($user->employee)

            <hr style="margin:30px 0;">

            <h2 style="color:#8B1E1E;">
                Informasi Karyawan
            </h2>

            <div style="margin-top:20px;">

                <p>
                    <strong>Nomor Karyawan:</strong>
                    {{ $user->employee->employee_number }}
                </p>

                <p>
                    <strong>Department:</strong>
                    {{ $user->employee->department->department_name ?? '-' }}
                </p>

                <p>
                    <strong>Position:</strong>
                    {{ $user->employee->position->position_name ?? '-' }}
                </p>

                <p>
                    <strong>Status:</strong>
                    {{ $user->employee->employment_status }}
                </p>

                <p>
                    <strong>No. Telepon:</strong>
                    {{ $user->employee->phone ?? '-' }}
                </p>

                <p>
                    <strong>Alamat:</strong>
                    {{ $user->employee->address ?? '-' }}
                </p>

                <p>
                    <strong>Tanggal Bergabung:</strong>
                    {{ $user->employee->join_date
                        ? $user->employee->join_date->format('d-m-Y')
                        : '-' }}
                </p>

            </div>

        @endif

    </div>

</div>

@endsection