@extends('layouts.app')

@section('title', 'Edit Dokumen')

@section('content')

<div class="container">

    <div class="card">

        <h1 style="color:#8B1E1E;">
            Edit Dokumen
        </h1>

        <p>
            Karyawan:
            <strong>
                {{ $employee->full_name }}
            </strong>
        </p>

        <form
            action="{{ route(
                'employees.documents.update',
                [
                    $employee,
                    $document
                ]
            ) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf
            @method('PUT')


            <label>
                Nama Dokumen
            </label>

            <input
                type="text"
                name="document_name"
                value="{{ old(
                    'document_name',
                    $document->document_name
                ) }}"
                required
                style="
                    width:100%;
                    padding:12px;
                    margin:8px 0 15px;
                "
            >


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

                @foreach([
                    'KTP',
                    'KK',
                    'Ijazah',
                    'Sertifikat',
                    'Lainnya'
                ] as $type)

                    <option
                        value="{{ $type }}"
                        @selected(
                            $document->document_type === $type
                        )
                    >
                        {{ $type }}
                    </option>

                @endforeach

            </select>


            <label>
                File Saat Ini
            </label>

            <p style="margin:10px 0 20px;">

                <a
                    href="{{ asset(
                        'storage/' .
                        $document->file_path
                    ) }}"
                    target="_blank"
                    style="color:#A8662A;"
                >
                    Lihat File
                </a>

            </p>


            <label>
                Ganti File
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
                style="
                    width:100%;
                    padding:12px;
                    margin:8px 0 10px;
                "
            >

            <small>
                Kosongkan jika tidak ingin mengganti file.
            </small>


            <div style="margin-top:25px;">

                <button
                    type="submit"
                    class="btn-primary"
                >
                    Update Dokumen
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