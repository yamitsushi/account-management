<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\Permission;
use \Carbon\Carbon;

class User extends Authenticatable
{
    use SoftDeletes, HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'password'
    ];

    protected $hidden = [
        'password', 'pivot'
    ];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->isoFormat('MMMM Do YYYY, HH:mm');
    }

    public function setPasswordAttribute($value)
    {
        if($value)
            $this->attributes['password'] = Hash::needsRehash($value) ? Hash::make($value) : $value;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function scopeAllUsers($query)
    {
        return $this->where('id', '!=', 1)->withTrashed();
    }

    public function scopePluckCurrentPermissions($query)
    {
        return $this->load('roles.permissions:action')->roles->pluck('permissions')->flatten()->pluck('action')->unique();
    }
}
