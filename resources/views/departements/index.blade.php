@extends('layouts.app')

@section('title', 'Department')

@section('content')

<div class="container">

    <div class="card">

        <div style="
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        ">

            <div>
                <h1 style="color: #8B1E1E;">
                    Department
                </h1>

                <p style="margin-top: 5px;">
                    Kelola data department perusahaan.
                </p>
            </div>

            <a
                href="{{ route('departments.create') }}"
                class="btn-primary"
            >
                + Tambah Department
            </a>

        </div>

        @if(session('success'))

            <div style="
                background: #F4D66D;
                padding: 12px;
                border-radius: 8px;
                margin-bottom: 20px;
            ">
                {{ session('success') }}
            </div>

        @endif

        <table style="
            width: 100%;
            border-collapse: collapse;
        ">

            <thead>

                <tr style="
                    background: #8B1E1E;
                    color: white;
                ">

                    <th style="padding: 12px; text-align: left;">
                        No
                    </th>

                    <th style="padding: 12px; text-align: left;">
                        Department
                    </th>

                    <th style="padding: 12px; text-align: left;">
                        Aksi
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($departments as $department)

                    <tr style="border-bottom: 1px solid #ddd;">

                        <td style="padding: 12px;">
                            {{ $loop->iteration }}
                        </td>

                        <td style="padding: 12px;">
                            {{ $department->department_name }}
                        </td>

                        <td style="padding: 12px;">

                            <a
                                href="{{ route('departments.edit', $department) }}"
                                class="btn-primary"
                            >
                                Edit
                            </a>

                            <form
                                action="{{ route('departments.destroy', $department) }}"
                                method="POST"
                                style="display:inline;"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn-primary"
                                    onclick="return confirm('Hapus department ini?')"
                                >
                                    Hapus
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="3"
                            style="
                                padding: 20px;
                                text-align: center;
                            "
                        >
                            Belum ada department.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection