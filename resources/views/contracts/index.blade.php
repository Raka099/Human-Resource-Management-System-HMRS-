@extends('layouts.app')

@section('title', 'Kontrak Karyawan')

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
                    Kontrak Karyawan
                </h1>

                <p>
                    {{ $employee->employee_number }}
                    -
                    {{ $employee->full_name }}
                </p>

            </div>

            <a
                href="{{ route(
                    'employees.contracts.create',
                    $employee
                ) }}"
                class="btn-primary"
            >
                + Upload Kontrak
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
                            Nama Kontrak
                        </th>

                        <th style="padding:12px;">
                            Format
                        </th>

                        <th style="padding:12px;">
                            File
                        </th>

                        <th style="padding:12px;">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($employee->contracts as $contract)

                        <tr style="
                            border-bottom:1px solid #ddd;
                        ">

                            <td style="padding:12px;">
                                {{ $loop->iteration }}
                            </td>

                            <td style="padding:12px;">
                                {{ $contract->contract_name }}
                            </td>

                            <td style="padding:12px;">
                                {{ strtoupper(
                                    $contract->file_extension
                                ) }}
                            </td>

                            <td style="padding:12px;">

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

                            </td>

                            <td style="padding:12px;">

                                <a
                                    href="{{ route(
                                        'employees.contracts.edit',
                                        [
                                            $employee,
                                            $contract
                                        ]
                                    ) }}"
                                    class="btn-primary"
                                >
                                    Edit
                                </a>

                                <form
                                    action="{{ route(
                                        'employees.contracts.destroy',
                                        [
                                            $employee,
                                            $contract
                                        ]
                                    ) }}"
                                    method="POST"
                                    style="display:inline;"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn-primary"
                                        onclick="
                                            return confirm(
                                                'Hapus file kontrak ini?'
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
                                colspan="5"
                                style="
                                    text-align:center;
                                    padding:20px;
                                "
                            >
                                Belum ada file kontrak.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        <div style="margin-top:20px;">

            <a
                href="{{ route('employees.index') }}"
                class="btn-primary"
            >
                Kembali ke Karyawan
            </a>

        </div>

    </div>

</div>

@endsection