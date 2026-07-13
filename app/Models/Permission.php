<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'name',
        'guard_name',
    ];

    /**
     * Roles having this permission.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permission');
    }
}
