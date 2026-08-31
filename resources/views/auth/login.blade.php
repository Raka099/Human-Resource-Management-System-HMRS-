<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login HRMS</title>

    <link rel="stylesheet" href="{{ asset('css/hrms.css') }}">
</head>

<body class="login-page">

    <div class="login-card">

        {{-- Logo / Brand --}}
        <div class="brand big">
            HR<span>MS</span>
        </div>

        {{-- Judul --}}
        <h1>Selamat Datang</h1>

        <p>
            Masuk untuk mengelola administrasi HR.
        </p>

        {{-- Session Status --}}
        @if (session('status'))
            <div class="alert success">
                {{ session('status') }}
            </div>
        @endif

        {{-- Login Form --}}
        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email --}}
            <div>
                <label for="email">
                    Email
                </label>

                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="username"
                >

                @error('email')
                    <div class="alert error">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Password --}}
            <div>
                <label for="password">
                    Password
                </label>

                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                >

                @error('password')
                    <div class="alert error">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Remember Me --}}
            {{-- <div class="remember-me">
                <label for="remember_me">
                    <input
                        id="remember_me"
                        type="checkbox"
                        name="remember"
                    >

                    <span>
                        Ingat saya
                    </span>
                </label>
            </div> --}}

            {{-- Forgot Password --}}
            @if (Route::has('password.request'))
                <div class="forgot-password">
                    <a href="{{ route('password.request') }}">
                        Lupa password?
                    </a>
                </div>
            @endif

            {{-- Login Button --}}
            <button
                type="submit"
                class="btn primary full"
            >
                Login
            </button>

        </form>

        {{-- Demo Account --}}
        <div class="demo">
            Demo: hr@hrms.test / password
        </div>

    </div>

</body>

</html>
```
