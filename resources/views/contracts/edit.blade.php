@extends('layouts.app')

@section('title', 'Edit Kontrak')

@section('content')

<div class="container">

    <div class="card">

        <h1 style="color:#8B1E1E;">
            Edit Kontrak
        </h1>

        <p>
            Karyawan:
            <strong>
                {{ $employee->full_name }}
            </strong>
        </p>

        <form
            action="{{ route(
                'employees.contracts.update',
                [
                    $employee,
                    $contract
                ]
            ) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf
            @method('PUT')


            <label>
                Nama Kontrak
            </label>

            <input
                type="text"
                name="contract_name"
                value="{{ old(
                    'contract_name',
                    $contract->contract_name
                ) }}"
                required
                style="
                    width:100%;
                    padding:12px;
                    margin:8px 0 15px;
                "
            >


            <label>
                File Kontrak Saat Ini
            </label>

            <p style="margin:10px 0 20px;">

                <a
                    href="{{ asset(
                        'storage/' .
                        $contract->file_path
                    ) }}"
                    target="_blank"
                    style="color:#A8662A;"
                >
                    Lihat Kontrak
                </a>

            </p>


            <label>
                Ganti File Kontrak
            </label>

            <input
                type="file"
                name="file"
                accept=".pdf,.doc,.docx"
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
                    Update Kontrak
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