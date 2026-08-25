@extends('layouts.app')

@section('title', 'Pengajuan Lembur')

@section('content')

<div class="container">

    <div class="card">

        <div style="
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:20px;
            gap:10px;
        ">

            <h1 style="color:#8B1E1E;">
                Pengajuan Lembur
            </h1>

            <a
                href="{{ route('employee.overtime-requests.create') }}"
                class="btn-primary"
            >
                + Ajukan Lembur
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


        <table style="
            width:100%;
            border-collapse:collapse;
        ">

            <thead>

                <tr style="
                    background:#8B1E1E;
                    color:#FAF8F5;
                ">

                    <th style="padding:12px;">
                        Tanggal
                    </th>

                    <th style="padding:12px;">
                        Jam Mulai
                    </th>

                    <th style="padding:12px;">
                        Jam Selesai
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

                @forelse($overtimeRequests as $overtime)

                    <tr>

                        <td style="padding:12px;">
                            {{ $overtime->overtime_date->format('d/m/Y') }}
                        </td>

                        <td style="padding:12px;">
                            {{ \Carbon\Carbon::parse($overtime->start_time)->format('H:i') }}
                        </td>

                        <td style="padding:12px;">
                            {{ \Carbon\Carbon::parse($overtime->end_time)->format('H:i') }}
                        </td>

                        <td style="padding:12px;">
                            {{ $overtime->reason }}
                        </td>

                        <td style="padding:12px;">

                            @if($overtime->status === 'Pending')

                                <span style="color:#A8662A;">
                                    Pending
                                </span>

                            @elseif($overtime->status === 'Approved')

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
                            Belum ada pengajuan lembur.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection