@extends('layouts.app')

@section('content')

@if (count($articles) > 0)
@include('articles.list', ['articles' => $articles])
@endif

@endsection