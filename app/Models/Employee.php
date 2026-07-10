<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'employee_code',
        'first_name',
        'last_name',
        'email',
        'phone',
        'department_id',
        'designation_id',
        'salary',
        'joining_date',
        'address',
        'status',
    ];

    // relationship with department....M:1

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    // relationship with designation......M:1
    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }

    /**
     * Employee has many attendance records.
     */
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    /**
     * Employee has many leaves records.
     */
    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }

    //  Employee has many payroll records.
    public function payrolls()
    {
        return $this->hasMany(Payroll::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
