<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
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
        return $user->pluckCurrentPermissions()->contains('PERMISSION.READ') ? true : false;
    }

}
