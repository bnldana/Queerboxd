{{-- Liste des films --}}
@extends('layouts.app')

@section('content')
<h1>Films</h1>
<button type="button" class="btn btn-light mb-4"><a href="{{ route('movies.create') }}">Add a movie</a></button>

<div class="sorting-options mb-4">
    <a href="{{ route('movies.index', ['sort' => 'movie_title', 'order' => 'asc']) }}">Title (A-Z)</a> |
    <a href="{{ route('movies.index', ['sort' => 'movie_title', 'order' => 'desc']) }}">Title (Z-A)</a> |
    <a href="{{ route('movies.index', ['sort' => 'release_date', 'order' => 'desc']) }}">Release year</a> |
    <a href="{{ route('movies.index', ['sort' => 'created_at', 'order' => 'desc']) }}">Date added</a>
</div>

<div class="container">
    <div class="row">
        @foreach($movies as $movie)
        <div class="col-md-3">
            <a href="{{ route('movies.show', $movie->id) }}">
                <img class="movie-poster" src="{{ $movie->image_url }}" alt="Movie Poster">
            </a>
        </div>
        @endforeach
    </div>
</div>

@endsection