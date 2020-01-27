<?php

namespace App\Http\Controllers\Comment;

use App\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CommentController extends Controller
{
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Comment $comment, Request $request)
	{
		if (!Auth::check()) {
			throw new HttpException(401, "You are not authorized. Login first");
		}

		if ($comment->user_id != Auth::user()->id) {
			throw new HttpException(403, "You have no permissions");
		}

		$comment->delete();

		$request->session()->flash('message-success', 'Comment successfully removed!');
		return redirect()->back();
	}
}
