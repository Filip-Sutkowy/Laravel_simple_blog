<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserArticleController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(User $user)
	{
		$articles = $user->articles()->paginate(5);

		return view('users.show', ['user' => $user, 'articles' => $articles]);
	}
}
