@extends('layouts.app')

@section('title', 'Pengajuan Cuti')

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
                    Pengajuan Cuti
                </h1>

                <p>
                    {{ $employee->employee_number }}
                    -
                    {{ $employee->full_name }}
                </p>

            </div>

            <a
                href="{{ route('leave-requests.create') }}"
                class="btn-primary"
            >
                + Ajukan Cuti
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

                    @forelse(
                        $leaveRequests
                        as $leave
                    )

                        <tr style="
                            border-bottom:1px solid #ddd;
                        ">

                            <td style="padding:12px;">
                                {{ $loop->iteration }}
                            </td>

                            <td style="padding:12px;">
                                {{
                                    $leave->start_date
                                        ->format('d-m-Y')
                                }}
                            </td>

                            <td style="padding:12px;">
                                {{
                                    $leave->end_date
                                        ->format('d-m-Y')
                                }}
                            </td>

                            <td style="padding:12px;">
                                {{ $leave->reason }}
                            </td>

                            <td style="padding:12px;">

                                @if(
                                    $leave->status === 'Pending'
                                )

                                    <span style="
                                        background:#F4D66D;
                                        padding:6px 10px;
                                        border-radius:6px;
                                    ">
                                        Pending
                                    </span>

                                @elseif(
                                    $leave->status === 'Approved'
                                )

                                    <span style="
                                        background:#8B1E1E;
                                        color:white;
                                        padding:6px 10px;
                                        border-radius:6px;
                                    ">
                                        Approved
                                    </span>

                                @else

                                    <span style="
                                        background:#D5322F;
                                        color:white;
                                        padding:6px 10px;
                                        border-radius:6px;
                                    ">
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
                                    padding:20px;
                                "
                            >
                                Belum ada pengajuan cuti.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection