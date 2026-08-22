@extends('layouts.app')

@section('title', 'Tambah Karyawan')

@section('content')

<div class="container">

    <div class="card">

        <h1 style="color:#8B1E1E;">
            Tambah Karyawan
        </h1>

        <form
            action="{{ route('employees.store') }}"
            method="POST"
            style="margin-top:25px;"
        >

            @csrf

            <label>
                Nomor Karyawan
            </label>

            <input
                type="text"
                name="employee_number"
                value="{{ old('employee_number') }}"
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


            <label>
                Nama Lengkap
            </label>

            <input
                type="text"
                name="full_name"
                value="{{ old('full_name') }}"
                required
                style="
                    width:100%;
                    padding:12px;
                    margin:8px 0 15px;
                "
            >

            @error('full_name')
                <p style="color:#D5322F;">
                    {{ $message }}
                </p>
            @enderror


            <label>
                Email
            </label>

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                style="
                    width:100%;
                    padding:12px;
                    margin:8px 0 15px;
                "
            >


            <label>
                Nomor Telepon
            </label>

            <input
                type="text"
                name="phone"
                value="{{ old('phone') }}"
                style="
                    width:100%;
                    padding:12px;
                    margin:8px 0 15px;
                "
            >


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
                "
            >{{ old('address') }}</textarea>


            <label>
                Tanggal Lahir
            </label>

            <input
                type="date"
                name="birth_date"
                value="{{ old('birth_date') }}"
                style="
                    width:100%;
                    padding:12px;
                    margin:8px 0 15px;
                "
            >


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


            <button
                type="submit"
                class="btn-primary"
            >
                Simpan Karyawan
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