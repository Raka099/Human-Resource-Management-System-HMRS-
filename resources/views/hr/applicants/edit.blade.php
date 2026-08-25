@extends('layouts.app')

@section('title', 'Edit Pelamar')

@section('content')

<div class="container">

    <div class="card">

        <h1 style="color:#8B1E1E;">
            Edit Pelamar
        </h1>

        <p style="margin-top:5px; margin-bottom:25px;">
            Perbarui data pelamar.
        </p>

        <form
            action="{{ route(
                'applicants.update',
                $applicant
            ) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf
            @method('PUT')


            <label>
                Nomor Lamaran
            </label>

            <input
                type="text"
                name="application_number"
                value="{{ old(
                    'application_number',
                    $applicant->application_number
                ) }}"
                required
                style="
                    width:100%;
                    padding:12px;
                    margin:8px 0 15px;
                "
            >


            <label>
                Nama Lengkap
            </label>

            <input
                type="text"
                name="full_name"
                value="{{ old(
                    'full_name',
                    $applicant->full_name
                ) }}"
                required
                style="
                    width:100%;
                    padding:12px;
                    margin:8px 0 15px;
                "
            >


            <label>
                Email
            </label>

            <input
                type="email"
                name="email"
                value="{{ old(
                    'email',
                    $applicant->email
                ) }}"
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
                value="{{ old(
                    'phone',
                    $applicant->phone
                ) }}"
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
            >{{ old(
                'address',
                $applicant->address
            ) }}</textarea>


            <label>
                CV Saat Ini
            </label>

            @if($applicant->cv_file)

                <p style="margin:10px 0;">

                    <a
                        href="{{ asset(
                            'storage/' .
                            $applicant->cv_file
                        ) }}"
                        target="_blank"
                        style="color:#A8662A;"
                    >
                        Lihat CV
                    </a>

                </p>

            @else

                <p>
                    Belum ada CV.
                </p>

            @endif


            <label>
                Ganti CV
            </label>

            <input
                type="file"
                name="cv_file"
                accept=".pdf,.doc,.docx"
                style="
                    width:100%;
                    padding:12px;
                    margin:8px 0 20px;
                "
            >

            <small>
                Kosongkan jika tidak ingin mengganti CV.
            </small>


            <div style="margin-top:20px;">

                <button
                    type="submit"
                    class="btn-primary"
                >
                    Update Pelamar
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