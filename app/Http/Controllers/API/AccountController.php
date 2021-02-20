<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
    	return response()->json(Permission::allPermissions()->select('action')->get());
    }

    public function postRole(PostRoleRequest $request)
    {
        $role = Role::firstOrCreate(['name' => $request->name]);
        $role->permissions()->sync($this->getPermissionsID($request->permissions));
        return response()->json(Role::with('permissions')->find($role->id));
    }

    public function patchRole(PatchRoleRequest $request, Role $role)
    {
        $role->update(['name' => $request->name]);
        $role->permissions()->sync($this->getPermissionsID($request->permissions));
        return response()->json(Role::with('permissions')->find($role->id));
    }

    public function deleteRole(DeleteRoleRequest $request, Role $role)
    {
        return response()->json($role->delete());
    }

    public function postUser(PostUserRequest $request)
    {
        $user = User::firstOrCreate($request->only(['username', 'password']));
        $user->roles()->sync($this->getRolesID($request->roles));
        return response()->json(User::with('roles:name')->find($user->id));
    }

    public function patchUser(PatchUserRequest $request, $id)
    {
        $user = User::withTrashed()->find($id);
        if($request->deactivate)
        {
            $user->update($request->only(['username']));
            $user->roles()->detach();
            $user->delete();
        } else
        {
            $user->restore();
            $user->update($request->only(['username', 'password']));
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
            if($id != 1)
                array_push($final, $id);
        }
        return $final;
    }

    private function getPermissionsID($permissions)
    {
        $final = [];
        foreach ($permissions as $permission)
        {
            $id = Permission::where('action', strtolower(implode('.', $permission['action'])))->first()->id;
            if($id != 1)
                array_push($final, $id);
        }
        return $final;
    }
}
