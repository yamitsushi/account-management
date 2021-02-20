<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Role;

class Permission extends Model
{
	use HasFactory;

	protected $hidden = [
		'pivot'
	];

	public $timestamps = false;

	public function getActionAttribute($value)
	{
		return strtoupper($value);
	}

	public function roles()
	{
		return $this->belongsToMany(Role::class);
	}

	public function scopeAllPermissions($query)
    {
        return $this->where('id', '!=', 1);
    }

}
