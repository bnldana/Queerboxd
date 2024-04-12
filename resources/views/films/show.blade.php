{{-- Détails du film --}}
@extends('layouts.app')

@section('content')
<div id="movie-info" class="d-flex flex-row align-items-center" style="gap: 20px;">
    <img class="movie-poster" src="{{ $film->image_url }}">
    <div>
        <h1>{{ $film->movie_title }} ({{ $film->release_date }})</h1>
        <p><strong>Director:</strong> {{ $film->director }}</p>
        <p><strong>Plot:</strong> {{ $plot }}</p>
    </div>
</div>

<div id="movie-reviews">
    <h2>Reviews</h2>
    @foreach($film->reviews as $review)
    <div>
        <h3>{{ $review->title }}</h3>
        <div class="star-review" style="color: #00c030;">
            {!! $review->starRating !!}
        </div>
        <p>{{ $review->text }}</p>
    </div>
    @endforeach

    <button type="button" class="btn btn-light"><a href="{{ route('reviews.create', ['movie_id' => $film->id]) }}">Add a review</a></button>
</div>
@endsection