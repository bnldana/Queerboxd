{{-- Liste des films --}}
@extends('layouts.app')

@section('content')
<h1>Films</h1>
<button type="button" class="btn btn-light mb-4"><a href="{{ route('films.create') }}">Add a film</a></button>

<div class="sorting-options mb-4">
    <a href="{{ route('films.index', ['sort' => 'movie_title', 'order' => 'asc']) }}">Title (A-Z)</a> |
    <a href="{{ route('films.index', ['sort' => 'movie_title', 'order' => 'desc']) }}">Title (Z-A)</a> |
    <a href="{{ route('films.index', ['sort' => 'release_date', 'order' => 'desc']) }}">Release year</a> |
    <a href="{{ route('films.index', ['sort' => 'created_at', 'order' => 'desc']) }}">Date added</a>
</div>

<div class="container">
    <div class="row">
        @foreach($films as $film)
        <div class="col-md-3">
            <div class="movie-wrapper">
                <img class="movie-poster" src="{{ $film->image_url }}" alt="Movie Poster">
                <a href="{{ route('films.show', $film->id) }}">
                    <span class="overlay"></span>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection