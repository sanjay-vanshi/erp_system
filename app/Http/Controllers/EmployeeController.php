<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use App\Services\ActivityLogger;

class EmployeeController extends Controller implements HasMiddleware
{
    // middleware for all methods
    public static function middleware(): array
    {
        return [

            new Middleware('permission:view employees', only: ['index', 'show']),

            new Middleware('permission:create employees', only: ['create', 'store']),

            new Middleware('permission:edit employees', only: ['edit', 'update']),

            new Middleware('permission:delete employees', only: ['destroy']),

        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Employee::with(['department', 'designation']);

        // 🔍 Search
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('employee_code', 'like', '%'.$request->search.'%')
                    ->orWhere('first_name', 'like', '%'.$request->search.'%')
                    ->orWhere('last_name', 'like', '%'.$request->search.'%')
                    ->orWhere('email', 'like', '%'.$request->search.'%');
            });
        }

        // 🏢 Department filter
        if ($request->department_id) {
            $query->where('department_id', $request->department_id);
        }

        // 🎯 Designation filter
        if ($request->designation_id) {
            $query->where('designation_id', $request->designation_id);
        }

        // 📌 Status filter
        if ($request->status) {
            $query->where('status', $request->status);
        }

        $employees = $query->orderBy('id', 'DESC')
            ->paginate(10)
            ->withQueryString();

        // dropdown data
        $departments = Department::all();
        $designations = Designation::all();

        return view('employees.index', compact(
            'employees',
            'departments',
            'designations'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        $designations = Designation::all();

        return view('employees.create', compact('departments', 'designations'));
    }

    /**
     * Store a newly created resource in storage.
     */
        public function store(StoreEmployeeRequest $request)
        {
           $employee =  Employee::create($request->validated());
            // activity logging

            ActivityLogger::log(
        'created',
        'Employee',
        $employee->id,
        'Employee '.$employee->first_name.' '.$employee->last_name.' created'
    );

            return redirect()
                ->route('employees.index')
                ->with('success', 'Employee created successfully.');
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
    public function edit(Employee $employee)
    {
        $departments = Department::all();
        $designations = Designation::all();

        return view('employees.edit', compact(
            'employee',
            'departments',
            'designations'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $employee->update($request->validated());
//  activit log

ActivityLogger::log(
    'updated',
    'Employee',
    $employee->id,
    'Employee '.$employee->first_name.' '.$employee->last_name.' updated'
);
        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {  

    // acitivity log 
      ActivityLogger::log(
    'deleted',
    'Employee',
    $employee->id,
    'Employee '.$employee->first_name.' '.$employee->last_name.' deleted'
);


$employee->delete();

        $employee->delete();

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee moved to trash.');
    }

    public function trash()
    {
        $employees = Employee::onlyTrashed()
            ->with(['department', 'designation'])
            ->paginate(10);

        return view('employees.trash', compact('employees'));
    }
}
