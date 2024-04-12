{{-- Détails du film --}}
@extends('layouts.app')

@section('content')
<div id="banner-movie" class="banner container-fluid px-0 overflow-hidden">
    <div class="film-backdrop" style="background-image: url('{{ $backdropUrl }}');">
        <div class="gradient-overlay">
        </div>
    </div>
</div>

<div style="padding-top: 350px;">
    <div id="movie-info" class="d-flex flex-row align-items-start" style="gap: 20px;">
        <img class="movie-poster" src="{{ $film->image_url }}">
        <div>
            <div class="d-flex flex-row align-items-end" style="gap: 10px;">
                <h3 class="mb-0">{{ $film->movie_title }}</h3>
                <p class="mb-0">{{ $film->release_date }}</p>
                <p class="mb-0">Directed by <strong>{{ $film->director }}</strong></p>
            </div>
            <div class="d-flex flex-column">
                <p id="plot">{{ $plot }}</p>
                <div id="movie-reviews">
                    <div id="review-title">
                        <p class="text-uppercase mb-1">Reviews</p>
                    </div>
                    @foreach($film->reviews as $review)
                    <div>
                        <div class="d-flex flex-row align-items-center" style="gap: 5px">
                            <h5 class="mb-0">{{ $review->title }}</h5>
                            <div class="star-review" style="color: #00c030;">
                                {!! $review->starRating !!}
                            </div>
                        </div>
                        <p>{{ $review->text }}</p>
                    </div>
                    @endforeach
                    <button type="button" class="btn btn-light"><a href="{{ route('reviews.create', ['movie_id' => $film->id]) }}">Add a review</a></button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection