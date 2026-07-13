<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class DepartmentController extends Controller implements HasMiddleware
{
    // permission giving to methods
    public static function middleware(): array
    {
        return [

            new Middleware(
                'permission:view departments',
                only: ['index', 'show']
            ),

            new Middleware(
                'permission:create departments',
                only: ['create', 'store']
            ),

            new Middleware(
                'permission:edit departments',
                only: ['edit', 'update']
            ),

            new Middleware(
                'permission:delete departments',
                only: ['destroy']
            ),

        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Department::query();

        if ($request->search) {

            $query->where('name', 'like', '%'.$request->search.'%')
                ->orWhere('code', 'like', '%'.$request->search.'%');
        }

        $departments = $query->orderBy('id', 'DESC')
            ->paginate(10)
            ->withQueryString();

        return view('departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepartmentRequest $request)
    {
        Department::create($request->validated());

        return redirect()
            ->route('departments.index')
            ->with('success', 'Department created successfully.');
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
    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $department->update($request->validated());

        return redirect()
            ->route('departments.index')
            ->with('success', 'Department updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete();

        return redirect()
            ->route('departments.index')
            ->with('success', 'Department deleted successfully!');
    }
}
