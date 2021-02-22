<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->pluckCurrentPermissions()->contains('SUPER_ADMINISTRATOR'))
            return true;
    }

    public function viewAny(User $user)
    {
        return $user->pluckCurrentPermissions()->contains('USER.READ') ? true : false;
    }

    public function create(User $user)
    {
        return $user->pluckCurrentPermissions()->contains('USER.CREATE') ? true : false;
    }

    public function update(User $user, User $model)
    {
        return $user->pluckCurrentPermissions()->contains('USER.UPDATE') ? true : false;
    }

    public function delete(User $user, User $model)
    {
        return $user->pluckCurrentPermissions()->contains('USER.UPDATE') ? true : false;
    }

    public function restore(User $user, User $model)
    {
        return $user->pluckCurrentPermissions()->contains('USER.UPDATE') ? true : false;
    }

    public function provideRole(User $user, User $model)
    {
        if ($model->id === 1) return false;
        return $user->pluckCurrentPermissions()->contains('ROLE_USER.PROVIDE') ? true : false;
    }
}
