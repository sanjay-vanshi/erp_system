<?php

namespace App\Exports;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AttendanceReportExport implements FromCollection, ShouldAutoSize, WithEvents, WithHeadings, WithStyles
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {

        $query = Attendance::with([
            'employee.department',
            'employee.designation',
        ]);

        // Search Employee

        if ($this->request->search) {

            $query->whereHas('employee', function ($q) {

                $q->where(
                    'employee_code',
                    'like',
                    '%'.$this->request->search.'%'
                )
                    ->orWhere(
                        'first_name',
                        'like',
                        '%'.$this->request->search.'%'
                    )
                    ->orWhere(
                        'last_name',
                        'like',
                        '%'.$this->request->search.'%'
                    );

            });

        }

        // Employee Filter

        if ($this->request->employee_id) {

            $query->where(
                'employee_id',
                $this->request->employee_id
            );

        }

        // Status Filter

        if ($this->request->status) {

            $query->where(
                'status',
                $this->request->status
            );

        }

        // Date Filter

        if ($this->request->attendance_date) {

            $query->whereDate(
                'attendance_date',
                $this->request->attendance_date
            );

        }

        // Month Filter

        if ($this->request->month) {

            $query->whereMonth(
                'attendance_date',
                date('m', strtotime($this->request->month))
            )
                ->whereYear(
                    'attendance_date',
                    date('Y', strtotime($this->request->month))
                );

        }

        return $query->latest()
            ->get()
            ->map(function ($attendance) {

                return [

                    'employee_code' => $attendance->employee->employee_code ?? '',

                    'employee_name' => $attendance->employee->first_name.' '.
                    $attendance->employee->last_name,

                    'department' => $attendance->employee->department->name ?? '',

                    'designation' => $attendance->employee->designation->title ?? '',

                    'attendance_date' => $attendance->attendance_date,

                    'status' => $attendance->status,

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
            'Attendance Date',
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

    public function registerEvents(): array
    {

        return [

            AfterSheet::class => function (AfterSheet $event) {

                $sheet = $event->sheet->getDelegate();

                // Freeze header

                $sheet->freezePane('A2');

                // Date format

                $sheet->getStyle(
                    'E2:E'.$sheet->getHighestRow()
                )
                    ->getNumberFormat()
                    ->setFormatCode('yyyy-mm-dd');

            },

        ];

    }
}
