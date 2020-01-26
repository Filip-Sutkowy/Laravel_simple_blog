@extends('layouts.app')

@section('content')

<h1>Create new article</h1>

@if ($errors->any())
<div class="alert alert-danger">
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif


<form method="POST" action="/articles" enctype="multipart/form-data">
	@csrf
	@method('POST')

	<div class="form-group">
		<label for="articleTitle">Title</label>
		<input name="title" type="text" class="form-control" id="articleTitle" placeholder="Enter title">
	</div>

	<div class="form-group">
		<label for="articleContent">Article body</label>
		<textarea class="form-control" name="content" id="articleContent" cols="30" rows="10" placeholder="Enter article content here"></textarea>
	</div>

	<div class="input-group">
		<div class="input-group-prepend">
			<span class="input-group-text" id="articleImageAddon">Select image</span>
		</div>
		<div class="custom-file">
			<input name="image" type="file" class="custom-file-input" id="articleImage" accept="image/png, image/jpeg">
			<label class="custom-file-label" for="articleImage">Article image</label>
		</div>
	</div>

	<button type="submit" class="btn btn-primary mt-4">Submit</button>


</form>

@endsection