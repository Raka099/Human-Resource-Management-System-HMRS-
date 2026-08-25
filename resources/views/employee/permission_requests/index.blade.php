@extends('layouts.app')

@section('title', 'Pengajuan Izin')

@section('content')

<div class="container">

    <div class="card">

        <div style="
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:20px;
        ">

            <h1 style="color:#8B1E1E;">
                Pengajuan Izin
            </h1>

            <a
                href="{{ route('employee.permission-requests.create') }}"
                class="btn-primary"
            >
                + Ajukan Izin
            </a>

        </div>


        @if(session('success'))

            <div style="
                background:#F4D66D;
                color:#8B1E1E;
                padding:12px;
                margin-bottom:20px;
                border-radius:8px;
            ">
                {{ session('success') }}
            </div>

        @endif


        <table
            style="
                width:100%;
                border-collapse:collapse;
            "
        >

            <thead>

                <tr style="
                    background:#8B1E1E;
                    color:#FAF8F5;
                ">

                    <th style="padding:12px;">
                        Jenis Izin
                    </th>

                    <th style="padding:12px;">
                        Mulai
                    </th>

                    <th style="padding:12px;">
                        Selesai
                    </th>

                    <th style="padding:12px;">
                        Alasan
                    </th>

                    <th style="padding:12px;">
                        Status
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($permissionRequests as $permission)

                    <tr>

                        <td style="padding:12px;">
                            {{ $permission->permission_type }}
                        </td>

                        <td style="padding:12px;">
                            {{ $permission->start_date->format('d/m/Y') }}
                        </td>

                        <td style="padding:12px;">
                            {{ $permission->end_date->format('d/m/Y') }}
                        </td>

                        <td style="padding:12px;">
                            {{ $permission->reason }}
                        </td>

                        <td style="padding:12px;">

                            @if($permission->status === 'Pending')

                                <span style="color:#A8662A;">
                                    Pending
                                </span>

                            @elseif($permission->status === 'Approved')

                                <span style="color:#2E7D32;">
                                    Approved
                                </span>

                            @else

                                <span style="color:#D5322F;">
                                    Rejected
                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="5"
                            style="
                                text-align:center;
                                padding:30px;
                            "
                        >
                            Belum ada pengajuan izin.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection