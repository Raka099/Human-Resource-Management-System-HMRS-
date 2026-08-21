<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class DashboardController extends Controller
{
    public function hr(): View
    {
        return view('hr.dashboard');
    }

    public function manager(): View
    {
        return view('manager.dashboard');
    }

    public function employee(): View
    {
        return view('employee.dashboard');
    }
}