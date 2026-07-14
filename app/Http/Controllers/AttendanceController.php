<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use App\Models\Attendance;
use App\Models\Employee;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class AttendanceController extends Controller implements HasMiddleware
{
    // permission giving...
    public static function middleware(): array
    {
        return [

            new Middleware(
                'permission:view attendances',
                only: ['index', 'show']
            ),

            new Middleware(
                'permission:create attendances',
                only: ['create', 'store']
            ),

            new Middleware(
                'permission:edit attendances',
                only: ['edit', 'update']
            ),

            new Middleware(
                'permission:delete attendances',
                only: ['destroy']
            ),

        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Attendance::with('employee');

        // Search
        if ($request->search) {

            $query->whereHas('employee', function ($q) use ($request) {

                $q->where('employee_code', 'like', '%'.$request->search.'%')
                    ->orWhere('first_name', 'like', '%'.$request->search.'%')
                    ->orWhere('last_name', 'like', '%'.$request->search.'%');

            });

        }

        // Employee Filter
        if ($request->employee_id) {

            $query->where('employee_id', $request->employee_id);

        }

        // Status Filter
        if ($request->status) {

            $query->where('status', $request->status);

        }

        // Attendance Date Filter
        if ($request->attendance_date) {

            $query->whereDate('attendance_date', $request->attendance_date);

        }

        $attendances = $query->latest()
            ->paginate(10)
            ->withQueryString();

        $employees = Employee::orderBy('first_name')->get();

        return view('attendances.index', compact(
            'attendances',
            'employees'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::orderBy('first_name')->get();

        return view('attendances.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAttendanceRequest $request)
{
    $attendance = Attendance::create(
        $request->validated()
    );


    ActivityLogger::log(
        'created',
        'Attendance',
        $attendance->id,
        'Attendance created for employee ID '.$attendance->employee_id
    );


    return redirect()
        ->route('attendances.index')
        ->with('success', 'Attendance created successfully.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        $employees = Employee::orderBy('first_name')->get();

        return view('attendances.edit', compact(
            'attendance',
            'employees'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(UpdateAttendanceRequest $request, Attendance $attendance)
{
    $attendance->update(
        $request->validated()
    );


    ActivityLogger::log(
        'updated',
        'Attendance',
        $attendance->id,
        'Attendance updated for employee ID '.$attendance->employee_id
    );


    return redirect()
        ->route('attendances.index')
        ->with('success', 'Attendance updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Attendance $attendance)
{

    ActivityLogger::log(
        'deleted',
        'Attendance',
        $attendance->id,
        'Attendance deleted for employee ID '.$attendance->employee_id
    );


    $attendance->delete();


    return redirect()
        ->route('attendances.index')
        ->with('success', 'Attendance deleted successfully.');
}
}
