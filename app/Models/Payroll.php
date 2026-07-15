<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $fillable = [
        'employee_id',
        'payroll_month',
        'basic_salary',
        'allowance',
        'bonus',
        'overtime',
        'deduction',
        'leave_deduction',
        'tax',
        'net_salary',
        'status',
        'payment_date',
        'remarks',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
