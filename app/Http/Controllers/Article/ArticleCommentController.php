<?php

namespace App\Http\Controllers\Article;

use App\Article;
use App\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ArticleCommentController extends Controller
{
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request, Article $article)
	{
		if (!Auth::check()) {
			throw new HttpException(401, "You are not authorized. Login first");
		}

		if (Auth::user()->id == $article->user_id) {
			throw new HttpException(403, "You cannot comment your own articles");
		}

		$rules = [
			'content' => 'required|min:1'
		];

		$this->validate($request, $rules);

		$newComment = new Comment;

		$newComment->article_id = $article->id;
		$newComment->content = $request->content;
		$newComment->user_id = Auth::user()->id;

		$newComment->save();

		$request->session()->flash('message-success', 'You commented a article!');

		return redirect('articles/' . $article->id);
	}
}
