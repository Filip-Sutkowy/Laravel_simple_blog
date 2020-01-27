<?php

namespace App\Http\Controllers\Article;

use App\Article;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ArticleController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$articles = DB::table('articles')->paginate(5);

		return view('articles.index', ['articles' => $articles]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		if (!Auth::check()) {
			throw new HttpException(401, "You are not authorized. Login first");
		}

		return view('articles.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		if (!Auth::check()) {
			throw new HttpException(401, "You are not authorized. Login first");
		}

		$rules = [
			'title' => 'required|min:3',
			'content' => 'required|min:10',
			'image' => 'required|image'
		];

		$this->validate($request, $rules);

		$newArticle = new Article;

		$newArticle->title = $request->title;
		$newArticle->content = $request->content;
		$newArticle->image =  '/' . $request->image->store('/storage/img', 'publicFolder');
		$newArticle->user_id = Auth::user()->id;

		$newArticle->save();

		// $data = $request->all();

		// $data['image'] = $request->image->store('img');

		// $newArticle = Article::create($data);

		return redirect('articles/' . $newArticle->id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show(Article $article)
	{
		return view('articles.show', ['article' => $article, 'user' => User::find($article->user_id)]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Article $article, Request $request)
	{
		if (!Auth::check()) {
			throw new HttpException(401, "Unauthorized");
		}
		if ($article->user_id != Auth::user()->id) {
			throw new HttpException(403, "You have no permissions");
		}

		return view('articles.edit', ['article' => $article]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Article $article)
	{
		if (!Auth::check()) {
			throw new HttpException(401, "Unauthorized");
		}

		if ($article->user_id != Auth::user()->id) {
			throw new HttpException(403, "You have no permissions");
		}


		$rules = [
			'title' => 'min:3',
			'content' => 'min:10',
			'image' => 'image'
		];

		$this->validate($request, $rules);

		if ($request->has('title')) {
			$article->title = $request->title;
		}
		if ($request->has('content')) {
			$article->content = $request->content;
		}
		if ($request->has('image')) {
			Storage::disk('publicFolder')->delete($article->image);

			$article->image = '/' . $request->image->store('/storage/img', 'publicFolder');
		}

		if ($article->isClean()) {
			return $this->errorResponse('You need to specify a diffrent value to update', 422);
		}

		$article->save();

		return redirect('articles/' . $article->id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Article $article, Request $request)
	{
		if (!Auth::check()) {
			throw new HttpException(401, "Unauthorized");
		}

		if ($article->user_id != Auth::user()->id) {
			throw new HttpException(403, "You have no permissions");
		}

		Storage::disk('publicFolder')->delete($article->image);

		foreach ($article->comments as $comment) $comment->delete();

		$article->delete();

		$request->session()->flash('message-success', 'Article successfully removed!');
		return redirect('/');
	}
}
