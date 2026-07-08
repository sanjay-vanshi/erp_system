<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;

class DashboardController extends Controller
{
    public function index()
    {
        // ======================
        // BASIC COUNTS
        // ======================
        $totalDepartments = Department::count();
        $totalDesignations = Designation::count();
        $totalEmployees = Employee::count();

        $activeEmployees = Employee::where('status', 'active')->count();
        $inactiveEmployees = Employee::where('status', 'inactive')->count();

        // ======================
        // RECENT EMPLOYEES
        // ======================
        $recentEmployees = Employee::with(['department', 'designation'])
            ->latest()
            ->take(5)
            ->get();

        // ======================
        // DEPARTMENT WISE EMPLOYEES (BAR CHART)
        // ======================
        $departmentWiseEmployees = Department::withCount('employees')
            ->orderBy('employees_count', 'desc')
            ->get();

        // ======================
        // EMPLOYEE JOINING TREND (LINE CHART)
        // ======================
        $employeeTrend = Employee::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->whereNotNull('created_at')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        return view('dashboard.index', compact(
            'totalDepartments',
            'totalDesignations',
            'totalEmployees',
            'activeEmployees',
            'inactiveEmployees',
            'recentEmployees',
            'departmentWiseEmployees',
            'employeeTrend'
        ));
    }
}
