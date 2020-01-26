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
</div>

@endsection