<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\API\Account\PostUserRequest;
use App\Http\Requests\API\Account\PatchUserRequest;
use App\Http\Requests\API\Account\PostRoleRequest;
use App\Http\Requests\API\Account\PatchRoleRequest;
use App\Http\Requests\API\Account\DeleteRoleRequest;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;

class AccountController extends Controller
{
    public function getUser()
    {
    	return response()->json(User::allUsers()->with('roles:name')->get());
    }

    public function getRole()
    {
    	return response()->json(Role::allRoles()->with('permissions')->get());
    }

    public function getPermission()
    {
    	return response()->json(Permission::allPermissions()->get()->pluck('action'));
    }

    public function postRole(PostRoleRequest $request)
    {
        $role = Role::firstOrCreate(['name' => $request->name]);
        if($request->user()->can('providePermission', $role))
            $role->permissions()->sync($this->getPermissionsID($request->permissions));
        return response()->json(Role::with('permissions:action')->find($role->id));
    }

    public function patchRole(PatchRoleRequest $request, Role $role)
    {
        $role->permissions()->sync($this->getPermissionsID($request->permissions));
        return response()->json(Role::with('permissions:action')->find($role->id));
    }

    public function deleteRole(DeleteRoleRequest $request, Role $role)
    {
        return response()->json($role->delete());
    }

    public function postUser(PostUserRequest $request)
    {
        $user = User::firstOrCreate($request->only(['username', 'password']));
        if($request->user()->can('provideRole', $user))
            $user->roles()->sync($this->getRolesID($request->roles));
        return response()->json(User::with('roles:name')->find($user->id));
    }

    public function patchUser(PatchUserRequest $request, $id)
    {
        $user = User::withTrashed()->find($id);
        if($request->user()->can('update', $user))
            $user->update($request->only(['username', 'password']));
        if($request->deactivate)
        {
            if($request->user()->can('delete', $user))
            {
                $user->roles()->detach();
                $user->delete();
            }
        } else
        {
            if($request->user()->can('restore', $user))
                $user->restore();
            if($request->user()->can('provideRole', $user) && !$user->deleted_at)
                $user->roles()->sync($this->getRolesID($request->roles));
        }
        return response()->json(User::with('roles:name')->withTrashed()->find($id));
    }

    private function getRolesID($roles)
    {
        $final = [];
        foreach ($roles as $role)
        {
            $id = Role::where('name', $role)->first()->id;
            if($id != 1) array_push($final, $id);
        }
        return $final;
    }

    private function getPermissionsID($permissions)
    {
        $final = [];
        foreach ($permissions as $permission)
        {
            $id = Permission::where('action', $permission)->first()->id;
            if($id != 1) array_push($final, $id);
        }
        return $final;
    }
}
