<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    protected $fillable = [
        'name',
        'description',
        'status',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Role belongs to many permissions
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission');
    }
}
