<?php

namespace App\Http\Controllers;

use App\Exports\AttendanceReportExport;
use App\Exports\EmployeeReportExport;
use App\Exports\LeaveReportExport;
use App\Exports\PayrollReportExport;
use App\Models\Attendance;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\Leave;
use App\Models\Payroll;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller implements HasMiddleware
{
    //  middleware apply
    public static function middleware(): array
    {
        return [

            new Middleware(
                'permission:view reports',
                only: [
                    'index',
                    'employeeReport',
                    'attendanceReport',
                    'leaveReport',
                    'payrollReport',
                ]
            ),

        ];
    }

    public function index()
    {
        return view('reports.index');

    }

    // payroll query
    private function payrollQuery(Request $request)
    {
        $query = Payroll::with([
            'employee.department',
            'employee.designation',
        ]);

        // Search Employee

        if ($request->search) {

            $query->whereHas('employee', function ($q) use ($request) {

                $q->where('employee_code', 'like', '%'.$request->search.'%')
                    ->orWhere('first_name', 'like', '%'.$request->search.'%')
                    ->orWhere('last_name', 'like', '%'.$request->search.'%');

            });

        }

        // Employee Filter

        if ($request->employee_id) {

            $query->where(
                'employee_id',
                $request->employee_id
            );

        }

        // Payroll Month Filter

        if ($request->payroll_month) {

            $query->whereMonth(
                'payroll_month',
                date('m', strtotime($request->payroll_month))
            )
                ->whereYear(
                    'payroll_month',
                    date('Y', strtotime($request->payroll_month))
                );

        }

        // Payment Status Filter

        if ($request->payment_status) {

            $query->where(
                'payment_status',
                $request->payment_status
            );

        }

        return $query;
    }

    // export payroll pdf

    public function exportPayrollPdf(Request $request)
    {

        $payrolls = $this->payrollQuery($request)
            ->latest('payroll_month')
            ->get();

        $pdf = Pdf::loadView(
            'reports.pdf.payroll',
            compact('payrolls')
        );

        return $pdf->download(
            'payroll-report.pdf'
        );

    }

    private function employeeQuery(Request $request)
    {
        $query = Employee::with([
            'department',
            'designation',
        ]);

        // Search
        if ($request->search) {

            $query->where(function ($q) use ($request) {

                $q->where('employee_code', 'like', '%'.$request->search.'%')
                    ->orWhere('first_name', 'like', '%'.$request->search.'%')
                    ->orWhere('last_name', 'like', '%'.$request->search.'%')
                    ->orWhere('email', 'like', '%'.$request->search.'%');

            });

        }

        // Department Filter
        if ($request->department_id) {

            $query->where('department_id', $request->department_id);

        }

        // Designation Filter
        if ($request->designation_id) {

            $query->where('designation_id', $request->designation_id);

        }

        // Status Filter
        if ($request->status) {

            $query->where('status', $request->status);

        }

        return $query;
    }
    // export employee pdf

    public function exportEmployeePdf(Request $request)
    {
        $employees = $this->employeeQuery($request)
            ->latest()
            ->get();

        $pdf = Pdf::loadView(
            'reports.pdf.employee',
            compact('employees')
        );

        return $pdf->download('employee-report.pdf');
    }

    private function attendanceQuery(Request $request)
    {
        $query = Attendance::with([
            'employee.department',
            'employee.designation',
        ]);

        // Search Employee

        if ($request->search) {

            $query->whereHas('employee', function ($q) use ($request) {

                $q->where('employee_code', 'like', '%'.$request->search.'%')
                    ->orWhere('first_name', 'like', '%'.$request->search.'%')
                    ->orWhere('last_name', 'like', '%'.$request->search.'%');

            });

        }

        // Employee Filter

        if ($request->employee_id) {

            $query->where(
                'employee_id',
                $request->employee_id
            );

        }

        // Attendance Status Filter

        if ($request->status) {

            $query->where(
                'status',
                $request->status
            );

        }

        // Specific Date Filter

        if ($request->attendance_date) {

            $query->whereDate(
                'attendance_date',
                $request->attendance_date
            );

        }

        // Month Filter

        if ($request->month) {

            $query->whereMonth(
                'attendance_date',
                date('m', strtotime($request->month))
            )
                ->whereYear(
                    'attendance_date',
                    date('Y', strtotime($request->month))
                );

        }

        return $query;
    }

    // export attendance pdf

    public function exportAttendancePdf(Request $request)
    {
        $attendances = $this->attendanceQuery($request)
            ->latest('attendance_date')
            ->get();

        $pdf = Pdf::loadView(
            'reports.pdf.attendance',
            compact('attendances')
        );

        return $pdf->download('attendance-report.pdf');
    }
    // export payroll

    public function exportPayroll()
    {
        return Excel::download(
            new PayrollReportExport,
            'payroll-report.xlsx'
        );
    }
    // export leave pdf

    public function exportLeavePdf(Request $request)
    {
        $leaves = $this->leaveQuery($request)
            ->latest()
            ->get();

        $pdf = Pdf::loadView(
            'reports.pdf.leave',
            compact('leaves')
        );

        return $pdf->download('leave-report.pdf');
    }

    private function leaveQuery(Request $request)
    {
        $query = Leave::with([
            'employee.department',
            'employee.designation',
            'approver',
        ]);

        // Search Employee

        if ($request->search) {

            $query->whereHas('employee', function ($q) use ($request) {

                $q->where('employee_code', 'like', '%'.$request->search.'%')
                    ->orWhere('first_name', 'like', '%'.$request->search.'%')
                    ->orWhere('last_name', 'like', '%'.$request->search.'%');

            });

        }

        // Employee Filter

        if ($request->employee_id) {

            $query->where(
                'employee_id',
                $request->employee_id
            );

        }

        // Leave Status Filter

        if ($request->status) {

            $query->where(
                'status',
                $request->status
            );

        }

        // From Date Filter

        if ($request->from_date) {

            $query->whereDate(
                'from_date',
                '>=',
                $request->from_date
            );

        }

        // To Date Filter

        if ($request->to_date) {

            $query->whereDate(
                'to_date',
                '<=',
                $request->to_date
            );

        }

        return $query;
    }

    //   export leavs

    public function exportLeave()
    {
        return Excel::download(
            new LeaveReportExport,
            'leave-report.xlsx'
        );
    }
    // export attendance

    public function exportAttendance(Request $request)
    {
        return Excel::download(
            new AttendanceReportExport($request),
            'attendance-report.xlsx'
        );
    }
    // export employee

    public function exportEmployees(Request $request)
    {
        return Excel::download(
            new EmployeeReportExport($request),
            'employees-report.xlsx'
        );
    }
    // payroll report

    public function payrollReport(Request $request)
    {

        $payrolls = $this->payrollQuery($request)
            ->latest('payroll_month')
            ->paginate(10)
            ->withQueryString();

        $employees = Employee::orderBy('first_name')
            ->get();

        return view(
            'reports.payroll',
            compact(
                'payrolls',
                'employees'
            )
        );

    }

    //  attendance report
    public function attendanceReport(Request $request)
    {

        $query = Attendance::with([
            'employee.department',
            'employee.designation',
        ]);

        // Search Employee

        if ($request->search) {

            $query->whereHas('employee', function ($q) use ($request) {

                $q->where('employee_code', 'like', '%'.$request->search.'%')
                    ->orWhere('first_name', 'like', '%'.$request->search.'%')
                    ->orWhere('last_name', 'like', '%'.$request->search.'%');

            });

        }

        // Employee Filter

        if ($request->employee_id) {

            $query->where(
                'employee_id',
                $request->employee_id
            );

        }

        // Attendance Status Filter

        if ($request->status) {

            $query->where(
                'status',
                $request->status
            );

        }

        // Date Filter

        if ($request->attendance_date) {

            $query->whereDate(
                'attendance_date',
                $request->attendance_date
            );

        }

        // Month Filter

        if ($request->month) {

            $query->whereMonth(
                'attendance_date',
                date('m', strtotime($request->month))
            )
                ->whereYear(
                    'attendance_date',
                    date('Y', strtotime($request->month))
                );

        }

        $attendances = $query
            ->latest('attendance_date')
            ->paginate(10)
            ->withQueryString();

        $employees = Employee::orderBy('first_name')
            ->get();

        return view(
            'reports.attendance',
            compact(
                'attendances',
                'employees'
            )
        );

    }

    // employee report
    public function employeeReport(Request $request)
    {

        $query = Employee::with([
            'department',
            'designation',
        ]);

        // Search Employee

        if ($request->search) {

            $query->where(function ($q) use ($request) {

                $q->where('employee_code', 'like', '%'.$request->search.'%')
                    ->orWhere('first_name', 'like', '%'.$request->search.'%')
                    ->orWhere('last_name', 'like', '%'.$request->search.'%')
                    ->orWhere('email', 'like', '%'.$request->search.'%');

            });

        }

        // Department Filter

        if ($request->department_id) {

            $query->where(
                'department_id',
                $request->department_id
            );

        }

        // Designation Filter

        if ($request->designation_id) {

            $query->where(
                'designation_id',
                $request->designation_id
            );

        }

        // Status Filter

        if ($request->status) {

            $query->where(
                'status',
                $request->status
            );

        }

        $employees = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $departments = Department::orderBy('name')
            ->get();

        $designations = Designation::orderBy('title')
            ->get();

        return view(
            'reports.employee',
            compact(
                'employees',
                'departments',
                'designations'
            )
        );

    }

    // leave report
    public function leaveReport(Request $request)
    {

        $query = Leave::with([
            'employee.department',
            'employee.designation',
            'approver',
        ]);

        // Search Employee

        if ($request->search) {

            $query->whereHas('employee', function ($q) use ($request) {

                $q->where('employee_code', 'like', '%'.$request->search.'%')
                    ->orWhere('first_name', 'like', '%'.$request->search.'%')
                    ->orWhere('last_name', 'like', '%'.$request->search.'%');

            });

        }

        // Employee Filter

        if ($request->employee_id) {

            $query->where(
                'employee_id',
                $request->employee_id
            );

        }

        // Leave Status Filter

        if ($request->status) {

            $query->where(
                'status',
                $request->status
            );

        }

        // From Date Filter

        if ($request->from_date) {

            $query->whereDate(
                'from_date',
                '>=',
                $request->from_date
            );

        }

        // To Date Filter

        if ($request->to_date) {

            $query->whereDate(
                'to_date',
                '<=',
                $request->to_date
            );

        }

        $leaves = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $employees = Employee::orderBy('first_name')
            ->get();

        return view(
            'reports.leave',
            compact(
                'leaves',
                'employees'
            )
        );

    }
}
