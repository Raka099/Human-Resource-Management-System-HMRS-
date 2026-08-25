@extends('layouts.app')

@section('title', 'Ajukan Lembur')

@section('content')

<div class="container">

    <div class="card">

        <h1 style="color:#8B1E1E;">
            Ajukan Lembur
        </h1>

        @if ($errors->any())

            <div style="
                background:#FDECEC;
                color:#8B1E1E;
                padding:15px;
                margin-bottom:20px;
                border-radius:8px;
            ">

                <ul style="margin:0;">

                    @foreach ($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        <form
            action="{{ route('employee.overtime-requests.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf


            <label>
                Tanggal Lembur
            </label>

            <input
                type="date"
                name="overtime_date"
                value="{{ old('overtime_date') }}"
                required
                style="
                    width:100%;
                    padding:12px;
                    margin:8px 0 15px;
                "
            >


            <label>
                Jam Mulai
            </label>

            <input
                type="time"
                name="start_time"
                value="{{ old('start_time') }}"
                required
                style="
                    width:100%;
                    padding:12px;
                    margin:8px 0 15px;
                "
            >


            <label>
                Jam Selesai
            </label>

            <input
                type="time"
                name="end_time"
                value="{{ old('end_time') }}"
                required
                style="
                    width:100%;
                    padding:12px;
                    margin:8px 0 15px;
                "
            >


            <label>
                Alasan Lembur
            </label>

            <textarea
                name="reason"
                rows="5"
                required
                style="
                    width:100%;
                    padding:12px;
                    margin:8px 0 15px;
                "
            >{{ old('reason') }}</textarea>


            <label>
                Lampiran
            </label>

            <input
                type="file"
                name="attachment"
                accept=".jpg,.jpeg,.png,.pdf"
                style="
                    width:100%;
                    padding:12px;
                    margin:8px 0 20px;
                "
            >


            <button
                type="submit"
                class="btn-primary"
            >
                Kirim Pengajuan
            </button>


            <a
                href="{{ route('employee.overtime-requests.index') }}"
                class="btn-primary"
            >
                Kembali
            </a>

        </form>

    </div>

</div>

@endsection