<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

    public function postRole(Request $request)
    {
        $role = Role::firstOrCreate(['name' => $request->name]);
        $permissions = [];
        foreach ($request->permissions as $permission) {
            array_push(
                $permissions,
                Permission::where('action', 
                    strtolower(
                        implode('.', $permission['action'])
                    )
                )->first()->id
            );
        }
        $role->permissions()->sync($permissions);
        return response()->json(Role::with('permissions')->find($role->id));
    }

    public function patchRole(Request $request, Role $role)
    {
        $role = Role::firstOrCreate(['name' => $request->name]);
        $permissions = [];
        foreach ($request->permissions as $permission) {
            array_push(
                $permissions,
                Permission::where('action', str_replace(" ", ".", strtolower($permission)))->first()->id
            );
        }
        $role->permissions()->sync($permissions);
        return response()->json(Role::with('permissions')->find($role->id));
    }

    public function deleteRole(Request $request, Role $role)
    {
        return response()->json($role->delete());
    }

    public function postUser(Request $request)
    {
        $user = User::firstOrCreate($request->only(['username', 'password']));
        $roles = [];
        foreach ($request->roles as $role) {
            array_push(
                $roles,
                Role::where('name',
                    $role
                )->first()->id
            );
        }
        $user->roles()->sync($roles);
        return response()->json(User::with('roles:name')->find($user->id));
    }

    public function patchUser(Request $request, User $user)
    {
        if ($request->password)
            $user->update($request->only(['username', 'password']));
        else
            $user->update($request->only(['username']));
        $roles = [];
        foreach ($request->roles as $role) {
            array_push(
                $roles,
                Role::where('name',
                    $role
                )->first()->id
            );
        }
        $user->roles()->sync($roles);
        return response()->json(User::with('roles:name')->find($user->id));
    }
}
