<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePayrollRequest;
use App\Http\Requests\UpdatePayrollRequest;
use App\Models\Employee;
use App\Models\Payroll;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;

class PayrollController extends Controller implements HasMiddleware
{
    // permission giving

    public static function middleware(): array
    {
        return [

            new Middleware(
                'permission:view payrolls',
                only: ['index', 'show']
            ),

            new Middleware(
                'permission:create payrolls',
                only: ['create', 'store']
            ),

            new Middleware(
                'permission:edit payrolls',
                only: ['edit', 'update']
            ),

            new Middleware(
                'permission:delete payrolls',
                only: ['destroy']
            ),

        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $payrollMonth = $request->payroll_month;
        $paymentStatus = $request->payment_status;

        $query = Payroll::with('employee');

        if ($search) {
            $query->whereHas('employee', function ($employeeQuery) use ($search) {
                $employeeQuery->where('employee_code', 'like', "%{$search}%")
                    ->orWhere('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%");
            });
        }

        if ($payrollMonth) {
            $query->whereDate('payroll_month', $payrollMonth);
        }

        if ($paymentStatus) {
            $query->where('payment_status', $paymentStatus);
        }

        $payrolls = $query->latest()
            ->paginate(10)
            ->withQueryString();

        return view('payrolls.index', compact('payrolls'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::where('status', 'active')
            ->orderBy('first_name')
            ->get();

        return view('payrolls.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePayrollRequest $request)
    {
        $data = $request->validated();
        $data['payroll_month'] = $data['payroll_month'].'-01';
        foreach (['allowance', 'bonus', 'overtime', 'deduction', 'leave_deduction', 'tax'] as $field) {
            $data[$field] = $data[$field] ?? 0;
        }

        $data['net_salary'] =
            $data['basic_salary']
            + $data['allowance']
            + $data['bonus']
            + $data['overtime']
            - $data['deduction']
            - $data['leave_deduction']
            - $data['tax'];

        DB::transaction(function () use ($data) {
            Payroll::create($data);
        });

        return redirect()
            ->route('payrolls.index')
            ->with('success', 'Payroll created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payroll $payroll)
    {
        $payroll->load([
            'employee.department',
            'employee.designation',
        ]);

        return view('payrolls.show', compact('payroll'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payroll $payroll)
    {
        $employees = Employee::where('status', 'active')
            ->orWhere('id', $payroll->employee_id)
            ->orderBy('first_name')
            ->get();

        return view('payrolls.edit', compact('payroll', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePayrollRequest $request, Payroll $payroll)
    {
        $data = $request->validated();
        $data['payroll_month'] = $data['payroll_month'].'-01';
        foreach (['allowance', 'bonus', 'overtime', 'deduction', 'leave_deduction', 'tax'] as $field) {
            $data[$field] = $data[$field] ?? 0;
        }

        $data['net_salary'] =
            $data['basic_salary']
            + $data['allowance']
            + $data['bonus']
            + $data['overtime']
            - $data['deduction']
            - $data['leave_deduction']
            - $data['tax'];

        DB::transaction(function () use ($payroll, $data) {
            $payroll->update($data);
        });

        return redirect()
            ->route('payrolls.index')
            ->with('success', 'Payroll updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payroll $payroll)
    {
        $payroll->delete();

        return redirect()
            ->route('payrolls.index')
            ->with('success', 'Payroll deleted successfully.');
    }
}
