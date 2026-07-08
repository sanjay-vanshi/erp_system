<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $fillable = [

        'employee_id',
        'leave_type',
        'from_date',
        'to_date',
        'total_days',
        'reason',
        'status',
        'approved_by',
        'remarks',

    ];

    /**
     * Leave belongs to Employee
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * Leave approved by User
     */
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
