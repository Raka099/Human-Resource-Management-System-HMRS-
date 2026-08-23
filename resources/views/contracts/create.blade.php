@extends('layouts.app')

@section('title', 'Upload Kontrak')

@section('content')

<div class="container">

    <div class="card">

        <h1 style="color:#8B1E1E;">
            Upload Kontrak
        </h1>

        <p>
            Karyawan:
            <strong>
                {{ $employee->full_name }}
            </strong>
        </p>

        <form
            action="{{ route(
                'employees.contracts.store',
                $employee
            ) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf


            <label>
                Nama Kontrak
            </label>

            <input
                type="text"
                name="contract_name"
                value="{{ old('contract_name') }}"
                placeholder="Contoh: Kontrak Kerja 2026"
                required
                style="
                    width:100%;
                    padding:12px;
                    margin:8px 0 15px;
                "
            >

            @error('contract_name')

                <p style="color:#D5322F;">
                    {{ $message }}
                </p>

            @enderror


            <label>
                File Kontrak
            </label>

            <input
                type="file"
                name="file"
                accept=".pdf,.doc,.docx"
                required
                style="
                    width:100%;
                    padding:12px;
                    margin:8px 0 10px;
                "
            >

            <small>
                Format PDF, DOC, DOCX. Maksimal 5 MB.
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
                    Upload Kontrak
                </button>

                <a
                    href="{{ route(
                        'employees.contracts.index',
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