@extends('layouts.app')

@section('content')

@if (count($articles) > 0)
<div class="row justify-content-center">
	<div class="col col-lg-8">


		@foreach ($articles as $article)
		<div class="card my-4 text-center">

			<img src="{{ $article->image }}" class="card-img-top" alt="{{ $article->title }}" height="240">
			<div class="card-body">
				<h3 class="card-title">
					{{ $article->title }}
				</h3>
				<div class="card-text">
					{{ substr($article->content, 0, 200).'...' }}
				</div>
				<a href="/articles/{{ $article->id }}" class="btn btn-primary mt-4">Read more...</a>
			</div>
			<div class="card-footer text-muted">
				Created at {{ $article->created_at }}
			</div>
		</div>
		@endforeach

		{{ $articles->links() }}

	</div>
</div>
@endif

@endsection