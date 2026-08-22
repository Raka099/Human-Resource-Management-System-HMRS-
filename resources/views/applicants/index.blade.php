@extends('layouts.app')

@section('title', 'Data Pelamar')

@section('content')

<div class="container">

    <div class="card">

        <div style="
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:20px;
        ">

            <div>
                <h1 style="color:#8B1E1E;">
                    Data Pelamar
                </h1>

                <p style="margin-top:5px;">
                    Kelola data dan proses seleksi pelamar.
                </p>
            </div>

            <a
                href="{{ route('applicants.create') }}"
                class="btn-primary"
            >
                + Tambah Pelamar
            </a>

        </div>

        @if(session('success'))

            <div style="
                background:#F4D66D;
                padding:12px;
                border-radius:8px;
                margin-bottom:20px;
            ">
                {{ session('success') }}
            </div>

        @endif

        <div style="overflow-x:auto;">

            <table style="
                width:100%;
                border-collapse:collapse;
            ">

                <thead>

                    <tr style="
                        background:#8B1E1E;
                        color:white;
                    ">

                        <th style="padding:12px;">
                            No
                        </th>

                        <th style="padding:12px;">
                            No. Lamaran
                        </th>

                        <th style="padding:12px;">
                            Nama
                        </th>

                        <th style="padding:12px;">
                            Email
                        </th>

                        <th style="padding:12px;">
                            CV
                        </th>

                        <th style="padding:12px;">
                            Status
                        </th>

                        <th style="padding:12px;">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($applicants as $applicant)

                        <tr style="
                            border-bottom:1px solid #ddd;
                        ">

                            <td style="padding:12px;">
                                {{ $loop->iteration }}
                            </td>

                            <td style="padding:12px;">
                                {{ $applicant->application_number }}
                            </td>

                            <td style="padding:12px;">
                                {{ $applicant->full_name }}
                            </td>

                            <td style="padding:12px;">
                                {{ $applicant->email }}
                            </td>

                            <td style="padding:12px;">

                                @if($applicant->cv_file)

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

                                @else

                                    Tidak ada CV

                                @endif

                            </td>

                            <td style="padding:12px;">

                                @if($applicant->status === 'Diterima')

                                    <span style="
                                        background:#F4D66D;
                                        padding:6px 10px;
                                        border-radius:15px;
                                    ">
                                        Diterima
                                    </span>

                                @elseif(
                                    $applicant->status ===
                                    'Tidak Diterima'
                                )

                                    <span style="
                                        background:#D5322F;
                                        color:white;
                                        padding:6px 10px;
                                        border-radius:15px;
                                    ">
                                        Tidak Diterima
                                    </span>

                                @else

                                    <span style="
                                        background:#A8662A;
                                        color:white;
                                        padding:6px 10px;
                                        border-radius:15px;
                                    ">
                                        Proses
                                    </span>

                                @endif

                            </td>

                            <td style="padding:12px;">

                                {{-- Edit --}}

                                <a
                                    href="{{ route(
                                        'applicants.edit',
                                        $applicant
                                    ) }}"
                                    class="btn-primary"
                                >
                                    Edit
                                </a>


                                {{-- Seleksi --}}

                                <form
                                    action="{{ route(
                                        'applicants.update-status',
                                        $applicant
                                    ) }}"
                                    method="POST"
                                    style="
                                        display:inline;
                                    "
                                >

                                    @csrf
                                    @method('PATCH')

                                    <select
                                        name="status"
                                        onchange="
                                            this.form.submit()
                                        "
                                        style="
                                            padding:8px;
                                            border-radius:6px;
                                            border:1px solid #ccc;
                                        "
                                    >

                                        <option
                                            value="Proses"
                                            @selected(
                                                $applicant->status
                                                === 'Proses'
                                            )
                                        >
                                            Proses
                                        </option>

                                        <option
                                            value="Diterima"
                                            @selected(
                                                $applicant->status
                                                === 'Diterima'
                                            )
                                        >
                                            Diterima
                                        </option>

                                        <option
                                            value="Tidak Diterima"
                                            @selected(
                                                $applicant->status
                                                === 'Tidak Diterima'
                                            )
                                        >
                                            Tidak Diterima
                                        </option>

                                    </select>

                                </form>


                                {{-- Hapus --}}

                                <form
                                    action="{{ route(
                                        'applicants.destroy',
                                        $applicant
                                    ) }}"
                                    method="POST"
                                    style="
                                        display:inline;
                                    "
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn-primary"
                                        onclick="
                                            return confirm(
                                                'Hapus pelamar ini?'
                                            )
                                        "
                                    >
                                        Hapus
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="7"
                                style="
                                    padding:20px;
                                    text-align:center;
                                "
                            >
                                Belum ada data pelamar.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection