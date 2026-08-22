@extends('layouts.app')

@section('title', 'Edit Karyawan')

@section('content')

<div class="container">

    <div class="card">

        <h1 style="color:#8B1E1E;">
            Edit Karyawan
        </h1>

        <p style="margin-top:5px; margin-bottom:25px;">
            Perbarui data karyawan.
        </p>

        <form
            action="{{ route('employees.update', $employee) }}"
            method="POST"
        >

            @csrf
            @method('PUT')


            {{-- Nomor Karyawan --}}
            <label>
                Nomor Karyawan
            </label>

            <input
                type="text"
                name="employee_number"
                value="{{ old('employee_number', $employee->employee_number) }}"
                required
                style="
                    width:100%;
                    padding:12px;
                    margin:8px 0 15px;
                    border:1px solid #ccc;
                    border-radius:7px;
                "
            >

            @error('employee_number')
                <p style="color:#D5322F;">
                    {{ $message }}
                </p>
            @enderror


            {{-- Nama Lengkap --}}
            <label>
                Nama Lengkap
            </label>

            <input
                type="text"
                name="full_name"
                value="{{ old('full_name', $employee->full_name) }}"
                required
                style="
                    width:100%;
                    padding:12px;
                    margin:8px 0 15px;
                    border:1px solid #ccc;
                    border-radius:7px;
                "
            >

            @error('full_name')
                <p style="color:#D5322F;">
                    {{ $message }}
                </p>
            @enderror


            {{-- Email --}}
            <label>
                Email
            </label>

            <input
                type="email"
                name="email"
                value="{{ old('email', $employee->email) }}"
                required
                style="
                    width:100%;
                    padding:12px;
                    margin:8px 0 15px;
                    border:1px solid #ccc;
                    border-radius:7px;
                "
            >

            @error('email')
                <p style="color:#D5322F;">
                    {{ $message }}
                </p>
            @enderror


            {{-- Nomor Telepon --}}
            <label>
                Nomor Telepon
            </label>

            <input
                type="text"
                name="phone"
                value="{{ old('phone', $employee->phone) }}"
                style="
                    width:100%;
                    padding:12px;
                    margin:8px 0 15px;
                    border:1px solid #ccc;
                    border-radius:7px;
                "
            >

            @error('phone')
                <p style="color:#D5322F;">
                    {{ $message }}
                </p>
            @enderror


            {{-- Alamat --}}
            <label>
                Alamat
            </label>

            <textarea
                name="address"
                rows="3"
                style="
                    width:100%;
                    padding:12px;
                    margin:8px 0 15px;
                    border:1px solid #ccc;
                    border-radius:7px;
                "
            >{{ old('address', $employee->address) }}</textarea>

            @error('address')
                <p style="color:#D5322F;">
                    {{ $message }}
                </p>
            @enderror


            {{-- Tanggal Lahir --}}
            <label>
                Tanggal Lahir
            </label>

            <input
                type="date"
                name="birth_date"
                value="{{ old(
                    'birth_date',
                    $employee->birth_date
                        ? $employee->birth_date->format('Y-m-d')
                        : ''
                ) }}"
                style="
                    width:100%;
                    padding:12px;
                    margin:8px 0 15px;
                    border:1px solid #ccc;
                    border-radius:7px;
                "
            >

            @error('birth_date')
                <p style="color:#D5322F;">
                    {{ $message }}
                </p>
            @enderror


            {{-- Tanggal Bergabung --}}
            <label>
                Tanggal Bergabung
            </label>

            <input
                type="date"
                name="join_date"
                value="{{ old(
                    'join_date',
                    $employee->join_date
                        ? $employee->join_date->format('Y-m-d')
                        : ''
                ) }}"
                required
                style="
                    width:100%;
                    padding:12px;
                    margin:8px 0 15px;
                    border:1px solid #ccc;
                    border-radius:7px;
                "
            >

            @error('join_date')
                <p style="color:#D5322F;">
                    {{ $message }}
                </p>
            @enderror


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
                    border:1px solid #ccc;
                    border-radius:7px;
                "
            >

                <option value="">
                    -- Pilih Department --
                </option>

                @foreach($departments as $department)

                    <option
                        value="{{ $department->id }}"
                        @selected(
                            old(
                                'department_id',
                                $employee->department_id
                            ) == $department->id
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
                    border:1px solid #ccc;
                    border-radius:7px;
                "
            >

                <option value="">
                    -- Pilih Position --
                </option>

                @foreach($positions as $position)

                    <option
                        value="{{ $position->id }}"
                        @selected(
                            old(
                                'position_id',
                                $employee->position_id
                            ) == $position->id
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


            {{-- Status Kepegawaian --}}
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
                    border:1px solid #ccc;
                    border-radius:7px;
                "
            >

                <option
                    value="Active"
                    @selected(
                        old(
                            'employment_status',
                            $employee->employment_status
                        ) === 'Active'
                    )
                >
                    Active
                </option>

                <option
                    value="Inactive"
                    @selected(
                        old(
                            'employment_status',
                            $employee->employment_status
                        ) === 'Inactive'
                    )
                >
                    Inactive
                </option>

            </select>

            @error('employment_status')
                <p style="color:#D5322F;">
                    {{ $message }}
                </p>
            @enderror


            {{-- Tombol --}}
            <button
                type="submit"
                class="btn-primary"
            >
                Update Karyawan
            </button>

            <a
                href="{{ route('employees.index') }}"
                class="btn-primary"
            >
                Kembali
            </a>

        </form>

    </div>

</div>

@endsection