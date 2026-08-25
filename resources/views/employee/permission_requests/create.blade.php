@extends('layouts.app')

@section('title', 'Ajukan Izin')

@section('content')

<div class="container">

    <div class="card">

        <h1 style="color:#8B1E1E;">
            Ajukan Izin
        </h1>

        @if ($errors->any())

            <div style="
                background:#FDECEC;
                color:#8B1E1E;
                padding:15px;
                margin-bottom:20px;
                border-radius:8px;
            ">

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>

        @endif


        <form
            action="{{ route('employee.permission-requests.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf


            <label>
                Jenis Izin
            </label>

            <select
                name="permission_type"
                required
                style="
                    width:100%;
                    padding:12px;
                    margin:8px 0 15px;
                "
            >

                <option value="">
                    -- Pilih Jenis Izin --
                </option>

                <option value="Sakit">
                    Sakit
                </option>

                <option value="Keperluan Pribadi">
                    Keperluan Pribadi
                </option>

                <option value="Keperluan Keluarga">
                    Keperluan Keluarga
                </option>

                <option value="Lainnya">
                    Lainnya
                </option>

            </select>


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


            <label>
                Alasan
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
                href="{{ route('employee.permission-requests.index') }}"
                class="btn-primary"
            >
                Kembali
            </a>

        </form>

    </div>

</div>

@endsection