<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name',
        'code',
        'description',
        'status',
    ];

    // create relation 1:M with employees
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
