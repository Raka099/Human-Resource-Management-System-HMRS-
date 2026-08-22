@extends('layouts.app')

@section('title', 'Tambah Pelamar')

@section('content')

<div class="container">

    <div class="card">

        <h1 style="color:#8B1E1E;">
            Tambah Pelamar
        </h1>

        <p style="margin-top:5px; margin-bottom:25px;">
            Masukkan data pelamar dan upload CV.
        </p>

        <form
            action="{{ route('applicants.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf


            <label>
                Nomor Lamaran
            </label>

            <input
                type="text"
                name="application_number"
                value="{{ old('application_number') }}"
                required
                style="
                    width:100%;
                    padding:12px;
                    margin:8px 0 15px;
                "
            >

            @error('application_number')
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
                CV
            </label>

            <input
                type="file"
                name="cv_file"
                accept=".pdf,.doc,.docx"
                required
                style="
                    width:100%;
                    padding:12px;
                    margin:8px 0 20px;
                "
            >

            <small>
                Format: PDF, DOC, DOCX. Maksimal 5 MB.
            </small>

            @error('cv_file')
                <p style="color:#D5322F;">
                    {{ $message }}
                </p>
            @enderror


            <div style="margin-top:20px;">

                <button
                    type="submit"
                    class="btn-primary"
                >
                    Simpan Pelamar
                </button>

                <a
                    href="{{ route('applicants.index') }}"
                    class="btn-primary"
                >
                    Kembali
                </a>

            </div>

        </form>

    </div>

</div>

@endsection