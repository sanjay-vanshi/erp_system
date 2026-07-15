<?php

namespace App\Exports;

use App\Models\Payroll;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PayrollReportExport implements FromCollection, WithHeadings, WithStyles
{
    public function collection()
    {

        return Payroll::with([
            'employee.department',
            'employee.designation',
        ])
            ->get()
            ->map(function ($payroll) {

                return [

                    'employee_code' => $payroll->employee->employee_code ?? '',

                    'employee_name' => $payroll->employee->first_name.' '.
                        $payroll->employee->last_name,

                    'department' => $payroll->employee->department->name ?? '',

                    'designation' => $payroll->employee->designation->title ?? '',

                    'payroll_month' => $payroll->payroll_month,

                    'basic_salary' => $payroll->basic_salary,

                    'allowance' => $payroll->allowance,

                    'deduction' => $payroll->deduction,

                    'net_salary' => $payroll->net_salary,

                    'payment_status' => $payroll->payment_status,

                ];

            });

    }

    public function headings(): array
    {
        return [

            'Employee Code',
            'Employee Name',
            'Department',
            'Designation',
            'Payroll Month',
            'Basic Salary',
            'Allowance',
            'Deduction',
            'Net Salary',
            'Status',

        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [

            1 => [

                'font' => [

                    'bold' => true,

                ],

            ],

        ];
    }
}
