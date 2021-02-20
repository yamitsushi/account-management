<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\User\LoginRequest;
use App\Http\Requests\Auth\User\ChangePasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;

class UserController extends Controller
{
	public function login(LoginRequest $request)
	{
		if ( Auth::attempt($request->only(['username', 'password'])) )
			return Auth::user()->username;
		else
			return response()->json(
				[
					"message" => "The given data was invalid.",
					"errors" => [
						"username" => [
							"Authentication Failed"
						]
					]
				],
				401
			);
	}

	public function logout()
	{
		return Auth::logout();
	}

	public function check()
	{
		return Auth::user()->username;
	}

	public function permissions()
	{
		return response()->json([
			'permissions' => Auth::user()->with('roles.permissions')->first()->roles->pluck('permissions')->flatten()->unique('action')->flatten()->pluck('action')
		]);
	}

	public function changePassword(ChangePasswordRequest $request)
	{
        return Auth::user()->update($request->only(['password']));
	}
}
