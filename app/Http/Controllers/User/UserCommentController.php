<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserCommentController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(User $user)
	{
		$comments = $user->comments()->get();

		return view('users.show', ['user' => $user, 'comments' => $comments]);
	}
}
