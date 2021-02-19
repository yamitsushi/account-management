<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Permission;

class Role extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    protected $hidden = [
        'pivot'
    ];

    public function users()
    {
    	return $this->belongsToMany(User::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function scopeAllRoles($query)
    {
        return $this->where('id', '!=', 1);
    }
}
