<?php

namespace App\Exports;

use App\Models\Employee;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class EmployeeReportExport implements FromCollection, ShouldAutoSize, WithEvents, WithHeadings, WithStyles
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    // styles

    public function styles(Worksheet $sheet)
    {
        return [

            // Header row
            1 => [
                'font' => [
                    'bold' => true,
                ],

            ],

        ];
    }

    //  after sheet events

    public function registerEvents(): array
    {
        return [

            AfterSheet::class => function (AfterSheet $event) {

                $sheet = $event->sheet->getDelegate();

                // Freeze first row

                $sheet->freezePane('A2');

                // Header formatting

                $sheet->getStyle('A1:I1')
                    ->getFont()
                    ->setBold(true);

                // Salary column format

                $sheet->getStyle('G2:G'.$sheet->getHighestRow())
                    ->getNumberFormat()
                    ->setFormatCode('#,##0');

                // Date format

                $sheet->getStyle('H2:H'.$sheet->getHighestRow())
                    ->getNumberFormat()
                    ->setFormatCode('yyyy-mm-dd');

            },

        ];
    }

    public function collection()
    {

        $query = Employee::with([
            'department',
            'designation',
        ]);
        // Search

        if ($this->request->search) {

            $query->where(function ($q) {

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
                    )
                    ->orWhere(
                        'email',
                        'like',
                        '%'.$this->request->search.'%'
                    );

            });

        }

        // Department Filter

        if ($this->request->department_id) {

            $query->where(
                'department_id',
                $this->request->department_id
            );

        }

        // Designation Filter

        if ($this->request->designation_id) {

            $query->where(
                'designation_id',
                $this->request->designation_id
            );

        }

        // Status Filter

        if ($this->request->status) {

            $query->where(
                'status',
                $this->request->status
            );

        }

        return $query->get()
            ->map(function ($employee) {

                return [

                    $employee->employee_code,

                    $employee->first_name.' '.$employee->last_name,

                    $employee->email,

                    $employee->phone,

                    $employee->department->name ?? '',

                    $employee->designation->title ?? '',

                    $employee->salary,

                    $employee->joining_date,

                    $employee->status,

                ];

            });

    }

    public function headings(): array
    {
        return [

            'Employee Code',
            'Employee Name',
            'Email',
            'Phone',
            'Department',
            'Designation',
            'Salary',
            'Joining Date',
            'Status',

        ];
    }
}
