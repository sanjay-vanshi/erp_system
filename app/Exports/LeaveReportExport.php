<?php

namespace App\Exports;

use App\Models\Leave;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LeaveReportExport implements FromCollection, WithHeadings, WithStyles
{
    public function collection()
    {

        return Leave::with([
            'employee.department',
            'employee.designation',
            'approver',
        ])
            ->get()
            ->map(function ($leave) {

                return [

                    'employee_code' => $leave->employee->employee_code ?? '',

                    'employee_name' => $leave->employee->first_name.' '.
                        $leave->employee->last_name,

                    'department' => $leave->employee->department->name ?? '',

                    'designation' => $leave->employee->designation->title ?? '',

                    'from_date' => $leave->from_date,

                    'to_date' => $leave->to_date,

                    'total_days' => $leave->total_days,

                    'status' => $leave->status,

                    'approved_by' => $leave->approver->name ?? '',

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
            'From Date',
            'To Date',
            'Total Days',
            'Status',
            'Approved By',

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
