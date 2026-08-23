@extends('layouts.app')

@section('title', 'Upload Dokumen')

@section('content')

<div class="container">

    <div class="card">

        <h1 style="color:#8B1E1E;">
            Upload Dokumen
        </h1>

        <p>
            Karyawan:
            <strong>
                {{ $employee->full_name }}
            </strong>
        </p>

        <form
            action="{{ route(
                'employees.documents.store',
                $employee
            ) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf


            <label>
                Nama Dokumen
            </label>

            <input
                type="text"
                name="document_name"
                value="{{ old('document_name') }}"
                placeholder="Contoh: KTP Budi Santoso"
                required
                style="
                    width:100%;
                    padding:12px;
                    margin:8px 0 15px;
                "
            >

            @error('document_name')

                <p style="color:#D5322F;">
                    {{ $message }}
                </p>

            @enderror


            <label>
                Jenis Dokumen
            </label>

            <select
                name="document_type"
                required
                style="
                    width:100%;
                    padding:12px;
                    margin:8px 0 15px;
                "
            >

                <option value="">
                    -- Pilih Jenis --
                </option>

                <option value="KTP">
                    KTP
                </option>

                <option value="KK">
                    KK
                </option>

                <option value="Ijazah">
                    Ijazah
                </option>

                <option value="Sertifikat">
                    Sertifikat
                </option>

                <option value="Lainnya">
                    Lainnya
                </option>

            </select>


            <label>
                File Dokumen
            </label>

            <input
                type="file"
                name="file"
                accept="
                    .pdf,
                    .jpg,
                    .jpeg,
                    .png,
                    .doc,
                    .docx
                "
                required
                style="
                    width:100%;
                    padding:12px;
                    margin:8px 0 10px;
                "
            >

            <small>
                Maksimal 5 MB.
            </small>

            @error('file')

                <p style="color:#D5322F;">
                    {{ $message }}
                </p>

            @enderror


            <div style="margin-top:25px;">

                <button
                    type="submit"
                    class="btn-primary"
                >
                    Upload Dokumen
                </button>

                <a
                    href="{{ route(
                        'employees.documents.index',
                        $employee
                    ) }}"
                    class="btn-primary"
                >
                    Kembali
                </a>

            </div>

        </form>

    </div>

</div>

@endsection