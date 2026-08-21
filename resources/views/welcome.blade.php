<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>HRMS - Human Resource Management System</title>

    <style>
        :root {
            --primary: #8B1E1E;
            --danger: #D5322F;
            --background: #FAF8F5;
            --warning: #F4D66D;
            --secondary: #A8662A;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: var(--background);
            color: #333;
        }

        .navbar {
            background: var(--primary);
            color: white;
            padding: 18px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .brand {
            font-size: 24px;
            font-weight: bold;
        }

        .subtitle {
            font-size: 13px;
            opacity: 0.85;
        }

        .hero {
            min-height: calc(100vh - 70px);
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 40px;
        }

        .hero-content {
            max-width: 700px;
        }

        .hero h1 {
            color: var(--primary);
            font-size: 48px;
            margin-bottom: 15px;
        }

        .hero p {
            font-size: 18px;
            line-height: 1.7;
            margin-bottom: 30px;
        }

        .btn {
            display: inline-block;
            padding: 13px 28px;
            background: var(--danger);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
        }

        .btn:hover {
            background: var(--primary);
        }

        .badge {
            display: inline-block;
            padding: 8px 15px;
            background: var(--warning);
            color: #5c4500;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <nav class="navbar">
        <div>
            <div class="brand">HRMS</div>
            <div class="subtitle">
                Human Resource Management System
            </div>
        </div>
    </nav>

    <main class="hero">

        <div class="hero-content">

            <span class="badge">
                Human Resource Management System
            </span>

            <h1>HRMS</h1>

            <p>
                Sistem informasi berbasis web untuk membantu
                mengintegrasikan pengelolaan administrasi
                sumber daya manusia dalam satu sistem terpusat.
            </p>

            <a href="#" class="btn">
                Mulai Sistem
            </a>

        </div>

    </main>

</body>
</html>