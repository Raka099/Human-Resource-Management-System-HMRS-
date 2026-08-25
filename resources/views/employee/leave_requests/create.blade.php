@extends('layouts.app')

@section('title', 'Ajukan Cuti')

@section('content')

<div class="container">

    <div class="card">

        <h1 style="color:#8B1E1E;">
            Ajukan Cuti
        </h1>

        <p>
            Karyawan:
            <strong>
                {{ $employee->full_name }}
            </strong>
        </p>


        <form
            action="{{ route('employee.leave-requests.store') }}"
            method="POST"
        >

            @csrf


            <label>
                Tanggal Mulai
            </label>

            <input
                type="date"
                name="start_date"
                value="{{ old('start_date') }}"
                required
                style="
                    width:100%;
                    padding:12px;
                    margin:8px 0 15px;
                "
            >

            @error('start_date')

                <p style="color:#D5322F;">
                    {{ $message }}
                </p>

            @enderror


            <label>
                Tanggal Selesai
            </label>

            <input
                type="date"
                name="end_date"
                value="{{ old('end_date') }}"
                required
                style="
                    width:100%;
                    padding:12px;
                    margin:8px 0 15px;
                "
            >

            @error('end_date')

                <p style="color:#D5322F;">
                    {{ $message }}
                </p>

            @enderror


            <label>
                Alasan Cuti
            </label>

            <textarea
                name="reason"
                rows="5"
                required
                placeholder="Masukkan alasan pengajuan cuti..."
                style="
                    width:100%;
                    padding:12px;
                    margin:8px 0 15px;
                "
            >{{ old('reason') }}</textarea>

            @error('reason')

                <p style="color:#D5322F;">
                    {{ $message }}
                </p>

            @enderror


            <div style="margin-top:25px;">

                <button
                    type="submit"
                    class="btn-primary"
                >
                    Kirim Pengajuan
                </button>

                <a
                    href="{{ route('employee.leave-requests.index') }}"
                    class="btn-primary"
                >
                    Kembali
                </a>

            </div>

        </form>

    </div>

</div>

@endsection