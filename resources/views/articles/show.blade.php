@extends('layouts.app')

@section('content')

<div class="card my-4">

	<img src="{{ $article->image }}" class="card-img-top" alt="{{ $article->title }}" height="240">
	<div class="card-body">
		<h3 class="card-title">
			{{ $article->title }}
		</h3>
		<div class="card-text">
			{{ $article->content }}
		</div>
	</div>
</div>

<div class="card my-4">
	<h3 class="card-title mt-3 mb-2 ml-3">Comments</h3>
	<div class="card-body">

		@foreach ($article->comments as $comment)
		<div id="comment_{{ $comment->id }}" class="card mt-3">
			<div class="card-body">
				<div class="row">
					<div class="col-11">
						<a class="btn-link" href="/users/{{ $comment->user->id }}">{{ $comment->user->name }}</a> <span class="comment-body">{{ $comment->content }}</span>
					</div>
					<div class="col-1 text-center">
						<div class="dropdown dropleft">
							<a class="btn btn-comment btn-dropdown align-middle d-inline-flex p-2" id="comment_9_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
							<div class="dropdown-menu" aria-labelledby="comment_9_dropdown">
								@if (Auth::check() && $comment->user_id == Auth::user()->id )
								<a class="dropdown-item" onclick="removeComment()"><i class="fas fa-trash"></i> Remove </a>
								<a class="dropdown-item" onclick="editComment()"><i class="fas fa-edit"></i> Edit </a>
								@else
								<span class="dropdown-item"><i class="fas fa-lock"></i> Only author can modify or delete comment </span>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card-links">
				<span class="text-secondary" data-toggle="tooltip" data-placement="bottom" title="{{ $comment->craeted_at }}">{{ $comment->created_at }}</span>

			</div>
		</div>
		@endforeach

	</div>
</div>


@endsection