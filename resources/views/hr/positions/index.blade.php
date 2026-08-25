@extends('layouts.app')

@section('title', 'Position')

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
                    Position
                </h1>

                <p style="margin-top: 5px;">
                    Kelola data jabatan perusahaan.
                </p>
            </div>

            <a
                href="{{ route('positions.create') }}"
                class="btn-primary"
            >
                + Tambah Position
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
                        Position
                    </th>

                    <th style="padding: 12px; text-align: left;">
                        Aksi
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($positions as $position)

                    <tr style="border-bottom: 1px solid #ddd;">

                        <td style="padding: 12px;">
                            {{ $loop->iteration }}
                        </td>

                        <td style="padding: 12px;">
                            {{ $position->position_name }}
                        </td>

                        <td style="padding: 12px;">

                            <a
                                href="{{ route('positions.edit', $position) }}"
                                class="btn-primary"
                            >
                                Edit
                            </a>

                            <form
                                action="{{ route('positions.destroy', $position) }}"
                                method="POST"
                                style="display:inline;"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn-primary"
                                    onclick="return confirm('Hapus position ini?')"
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
                            Belum ada position.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection