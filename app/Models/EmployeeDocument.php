<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeDocument extends Model
{
    protected $fillable = [

        'employee_id',
        'document_name',
        'file_name',
        'file_path',
        'description',
        'uploaded_by',

    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
