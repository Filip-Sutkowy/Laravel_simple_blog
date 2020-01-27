<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
	/**
	 * Display the specified resource.
	 *
	 * @param  \App\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function show(User $user)
	{
		return view('users.show', ['user' => $user]);
	}
}
