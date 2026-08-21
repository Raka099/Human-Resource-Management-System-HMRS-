@extends('layouts.app')

@section('title', 'HR Dashboard')

@section('content')

<div class="container">

    <div class="card">

        <h1 style="color: #8B1E1E;">
            HR Dashboard
        </h1>

        <p style="margin-top: 10px;">
            Selamat datang,
            <strong>{{ auth()->user()->name }}</strong>.
        </p>

        <p style="margin-top: 10px;">
            Role:
            <strong>{{ auth()->user()->role->role_name }}</strong>
        </p>

    </div>

</div>

@endsection