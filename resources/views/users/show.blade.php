@extends('layouts.app')

@section('content')

<div class="card my-4">

	<div class="card-body">

		<h3 class="card-title">
			{{ $user->name }}
		</h3>

		<div class="card-text">
			Email: {{ $user->email }} <br>
			Joined: {{ $user->created_at }}
		</div>

	</div>

	<div class="card-footer">
		<a class="btn-primary btn" href="/users/{{ $user->id }}/articles">User articles</a>
		<a class="btn-primary btn" href="/users/{{ $user->id }}/comments">User comments</a>
	</div>

</div>

@if ( !empty($articles) )

@include('articles.list', ['articles' => $articles ])

@endif


@if ( !empty($comments) )

@include('comments.list', ['comments' => $comments, 'showRedirection' => 'true' ])

@endif

@endsection