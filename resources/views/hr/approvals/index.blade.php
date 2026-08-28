@extends('layouts.app')

@section('title', 'Approval HR')

@section('content')

<div class="container">

    <div class="card">

        <h1 style="color:#8B1E1E;">
            Approval HR
        </h1>

        <p>
            Pengajuan yang telah disetujui Manager dan menunggu persetujuan HR.
        </p>


        {{-- SUCCESS --}}

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


        {{-- ERROR --}}

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


        {{-- =====================================================
             CUTI
        ====================================================== --}}

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

                <p>
                    <strong>
                        Status Manager:
                    </strong>

                    <span style="
                        background:#A8662A;
                        color:white;
                        padding:5px 10px;
                        border-radius:15px;
                    ">
                        Approved
                    </span>
                </p>


                <form
                    action="{{ route(
                        'hr.approvals.leave',
                        $leave
                    ) }}"
                    method="POST"
                >

                    @csrf
                    @method('PATCH')


                    <textarea
                        name="note"
                        placeholder="Catatan HR"
                        rows="3"
                        style="
                            width:100%;
                            padding:10px;
                            margin:10px 0;
                        "
                    ></textarea>


                    <button
                        type="submit"
                        name="status"
                        value="Approved"
                        class="btn-primary"
                    >
                        Approve
                    </button>


                    <button
                        type="submit"
                        name="status"
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

            <p>
                Tidak ada pengajuan cuti yang menunggu approval HR.
            </p>

        @endforelse



        {{-- =====================================================
             IZIN
        ====================================================== --}}

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

                <p>
                    <strong>Status Manager:</strong>

                    <span style="
                        background:#A8662A;
                        color:white;
                        padding:5px 10px;
                        border-radius:15px;
                    ">
                        Approved
                    </span>
                </p>


                <form
                    action="{{ route(
                        'hr.approvals.permission',
                        $permission
                    ) }}"
                    method="POST"
                >

                    @csrf
                    @method('PATCH')


                    <textarea
                        name="note"
                        placeholder="Catatan HR"
                        rows="3"
                        style="
                            width:100%;
                            padding:10px;
                            margin:10px 0;
                        "
                    ></textarea>


                    <button
                        type="submit"
                        name="status"
                        value="Approved"
                        class="btn-primary"
                    >
                        Approve
                    </button>


                    <button
                        type="submit"
                        name="status"
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

            <p>
                Tidak ada pengajuan izin yang menunggu approval HR.
            </p>

        @endforelse



        {{-- =====================================================
             LEMBUR
        ====================================================== --}}

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

                <p>
                    <strong>Status Manager:</strong>

                    <span style="
                        background:#A8662A;
                        color:white;
                        padding:5px 10px;
                        border-radius:15px;
                    ">
                        Approved
                    </span>
                </p>


                <form
                    action="{{ route(
                        'hr.approvals.overtime',
                        $overtime
                    ) }}"
                    method="POST"
                >

                    @csrf
                    @method('PATCH')


                    <textarea
                        name="note"
                        placeholder="Catatan HR"
                        rows="3"
                        style="
                            width:100%;
                            padding:10px;
                            margin:10px 0;
                        "
                    ></textarea>


                    <button
                        type="submit"
                        name="status"
                        value="Approved"
                        class="btn-primary"
                    >
                        Approve
                    </button>


                    <button
                        type="submit"
                        name="status"
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

            <p>
                Tidak ada pengajuan lembur yang menunggu approval HR.
            </p>

        @endforelse

    </div>

</div>

@endsection