{{-- Liste des avis --}}
@extends('layouts.app')

@section('content')
<h1>Reviews</h1>

<div class="d-flex flex-column align-items-start w-100" style="gap: 20px;">
    @php
    $randomKeys = $reviews->pluck('id')->random(min(3, $reviews->count()))->all();
    $additionalReviewsCount = $reviews->count() - count($randomKeys);
    @endphp

    {{-- Afficher les avis aléatoires --}}
    @foreach($reviews as $review)
    @if(in_array($review->id, $randomKeys))
    <div class="rating d-flex flex-row w-100 pb-3" style="gap: 20px;">
        <div class="d-flex align-items-center">
            <a href="{{ route('films.show', $review->film->id) }}">
                <img class="movie-poster-small" src="{{ $review->film->image_url }}" alt="Film poster">
            </a>
        </div>
        <div>
            <div class="d-flex flex-row align-items-center" style="gap: 5px;">
                <h2 class="rating-movie-title mb-0">
                    <a href="{{ route('films.show', $review->film->id) }}">
                        {{ $review->film->movie_title }}
                    </a>
                </h2>
                <p class="mb-0">{{ $review->film->release_date }}</p>
            </div>
            <div class="d-flex flex-row align-items-center" style="gap: 5px;">
                <div class="star-rating" style="color: #00c030;">
                    {!! $review->starRating !!}
                </div>
                <p>{{ \Carbon\Carbon::parse($review->publication_date)->toFormattedDateString() }}</p>
            </div>
            <p class="rating-text">{{ $review->text }}</p>
        </div>
    </div>
    @endif
    @endforeach

    {{-- Bouton pour afficher les avis manquants --}}
    @if($additionalReviewsCount > 0)
    <button id="showAllRatings" type="button" class="btn btn-light">
        <p class="mb-0">Show {{ $additionalReviewsCount }} additional reviews</p>
    </button>
    @endif

    {{-- Section pour les avis manquants --}}
    <div id="allRatings" style="display:none;">
        @foreach($reviews as $review)
        @if(!in_array($review->id, $randomKeys))
        <div class="rating d-flex flex-row w-100 pb-3" style="gap: 20px;">
            <div class="d-flex align-items-center">
                <a href="{{ route('films.show', $review->film->id) }}">
                    <img class="movie-poster-small" src="{{ $review->film->image_url }}" alt="Film poster">
                </a>
            </div>
            <div>
                <div class="d-flex flex-row align-items-center" style="gap: 5px;">
                    <h2 class="rating-movie-title mb-0">
                        <a href="{{ route('films.show', $review->film->id) }}">
                            {{ $review->film->movie_title }}
                        </a>
                    </h2>
                    <p class="mb-0">{{ $review->film->release_date }}</p>
                </div>
                <div class="d-flex flex-row align-items-center" style="gap: 5px;">
                    <div class="star-rating" style="color: #00c030;">
                        {!! $review->starRating !!}
                    </div>
                    <p>{{ \Carbon\Carbon::parse($review->publication_date)->toFormattedDateString() }}</p>
                </div>
                <p class="rating-text">{{ $review->text }}</p>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</div>

<script>
    document.getElementById('showAllRatings').addEventListener('click', function() {
        document.getElementById('allRatings').style.display = 'block';
        this.style.display = 'none';
    });
</script>
@endsection