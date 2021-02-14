<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\User\LoginRequest;
use Illuminate\Support\Facades\Auth;

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
}
