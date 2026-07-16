<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CompanySettingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeDocumentController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('designations', DesignationController::class);
    Route::resource('employees', EmployeeController::class)->middleware('permission:view employees');
    Route::resource('attendances', AttendanceController::class);
    Route::patch('leaves/{leaf}/approve', [LeaveController::class, 'approve'])->name('leaves.approve');
    Route::get('leaves/{leaf}/reject', [LeaveController::class, 'rejectForm'])->name('leaves.reject.form');
    Route::patch('leaves/{leaf}/reject', [LeaveController::class, 'reject'])->name('leaves.reject');
    Route::resource('leaves', LeaveController::class);
    Route::resource('payrolls', PayrollController::class);
    Route::resource('permissions', PermissionController::class);
    Route::get('roles/{role}/permissions', [RoleController::class, 'permissions'])->name('roles.permissions');

    Route::post('roles/{role}/permissions', [RoleController::class, 'updatePermissions'])->name('roles.permissions.update');
    Route::resource('activity-logs', ActivityLogController::class)
        ->only(['index', 'show']);
    Route::prefix('reports')
        ->name('reports.')
        ->group(function () {

            Route::get('/', [ReportController::class, 'index'])
                ->name('index');

            Route::get('/employees', [ReportController::class, 'employeeReport'])
                ->name('employees');

            Route::get('/attendance', [ReportController::class, 'attendanceReport'])
                ->name('attendance');

            Route::get('/leaves', [ReportController::class, 'leaveReport'])
                ->name('leaves');

            Route::get('/payroll', [ReportController::class, 'payrollReport'])
                ->name('payroll');

        });

    Route::get('reports/employees/export', [ReportController::class, 'exportEmployees'])
        ->name('reports.employees.export');
    Route::get(
        'reports/attendance/export',
        [ReportController::class, 'exportAttendance']
    )->name('reports.attendance.export');

    Route::get(
        'reports/leaves/export',
        [ReportController::class, 'exportLeave']
    )
        ->name('reports.leaves.export');
    Route::get(
        'reports/payroll/export',
        [ReportController::class, 'exportPayroll']
    )
        ->name('reports.payroll.export');
    Route::get(
        'reports/employees/pdf',
        [ReportController::class, 'exportEmployeePdf']
    )->name('reports.employee.pdf');
    Route::get(
        'reports/attendance/pdf',
        [ReportController::class, 'exportAttendancePdf']
    )->name('reports.attendance.pdf');
    Route::get(
        'reports/leaves/pdf',
        [ReportController::class, 'exportLeavePdf']
    )->name('reports.leave.pdf');
    Route::get(
        'reports/payroll/pdf',
        [ReportController::class, 'exportPayrollPdf']
    )->name('reports.payroll.pdf');

    Route::resource(
        'holidays',
        HolidayController::class
    );
    Route::resource(
        'employee-documents',
        EmployeeDocumentController::class
    );
    Route::get(
        'company-settings',
        [CompanySettingController::class, 'index']
    )
        ->name('company-settings.index');

    Route::put(
        'company-settings',
        [CompanySettingController::class, 'update']
    )
        ->name('company-settings.update');

});

require __DIR__.'/auth.php';
