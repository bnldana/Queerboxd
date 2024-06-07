{{-- Détails du film --}}
@extends('layouts.app')


@section('content')
@include('components.success')
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
            <div class="d-flex flex-column mb-4">
                <div class="d-flex flex-row align-items-end mb-0" style="gap: 10px;">
                    <h3 class="mb-0">{{ $film->movie_title }}</h3>
                    <p class="mb-0">{{ $film->release_date }}</p>
                    <p class="mb-0">Directed by <strong>{{ $film->director }}</strong></p>
                </div>
                @if ($originalTitle !== $film->movie_title)
                <div>
                    <em class="mb-0">"{{ $originalTitle }}"</em>
                </div>
                @endif
            </div>
            <div class="d-flex flex-column">
                <p id="plot">{{ $plot }}</p>
                <div id="movie-reviews">
                    <div id="review-title" class="d-flex flex-row align-items-end justify-content-between mb-2">
                        <p class="text-uppercase mb-1">Reviews</p>
                        <button type="button" class="btn btn-light mb-2"><a href="{{ route('reviews.create', ['movie_id' => $film->id]) }}">Add a review</a></button>
                    </div>
                    @forelse($film->reviews as $review)
                    <div class="d-flex flex-row align-items-center justify-content-between mb-2">
                        <div class="d-flex flex-row align-items-center" style="gap: 5px;">
                            <div class="star-rating" style="color: #00c030; font-size: 0.75em;">
                                {!! $review->starRating !!}
                            </div>
                            <h5 class="rating-movie-title mb-0">{{ $review->title }}</h5>
                        </div>
                        <div>
                            <p class="mb-0 text-uppercase" style="font-size: .7em;">{{ \Carbon\Carbon::parse($review->publication_date)->toFormattedDateString() }}</p>
                        </div>
                    </div>
                    <p class="rating-text">{{ $review->text }}</p>
                </div> @empty
                <p>No reviews yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
</div>
@endsection