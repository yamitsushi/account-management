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
        //
    }

    public function update(User $user, Role $role)
    {
        //
    }

    public function delete(User $user, Role $role)
    {
        //
    }
}
