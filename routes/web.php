<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('departments', DepartmentController::class);
    Route::resource('designations', DesignationController::class);
    Route::resource("employees",EmployeeController::class);
    Route::resource('attendances', AttendanceController::class);
    Route::patch('leaves/{leaf}/approve',[LeaveController::class, 'approve'])->name('leaves.approve');
    Route::get('leaves/{leaf}/reject',[LeaveController::class,'rejectForm'])->name('leaves.reject.form');
    Route::patch('leaves/{leaf}/reject',[LeaveController::class, 'reject'])->name('leaves.reject');
    Route::resource('leaves', LeaveController::class);

    
});

require __DIR__.'/auth.php';
