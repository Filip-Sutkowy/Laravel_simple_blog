@extends('layouts.app')

@section('content')

<div class="card my-4">

	<img src="{{ $article->image }}" class="card-img-top" alt="{{ $article->title }}" height="240">
	<div class="card-body">
		<h3 class="card-title">
			<div class="row">

				<div class="col-10 col-md-11">
					{{ $article->title }}
				</div>

				<div class="col-2 col-md-1 dropdown dropleft">
					<a class="btn btn-comment btn-dropdown align-middle d-inline-flex p-2" id="comment_9_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
					<div class="dropdown-menu" aria-labelledby="comment_9_dropdown">
						@if (Auth::check() && $article->user_id == Auth::user()->id )
						<a class="dropdown-item" onclick="removeArticle()" href="#"><i class="fas fa-trash"></i> Remove </a>
						<a class="dropdown-item" href="/articles/{{ $article->id }}/edit"><i class="fas fa-edit"></i> Edit </a>

						<form id="destoy-article" action="/articles/{{ $article->id }}" method="POST" style="display: none;">
							@csrf
							@method('DELETE')
						</form>

						<script>
							function removeArticle() {
								if (confirm('You are going to remove your article and related comments. Are you sure?')) {
									event.preventDefault();
									document.getElementById('destoy-article').submit();
								}
							}
						</script>
						@else
						<span class="dropdown-item"><i class="fas fa-lock"></i> Only author can modify or delete article </span>
						@endif
					</div>
				</div>

			</div>


		</h3>
		<div class="card-text">
			{{ $article->content }}
		</div>
	</div>
	<div class="card-footer text-muted">
		Created at {{ $article->created_at }} by <a href="/users/{{ $user->id }}">{{ $user->name }}</a>
	</div>
</div>

<div class="card my-4">
	<h3 class="card-title mt-3 mb-2 ml-3">Comments</h3>
	<div class="card-body">

		@include('comments.list', ['comments' => $article->comments ])

		@auth
		@if (Auth::user()->id == $article->user_id)
		<p class="text-center mt-4">You cannot comment your own posts!</p>

		@else
		<form class="mt-4" action="/articles/{{$article->id}}/comments" method="POST">
			@csrf
			@method("POST")

			<h4>Leave comment:</h4>
			<div class="input-group">
				<input type="text" class="form-control" placeholder="Comment content" name="content" maxlength="200" required>
				<div class="input-group-append">
					<input class="btn btn-outline-info" type="submit" id="button-addon2" value="Send">
				</div>
			</div>
			<small id="emailHelp" class="form-text text-muted">Max comment length is 200 characters</small>
		</form>
		@endif
		@else
		<p class="text-center mt-4">Login to comment!</p>
		@endauth
	</div>
</div>
@endsection