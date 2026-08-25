@extends('layouts.app')

@section('title', 'Approval Pengajuan')

@section('content')

<div class="container">

    <div class="card">

        <h1 style="color:#8B1E1E;">
            Approval Pengajuan
        </h1>

        <p style="margin-top:10px;">
            Kelola pengajuan karyawan yang menunggu persetujuan.
        </p>


        {{-- SUCCESS MESSAGE --}}

        @if(session('success'))

            <div style="
                background:#F4D66D;
                color:#8B1E1E;
                padding:12px;
                margin:20px 0;
                border-radius:8px;
            ">
                {{ session('success') }}
            </div>

        @endif


        {{-- ERROR MESSAGE --}}

        @if($errors->any())

            <div style="
                background:#FDECEC;
                color:#D5322F;
                padding:12px;
                margin:20px 0;
                border-radius:8px;
            ">

                @foreach($errors->all() as $error)

                    <p style="margin:0;">
                        {{ $error }}
                    </p>

                @endforeach

            </div>

        @endif


        {{-- ================================================= --}}
        {{-- PENGAJUAN CUTI --}}
        {{-- ================================================= --}}

        <h2 style="
            color:#8B1E1E;
            margin-top:30px;
        ">
            Pengajuan Cuti
        </h2>

        @forelse($leaveRequests as $leave)

            <div style="
                border:1px solid #ddd;
                padding:20px;
                margin-top:15px;
                border-radius:8px;
            ">

                <strong>
                    {{ $leave->employee->full_name }}
                </strong>

                <p>
                    Tanggal:
                    {{ $leave->start_date }}
                    -
                    {{ $leave->end_date }}
                </p>

                <p>
                    Alasan:
                    {{ $leave->reason }}
                </p>


                <form
                    action="{{ route(
                        'manager.approvals.leave',
                        $leave
                    ) }}"
                    method="POST"
                >

                    @csrf
                    @method('PATCH')


                    <textarea
                        name="manager_note"
                        placeholder="Catatan Manager"
                        rows="3"
                        style="
                            width:100%;
                            padding:10px;
                            margin:10px 0;
                        "
                    ></textarea>


                    <button
                        type="submit"
                        name="action"
                        value="Approved"
                        class="btn-primary"
                    >
                        Approve
                    </button>


                    <button
                        type="submit"
                        name="action"
                        value="Rejected"
                        style="
                            background:#D5322F;
                            color:white;
                            border:none;
                            padding:10px 15px;
                            border-radius:5px;
                            cursor:pointer;
                        "
                    >
                        Reject
                    </button>

                </form>

            </div>

        @empty

            <p style="margin-top:15px;">
                Tidak ada pengajuan cuti.
            </p>

        @endforelse


        {{-- ================================================= --}}
        {{-- PENGAJUAN IZIN --}}
        {{-- ================================================= --}}

        <h2 style="
            color:#8B1E1E;
            margin-top:40px;
        ">
            Pengajuan Izin
        </h2>

        @forelse($permissionRequests as $permission)

            <div style="
                border:1px solid #ddd;
                padding:20px;
                margin-top:15px;
                border-radius:8px;
            ">

                <strong>
                    {{ $permission->employee->full_name }}
                </strong>

                <p>
                    Jenis Izin:
                    {{ $permission->permission_type }}
                </p>

                <p>
                    Tanggal:
                    {{ $permission->start_date }}
                    -
                    {{ $permission->end_date }}
                </p>

                <p>
                    Alasan:
                    {{ $permission->reason }}
                </p>


                <form
                    action="{{ route(
                        'manager.approvals.permission',
                        $permission
                    ) }}"
                    method="POST"
                >

                    @csrf
                    @method('PATCH')


                    <textarea
                        name="manager_note"
                        placeholder="Catatan Manager"
                        rows="3"
                        style="
                            width:100%;
                            padding:10px;
                            margin:10px 0;
                        "
                    ></textarea>


                    <button
                        type="submit"
                        name="action"
                        value="Approved"
                        class="btn-primary"
                    >
                        Approve
                    </button>


                    <button
                        type="submit"
                        name="action"
                        value="Rejected"
                        style="
                            background:#D5322F;
                            color:white;
                            border:none;
                            padding:10px 15px;
                            border-radius:5px;
                            cursor:pointer;
                        "
                    >
                        Reject
                    </button>

                </form>

            </div>

        @empty

            <p style="margin-top:15px;">
                Tidak ada pengajuan izin.
            </p>

        @endforelse


        {{-- ================================================= --}}
        {{-- PENGAJUAN LEMBUR --}}
        {{-- ================================================= --}}

        <h2 style="
            color:#8B1E1E;
            margin-top:40px;
        ">
            Pengajuan Lembur
        </h2>

        @forelse($overtimeRequests as $overtime)

            <div style="
                border:1px solid #ddd;
                padding:20px;
                margin-top:15px;
                border-radius:8px;
            ">

                <strong>
                    {{ $overtime->employee->full_name }}
                </strong>

                <p>
                    Tanggal:
                    {{ $overtime->overtime_date->format('d/m/Y') }}
                </p>

                <p>
                    Jam:
                    {{ $overtime->start_time }}
                    -
                    {{ $overtime->end_time }}
                </p>

                <p>
                    Alasan:
                    {{ $overtime->reason }}
                </p>


                <form
                    action="{{ route(
                        'manager.approvals.overtime',
                        $overtime
                    ) }}"
                    method="POST"
                >

                    @csrf
                    @method('PATCH')


                    <textarea
                        name="manager_note"
                        placeholder="Catatan Manager"
                        rows="3"
                        style="
                            width:100%;
                            padding:10px;
                            margin:10px 0;
                        "
                    ></textarea>


                    <button
                        type="submit"
                        name="action"
                        value="Approved"
                        class="btn-primary"
                    >
                        Approve
                    </button>


                    <button
                        type="submit"
                        name="action"
                        value="Rejected"
                        style="
                            background:#D5322F;
                            color:white;
                            border:none;
                            padding:10px 15px;
                            border-radius:5px;
                            cursor:pointer;
                        "
                    >
                        Reject
                    </button>

                </form>

            </div>

        @empty

            <p style="margin-top:15px;">
                Tidak ada pengajuan lembur.
            </p>

        @endforelse

    </div>

</div>

@endsection