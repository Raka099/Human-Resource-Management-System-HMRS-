<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'HRMS')
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>

        :root {
            --primary: #8B1E1E;
            --danger: #D5322F;
            --background: #FAF8F5;
            --warning: #F4D66D;
            --secondary: #A8662A;
            --text: #333333;
            --white: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: var(--background);
            color: var(--text);
        }

        .navbar {
            height: 70px;
            background: var(--primary);
            color: var(--white);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
        }

        .brand {
            font-size: 22px;
            font-weight: bold;
        }

        .navbar-user {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .navbar-user span {
            font-size: 14px;
        }

        .logout-button {
            background: var(--danger);
            color: white;
            border: none;
            padding: 8px 14px;
            border-radius: 6px;
            cursor: pointer;
        }

        .logout-button:hover {
            background: var(--secondary);
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 30px auto;
        }

        .card {
            background: var(--white);
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, .08);
        }

        .btn-primary {
            display: inline-block;
            background: var(--danger);
            color: var(--white);
            padding: 10px 18px;
            border-radius: 7px;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .btn-primary:hover {
            background: var(--primary);
        }

    </style>

    @stack('styles')

</head>

<body>

    <nav class="navbar">

        <div class="brand">
            HRMS
        </div>

        @auth

            <div class="navbar-user">

                <span>
                    {{ auth()->user()->name }}
                </span>

                <span>
                    {{ auth()->user()->role?->role_name }}
                </span>

                <form
                    method="POST"
                    action="{{ route('logout') }}"
                >

                    @csrf

                    <button
                        type="submit"
                        class="logout-button"
                    >
                        Logout
                    </button>

                </form>

            </div>

        @endauth

    </nav>

    <main>

        @yield('content')

    </main>

    @stack('scripts')

</body>

</html>