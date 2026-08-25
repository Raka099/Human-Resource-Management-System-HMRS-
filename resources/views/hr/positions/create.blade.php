@extends('layouts.app')

@section('title', 'Tambah Position')

@section('content')

<div class="container">

    <div class="card">

        <h1 style="color: #8B1E1E;">
            Tambah Position
        </h1>

        <form
            action="{{ route('positions.store') }}"
            method="POST"
            style="margin-top: 25px;"
        >

            @csrf

            <label>
                Nama Position
            </label>

            <input
                type="text"
                name="position_name"
                value="{{ old('position_name') }}"
                required
                style="
                    width: 100%;
                    padding: 12px;
                    margin-top: 8px;
                    margin-bottom: 10px;
                    border: 1px solid #ccc;
                    border-radius: 7px;
                "
            >

            @error('position_name')
                <p style="color: #D5322F;">
                    {{ $message }}
                </p>
            @enderror

            <div style="margin-top: 20px;">

                <button
                    type="submit"
                    class="btn-primary"
                >
                    Simpan
                </button>

                <a
                    href="{{ route('positions.index') }}"
                    class="btn-primary"
                >
                    Kembali
                </a>

            </div>

        </form>

    </div>

</div>

@endsection