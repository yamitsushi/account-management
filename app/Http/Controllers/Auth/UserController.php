<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\User\LoginRequest;
use App\Http\Requests\Auth\User\ChangePasswordRequest;
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
			return response()->json([
				"message" => "Authentication Failed"
			], 401);
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
			'permissions' => Auth::user()->pluckCurrentPermissions()
		]);
	}

	public function changePassword(ChangePasswordRequest $request)
	{
		return Auth::user()->update($request->only(['password']));
	}
}
