<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->pluckCurrentPermissions()->contains('SUPER_ADMINISTRATOR')) {
            return true;
        }
    }

    public function viewAny(User $user)
    {
        return $user->pluckCurrentPermissions()->contains('ROLE.READ') ? true : false;
    }

    public function create(User $user)
    {
        return $user->pluckCurrentPermissions()->contains('ROLE.CREATE') ? true : false;
    }

    public function delete(User $user, Role $role)
    {
        if ($role->id === 1) return false;
        return $user->pluckCurrentPermissions()->contains('ROLE.DELETE') ? true : false;
    }

    public function provideRole(User $user, Role $role)
    {
        if ($role->id === 1) return false;
        return $user->pluckCurrentPermissions()->contains('ROLE_USER.PROVIDE') ? true : false;
    }
}
