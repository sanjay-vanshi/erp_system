<?php

namespace App\Models;

use App\Models\Department;
use App\Models\Designation;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
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

}
