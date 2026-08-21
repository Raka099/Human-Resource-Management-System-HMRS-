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

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 30px auto;
        }

        .card {
            background: var(--white);
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,.08);
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

        <div>
            Human Resource Management System
        </div>

    </nav>

    <main>

        @yield('content')

    </main>

    @stack('scripts')

</body>

</html>