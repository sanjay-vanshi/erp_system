<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeDocumentRequest;
use App\Http\Requests\UpdateEmployeeDocumentRequest;
use App\Models\Employee;
use App\Models\EmployeeDocument;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Storage;

class EmployeeDocumentController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [

            new Middleware(
                'permission:view employee documents',
                only: [
                    'index',
                    'show',
                ]
            ),

            new Middleware(
                'permission:create employee documents',
                only: [
                    'create',
                    'store',
                ]
            ),

            new Middleware(
                'permission:edit employee documents',
                only: [
                    'edit',
                    'update',
                ]
            ),

            new Middleware(
                'permission:delete employee documents',
                only: [
                    'destroy',
                ]
            ),

        ];
    }

    /**
     * Display documents list
     */
    public function index(Request $request)
    {

        $query = EmployeeDocument::with([
            'employee',
            'uploader',
        ]);

        // Search Employee / Document

        if ($request->search) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('document_name', 'like', "%$search%")
                    ->orWhereHas('employee', function ($employee) use ($search) {

                        $employee->where('employee_code', 'like', "%$search%")
                            ->orWhere('first_name', 'like', "%$search%")
                            ->orWhere('last_name', 'like', "%$search%");

                    });

            });

        }

        // Employee Filter

        if ($request->employee_id) {

            $query->where(
                'employee_id',
                $request->employee_id
            );

        }

        $documents = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $employees = Employee::orderBy('first_name')
            ->get();

        return view(
            'employee_documents.index',
            compact(
                'documents',
                'employees'
            )
        );

    }

    /**
     * Create form
     */
    public function create()
    {

        $employees = Employee::orderBy('first_name')
            ->get();

        return view(
            'employee_documents.create',
            compact('employees')
        );

    }

    /**
     * Store document
     */
    public function store(StoreEmployeeDocumentRequest $request)
    {

        $file = $request->file('file');

        $path = $file->store(
            'documents',
            'public'
        );

        EmployeeDocument::create([

            'employee_id' => $request->employee_id,

            'document_name' => $request->document_name,

            'file_name' => $file->getClientOriginalName(),

            'file_path' => $path,

            'description' => $request->description,

            'uploaded_by' => auth()->id(),

        ]);

        return redirect()
            ->route('employee-documents.index')
            ->with(
                'success',
                'Employee document uploaded successfully'
            );

    }

    /**
     * Show document
     */
    public function show(EmployeeDocument $employeeDocument)
    {

        return view(
            'employee_documents.show',
            compact('employeeDocument')
        );

    }

    /**
     * Edit form
     */
    public function edit(EmployeeDocument $employeeDocument)
    {

        $employees = Employee::orderBy('first_name')
            ->get();

        return view(
            'employee_documents.edit',
            compact(
                'employeeDocument',
                'employees'
            )
        );

    }

    /**
     * Update document
     */
    public function update(
        UpdateEmployeeDocumentRequest $request,
        EmployeeDocument $employeeDocument
    ) {

        $data = [

            'employee_id' => $request->employee_id,

            'document_name' => $request->document_name,

            'description' => $request->description,

        ];

        if ($request->hasFile('file')) {

            Storage::disk('public')
                ->delete($employeeDocument->file_path);

            $file = $request->file('file');

            $data['file_name'] =
                $file->getClientOriginalName();

            $data['file_path'] =
                $file->store(
                    'documents',
                    'public'
                );

        }

        $employeeDocument->update($data);

        return redirect()
            ->route('employee-documents.index')
            ->with(
                'success',
                'Employee document updated successfully'
            );

    }

    /**
     * Delete document
     */
    public function destroy(EmployeeDocument $employeeDocument)
    {

        Storage::disk('public')
            ->delete($employeeDocument->file_path);

        $employeeDocument->delete();

        return redirect()
            ->route('employee-documents.index')
            ->with(
                'success',
                'Employee document deleted successfully'
            );

    }
}
