{{-- Détails du film --}}
@extends('layouts.app')

@section('content')
<div id="movie-info">
    <img class="movie-poster" src="{{ $movie->image_url }}">
    <h1>{{ $movie->movie_title }} ({{ $movie->release_date }})</h1>
    <p>Director: {{ $movie->director }}</p>
    <p><strong>Plot:</strong> {{ $plot }}</p>
</div>

<div id="movie-reviews">
    <h2>Reviews</h2>
    @foreach($movie->ratings as $rating)
    <div>
        <h3>{{ $rating->title }}</h3>
        <p>{{ $rating->formatted_rating }}/5</p>
        <p>{{ $rating->text }}</p>
    </div>
    @endforeach

    <button type="button" class="btn btn-light"><a href="{{ route('ratings.create', ['movie_id' => $movie->id]) }}">Add a review</a></button>
</div>
@endsection