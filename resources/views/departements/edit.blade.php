@extends('layouts.app')

@section('title', 'Edit Department')

@section('content')

<div class="container">

    <div class="card">

        <h1 style="color: #8B1E1E;">
            Edit Department
        </h1>

        <form
            action="{{ route('departments.update', $department) }}"
            method="POST"
            style="margin-top: 25px;"
        >

            @csrf
            @method('PUT')

            <label>
                Nama Department
            </label>

            <input
                type="text"
                name="department_name"
                value="{{ old('department_name', $department->department_name) }}"
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

            @error('department_name')

                <p style="color: #D5322F;">
                    {{ $message }}
                </p>

            @enderror

            <div style="margin-top: 20px;">

                <button
                    type="submit"
                    class="btn-primary"
                >
                    Update
                </button>

                <a
                    href="{{ route('departments.index') }}"
                    class="btn-primary"
                >
                    Kembali
                </a>

            </div>

        </form>

    </div>

</div>

@endsection