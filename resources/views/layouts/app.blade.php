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

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #FAF8F5;
            color: #222;
        }

        /* =====================================================
           NAVBAR
        ====================================================== */

        .navbar {
            height: 85px;
            background: #8B1E1E;
            color: white;

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 0 35px;

            position: sticky;
            top: 0;

            z-index: 1000;

            box-shadow:
                0 2px 10px rgba(0,0,0,0.15);
        }

        .navbar-brand {
            font-size: 26px;
            font-weight: bold;
        }

        .navbar-user {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .navbar-user-name {
            font-weight: bold;
        }

        .navbar-role {
            font-size: 14px;
        }

        /* =====================================================
           LOGOUT
        ====================================================== */

        .btn-logout {
            background: #D5322F;
            color: white;

            border: none;
            border-radius: 8px;

            padding: 10px 18px;

            font-size: 15px;

            cursor: pointer;
        }

        .btn-logout:hover {
            background: #A8662A;
        }

        /* =====================================================
           LAYOUT
        ====================================================== */

        .dashboard-wrapper {
            display: flex;
            min-height: calc(100vh - 85px);
        }

        /* =====================================================
           SIDEBAR
        ====================================================== */

        .sidebar {
            width: 245px;

            background: white;

            border-right: 1px solid #eee;

            padding: 25px 15px;

            position: sticky;
            top: 85px;

            height: calc(100vh - 85px);

            overflow-y: auto;
        }

        .sidebar-title {
            font-size: 13px;
            font-weight: bold;

            color: #A8662A;

            padding: 0 12px;

            margin-bottom: 12px;

            text-transform: uppercase;
        }

        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .sidebar-menu a {
            text-decoration: none;

            color: #333;

            padding: 12px 14px;

            border-radius: 8px;

            transition: 0.2s;
        }

        .sidebar-menu a:hover {
            background: #FAF8F5;
            color: #8B1E1E;
        }

        .sidebar-menu a.active {
            background: #8B1E1E;
            color: white;
        }

        /* =====================================================
           SIDEBAR SECTION
        ====================================================== */

        .sidebar-section {
            margin-top: 25px;
            margin-bottom: 8px;

            padding: 0 12px;

            font-size: 12px;
            font-weight: bold;

            color: #A8662A;

            text-transform: uppercase;
        }

        /* =====================================================
           CONTENT
        ====================================================== */

        .main-content {
            flex: 1;

            padding: 30px;

            min-width: 0;
        }

        /* =====================================================
           CONTAINER
        ====================================================== */

        .container {
            max-width: 1400px;
            margin: auto;
        }

        /* =====================================================
           CARD
        ====================================================== */

        .card {
            background: white;

            border-radius: 14px;

            padding: 25px;

            box-shadow:
                0 4px 15px rgba(0,0,0,0.06);
        }

        /* =====================================================
           BUTTON
        ====================================================== */

        .btn-primary {
            display: inline-block;

            background: #D5322F;
            color: white;

            text-decoration: none;

            border: none;

            padding: 10px 18px;

            border-radius: 7px;

            cursor: pointer;
        }

        .btn-primary:hover {
            background: #8B1E1E;
        }

        /* =====================================================
           STATISTIC CARD
        ====================================================== */

        .stat-grid {
            display: grid;

            grid-template-columns:
                repeat(4, 1fr);

            gap: 20px;

            margin-top: 25px;
        }

        .stat-card {
            background: white;

            border-radius: 14px;

            padding: 22px;

            box-shadow:
                0 4px 15px rgba(0,0,0,0.06);

            border-left: 5px solid #8B1E1E;
        }

        .stat-title {
            color: #777;
            font-size: 14px;
        }

        .stat-number {
            color: #8B1E1E;

            font-size: 32px;

            font-weight: bold;

            margin-top: 8px;
        }

        /* =====================================================
           GRAPH
        ====================================================== */

        .chart-grid {
            display: grid;

            grid-template-columns:
                2fr 1fr;

            gap: 20px;

            margin-top: 25px;
        }

        .chart-card {
            background: white;

            border-radius: 14px;

            padding: 25px;

            box-shadow:
                0 4px 15px rgba(0,0,0,0.06);
        }

        .chart-title {
            color: #8B1E1E;

            font-size: 19px;

            font-weight: bold;

            margin-bottom: 20px;
        }

        .chart-container {
            position: relative;

            height: 300px;
        }

        /* =====================================================
           RESPONSIVE
        ====================================================== */

        @media (max-width: 1000px) {

            .stat-grid {
                grid-template-columns:
                    repeat(2, 1fr);
            }

            .chart-grid {
                grid-template-columns: 1fr;
            }

        }

        @media (max-width: 700px) {

            .sidebar {
                width: 200px;
            }

            .stat-grid {
                grid-template-columns: 1fr;
            }

            .navbar {
                padding: 0 15px;
            }

            .navbar-role {
                display: none;
            }

            .main-content {
                padding: 20px;
            }

        }

    </style>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>

{{-- =========================================================
    NAVBAR
========================================================= --}}

<nav class="navbar">

    <div class="navbar-brand">
        HRMS
    </div>

    @auth

        <div class="navbar-user">

            <span class="navbar-user-name">
                {{ auth()->user()->name }}
            </span>

            <span class="navbar-role">
                {{ auth()->user()->role->role_name }}
            </span>

            <form
                method="POST"
                action="{{ route('logout') }}"
            >

                @csrf

                <button
                    type="submit"
                    class="btn-logout"
                >
                    Logout
                </button>

            </form>

        </div>

    @endauth

</nav>


{{-- =========================================================
    DASHBOARD WRAPPER
========================================================= --}}

@auth

<div class="dashboard-wrapper">

    {{-- =====================================================
         SIDEBAR
    ====================================================== --}}

    <aside class="sidebar">

        <div class="sidebar-title">
            Menu HRMS
        </div>

        <div class="sidebar-menu">

            {{-- =================================================
                 DASHBOARD
            ================================================== --}}

            <a href="{{ route('dashboard') }}">
                Dashboard
            </a>


            {{-- =================================================
                 ROLE HR
            ================================================== --}}

            @if(auth()->user()->role->role_name === 'HR')

                <div class="sidebar-section">
                    Master Data
                </div>

                <a href="{{ route('departments.index') }}">
                    Department
                </a>

                <a href="{{ route('positions.index') }}">
                    Position
                </a>

                <a href="{{ route('employees.index') }}">
                    Data Karyawan
                </a>

                <a href="{{ route('applicants.index') }}">
                    Data Pelamar
                </a>

                <div class="sidebar-section">
                    Approval
                </div>

                <a href="{{ route('hr.approvals.index') }}">
                    Approval Pengajuan
                </a>

                <div class="sidebar-section">
                    Laporan
                </div>

                <a href="{{ route('reports.employees.index') }}">
                    Laporan Karyawan
                </a>

                <a href="{{ route('reports.leave.index') }}">
                    Pengajuan Cuti
                </a>

                <a href="{{ route('reports.permission.index') }}">
                    Pengajuan Izin
                </a>

                <a href="{{ route('reports.overtime.index') }}">
                    Pengajuan Lembur
                </a>


            {{-- =================================================
                 ROLE MANAGER
            ================================================== --}}

            @elseif(auth()->user()->role->role_name === 'Manager')

                <div class="sidebar-section">
                    Approval
                </div>

                <a href="{{ route('manager.approvals.index') }}">
                    Approval Pengajuan
                </a>

                <div class="sidebar-section">
                    Data & Laporan
                </div>

                <a href="{{ route('manager.employees.index') }}">
                    Data Karyawan
                </a>

                {{-- <div class="sidebar-section">
                    Laporan
                </div>

                <a href="{{ route('manager.employees.export') }}">
                    Generate Excel Karyawan
                </a> --}}


            {{-- =================================================
                 ROLE KARYAWAN
            ================================================== --}}

            @elseif(auth()->user()->role->role_name === 'Karyawan')

                <div class="sidebar-section">
                    Pengajuan
                </div>

                <a href="{{ route('employee.leave-requests.index') }}">
                    Pengajuan Cuti
                </a>

                <a href="{{ route('employee.permission-requests.index') }}">
                    Pengajuan Izin
                </a>

                <a href="{{ route('employee.overtime-requests.index') }}">
                    Pengajuan Lembur
                </a>


                <div class="sidebar-section">
                    Akun
                </div>

                @if(Route::has('profile.edit'))

                    <a href="{{ route('profile.edit') }}">
                        Profil
                    </a>

                @endif

            @endif

        </div>

    </aside>


    {{-- =====================================================
         MAIN CONTENT
    ====================================================== --}}

    <main class="main-content">

        @yield('content')

    </main>

</div>

@else

    @yield('content')

@endauth

</body>

</html>