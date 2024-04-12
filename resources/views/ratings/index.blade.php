{{-- Liste des avis --}}
@extends('layouts.app')

@section('content')
<h1>Reviews</h1>

<div class="d-flex flex-column align-items-start w-100" style="gap: 20px;">
    @php
    $randomKeys = $ratings->pluck('id')->random(min(3, $ratings->count()))->all();
    $additionalRatingsCount = $ratings->count() - count($randomKeys);
    @endphp

    {{-- Afficher les avis aléatoires --}}
    @foreach($ratings as $rating)
    @if(in_array($rating->id, $randomKeys))
    <div class="rating d-flex flex-row w-100 pb-3" style="gap: 20px;">
        <div class="d-flex align-items-center">
            <a href="{{ route('movies.show', $rating->movie->id) }}">
                <img class="movie-poster-small" src="{{ $rating->movie->image_url }}" alt="Movie Poster">
            </a>
        </div>
        <div>
            <div class="d-flex flex-row align-items-center" style="gap: 5px;">
                <h2 class="rating-movie-title mb-0">
                    <a href="{{ route('movies.show', $rating->movie->id) }}">
                        {{ $rating->movie->movie_title }}
                    </a>
                </h2>
                <p class="mb-0">{{ $rating->movie->release_date }}</p>
            </div>
            <div class="d-flex flex-row align-items-center" style="gap: 5px;">
                <p>{{ $rating->formatted_rating }}/5</p>
                <p>{{ \Carbon\Carbon::parse($rating->publication_date)->toFormattedDateString() }}</p>
            </div>
            <p class="rating-text">{{ $rating->text }}</p>
        </div>
    </div>
    @endif
    @endforeach

    {{-- Bouton pour afficher les avis manquants --}}
    @if($additionalRatingsCount > 0)
    <button id="showAllRatings" type="button" class="btn btn-light">
        <p class="mb-0">Show {{ $additionalRatingsCount }} additional reviews</p>
    </button>
    @endif

    {{-- Section pour les avis manquants, maintenant avec la même structure que les avis aléatoires --}}
    <div id="allRatings" style="display:none;">
        @foreach($ratings as $rating)
        @if(!in_array($rating->id, $randomKeys))
        <div class="rating d-flex flex-row w-100 pb-3" style="gap: 20px;">
            <div class="d-flex align-items-center">
                <a href="{{ route('movies.show', $rating->movie->id) }}">
                    <img class="movie-poster-small" src="{{ $rating->movie->image_url }}" alt="Movie Poster">
                </a>
            </div>
            <div>
                <div class="d-flex flex-row align-items-center" style="gap: 5px;">
                    <h2 class="rating-movie-title mb-0">
                        <a href="{{ route('movies.show', $rating->movie->id) }}">
                            {{ $rating->movie->movie_title }}
                        </a>
                    </h2>
                    <p class="mb-0">{{ $rating->movie->release_date }}</p>
                </div>
                <div class="d-flex flex-row align-items-center" style="gap: 5px;">
                    <p>{{ $rating->formatted_rating }}/5</p>
                    <p>{{ \Carbon\Carbon::parse($rating->publication_date)->toFormattedDateString() }}</p>
                </div>
                <p class="rating-text">{{ $rating->text }}</p>
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